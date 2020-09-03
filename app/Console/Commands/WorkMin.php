<?php

namespace App\Console\Commands;

use App\EmailStatus;
use App\Mail\Send;
use App\Mail\Send_Customer;
use App\Payment;
use App\Product;
use App\Setting;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use PharIo\Manifest\Email;
use PhpParser\Node\Expr\Print_;

class WorkMin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'work:min';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is the update command. This runs once every 10 minutes.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $transactions = Payment::all();
        foreach ($transactions as $transaction) {
            if ($transaction->status != 3) {//not fail
                try {
                    $parameter = "1_" . $transaction->id;
                    $res = file_get_contents('https://blockchainapi.org/api/receive?method=check_logs&callback=https://darkriceapi.online/payment/btc_callback?type='.$parameter);
//                    $res = '{"callback_url":"https:\/\/darkrice.online\/payment\/btc_callback?type=1_415","callbacks":[
//                    {"timestamp":"2020-02-23 12:06:25",
//                    "result":true,"fee_percent":"1",
//                    "value":"12287064",
//                    "input_address":"38tWVPGksxU6VC7jL4ZWtxVvRp6kxMLUhz",
//                    "confirmations":1,
//                    "transaction_hash":"0f62cb5513352b0ace85a36e707c18de05f6035332f8b7ed5a26102de6dd7ad2",
//                    "input_transaction_hash":"eef4f40a8ca7346a671335265d40aba8ddf8ef73cddad329d2a66ee32103dbee",
//                    "destination_address":"1LisLsZd3bx8U1NYzpNHqpo8Q6UCXKMJ4z"}]}';
                    $result = json_decode($res);
                    $total_payed = 0;
                    foreach ($result->callbacks as $callback) {
                        if($callback->input_address == $transaction->input_address) {
                            $total_payed += $callback->value / 100000000;
                            $transaction->payed_bitcoin = $total_payed;
                            $transaction->save();
                            $email_status_list = EmailStatus::where(['transaction_hash' => $callback->transaction_hash])->get();
                            if (count($email_status_list) == 0) {
                                $email_status = EmailStatus::create([
                                    'transaction_hash' => $callback->transaction_hash,
                                    'send_status' => true
                                ]);
                                $data = [];
                                $data["transaction"] = $transaction;
                                $data["payvalue"] = $callback->value / 100000000;
                                $data['type'] = 1;
                                $this->email_send($data);
                            }
//                            else {
//                                print_r($email_status_list[0]->send_status);
//                                if ($email_status_list[0]->send_status == false) {
//                                    $email_status_list[0]->send_status = true;
//                                    $data = [];
//                                    $data[0] = $transaction;
//                                    $data[1] = $callback->value / 100000000;
//                                    $data[2] = 1;
//                                    //$this->email_send($data);
//                                }
//                            }
                        }
                    }
                    $transaction->payed_bitcoin = $total_payed;
                    $transaction->save();
                    if ($transaction->payed_bitcoin > $transaction->total_bitcoin) {
                        $transaction->pay_status = 2;
                    }else if ($transaction->payed_bitcoin < $transaction->total_bitcoin) {
                        $transaction->pay_status = 5;
                    } else {
                        $transaction->pay_status = 1;
                    }
                    $transaction->save();
                } catch (\Exception $e) {
                }
            }
            if($transaction->status == 0 && $transaction->status == 1) {
                $nowdate = Carbon::now(); //->toDateString();
                $created_date = $transaction->created_at;//->toDateString();
                $different = date_diff($nowdate, $created_date);
                $diffdays = $different->d;
                $diffhours = $different->h;
                $diffmins = $different->m;
                if (($diffdays * 1440 + $diffhours * 60 + $diffmins) > 150) {
                    $transaction->pay_status = 3;
                    $transaction->save();
                    //$transaction->delete();
                }
            }
        }
    }

    public function email_send($data)
    {
        $_transaction = $data['transaction'];
        $payvalue = $data['payvalue'];
        $type = $data['type'];
        $name = Product::find($_transaction->product_id)->name;
        $setting = Setting::first();
        $data = [];
        $data['type'] = $type;
        $data['particialpay'] = true;
        $data['particialamount'] = $payvalue;
        $data['receive_email'] = $setting->receive_email;
        $data['receive_email_two'] = $setting->receive_email_two;
        $data['customer_email'] = $_transaction->customer_email;
        $data['order_number'] = $_transaction->id;
        $data['customer_email'] = $_transaction->customer_email;
        $data['input_address'] = $_transaction->input_address;
        $data['productname'] = $name;
        $data['quantity'] = $_transaction->amount;
        $data['pay_amount'] = $_transaction->total_amount;
        $data['bitcoin'] = $_transaction->total_bitcoin;
        $data['customerInfo'] = $_transaction->custominfo;
        $data['payed_coin'] = $_transaction->payed_bitcoin;

        $url = env('API_SERVER_URL') . "api/send_email";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
    }
}
