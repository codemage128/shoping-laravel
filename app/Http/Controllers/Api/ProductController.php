<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\FrontEndController;
use App\Mail\Customer;
use App\Mail\Manager;
use App\Payment;
use App\Product;
use App\ProductWeight;
use App\Setting;
use App\ViewInfo;
use Illuminate\Http\Request;
use Validator;
use Mail;

class ProductController extends BasicController
{
    public function productApp(Request $request)
    {
        $data = Product::all();
        // $data = Product::paginate(20);
        return $this->sendResponse($data, "ProductList");
    }
    public function productList(Request $request)
    {
        // $data = Product::all();
        $data = Product::paginate(20);
        return $this->sendResponse($data, "ProductList");
    }
    public function get_setting(Request $request)
    {
        $data = Setting::first();
        return $this->sendResponse($data, "Setting");
    }

    public function productInfo($id)
    {
        $product = Product::find($id);
        $weight = ProductWeight::where(['product_id' => $id])->get();
        $data = [];
        $data['product'] = $product;
        $data['weight'] = $weight;
        return $this->sendResponse($data, "ProductInfo");
    }

    public function buyproduct(Request $request, $productid)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'custominfo' => 'required',
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return $this->sendError("Error", $validator->errors());
        }
        $product = Product::find($productid);
        $price_fee_first = $product->price_fee_first;
        $price_fee_second = $product->price_fee_second;
        $price_fee_third = $product->price_fee_third;
        $amount = $request->amount;
        $price = 0;
        $priceList = ProductWeight::where(['product_id' => $productid])->get();
        foreach ($priceList as $item) {
            if ($item->weight == $amount) {
                $price = $item->price;
            }
        }
        $price_product = $price;
        $fee = 0;
        if ($request->fee_first) {
            $fee = $fee + $price_fee_first;
        }
        if ($request->fee_second) {
            $fee = $fee + $price_fee_second;
        }
        if ($request->fee_third) {
            $fee = $fee + $price_fee_third;
        }
        if ($fee == 0) {
            $fee = $price_fee_first;
        }
        $total_fee = $fee;
        $pay_amount = $total_fee + $price_product;
        $transaction = Payment::create([
            'product_id' => $productid,
            'amount' => $amount,
            'total_amount' => $pay_amount,
            'total_bitcoin' => 0,
            'pay_status' => 0,
            'customer_email' => $request->email,
            'custominfo' => $request->custominfo,
            'input_address' => 0,
            'payed_bitcoin' => 0,
        ]);
        $input_address = $this->requestBitCoin($transaction->id);
        $transaction->input_address = $input_address;
        $transaction->save();
        $response = file_get_contents('https://blockchain.info/ticker');
        $response = json_decode($response);
        $todayprice = ((Array)$response->EUR)['15m'];
        $total_btc = file_get_contents('https://blockchain.info/tobtc?currency=EUR&value=' . $transaction->total_amount);
        $transaction->total_bitcoin = $this->calculate($total_btc);
        $transaction->save();
        $data = [];
        $data['trasaction'] = $transaction;
        $data['todayprice'] = $todayprice;
        $data['product'] = $product;

        return $this->sendResponse($data, "Successful buy!");
    }

    public function calculate($amount)
    {
        $amount = $amount * 100000000;
        $first = $amount / 0.99;
        return $first / 100000000;
    }

    public function pay(Request $request, $id)
    {
        $transaction_id = $id;
        $transaction = Payment::find($transaction_id);
        $transaction->pay_status = 1;
        $transaction->save();
        return $this->sendResponse($transaction, 'succcessful');
    }

    public function requestBitCoin($id)
    {
        $secret = "7j0ap91o99cxj8k9";
        $setting = Setting::first();
        $address = $setting->address;
        $parameter = "1_" . $id;
        $url = 'https://blockchainapi.org/api/receive?method=create&address=' . $address . '&callback=https://darkriceapi.online/payment/btc_callback?type=' . $parameter;
        $response = file_get_contents($url);
        $response = json_decode($response);
        return $response->input_address;
    }

    public function payconfirm(Request $request, $id){

        $transaction = Payment::find($id);
        $transaction->pay_status = 1;
        $transaction->save();
        $total_btc = file_get_contents('https://blockchain.info/tobtc?currency=EUR&value=' . $transaction->total_amount);
        $response = file_get_contents('https://blockchain.info/ticker');
        $response = json_decode($response);
        $todayprice = ((Array)$response->EUR)['15m'];
        $product = Product::find($transaction->product_id);
        $productname = $product->name;
        $setting = Setting::first();
        $data = [];
        $data['particialpay'] = false;
        $data['receive_email'] = $setting->receive_email;
        $data['customer_email'] = $transaction->customer_email;
        $data['order_number'] = $transaction->id;
        $data['customer_email'] = $transaction->customer_email;
        $data['input_address'] = $transaction->input_address;
        $data['productname'] = $productname;
        $data['quantity'] = $transaction->amount;
        $data['pay_amount'] = $transaction->total_amount;
        $data['bitcoin'] = $transaction->total_bitcoin;
        $data['customerInfo'] = $transaction->custominfo;
        $data['payed_coin'] = $transaction->payed_bitcoin;
        
        $url = env('API_SERVER_URL'). "api/send_email";
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        
        // try {
        //     Mail::to($setting->receive_email)->send(new Manager($data));
        //     Mail::to($data[0]->customer_email)->send(new Customer($data));
        // } catch (Swift_TransportException $e) {
        //     print_r($e->getMessage());
        // }
        $response = file_get_contents('https://blockchain.info/ticker');
        $response = json_decode($response);
        $todayprice = ((Array)$response->EUR)['15m'];
        $data_result = array();
        $product = Product::find($transaction->product_id);
        $data_result['transaction'] = $transaction;
        $data_result['product'] = $product;
        $data_result['todayprice'] = $todayprice;
        return $this->sendResponse($data_result, "Confirm Successful!");
    }

    public function aboutus(Request $request)
    {
        $viewinfo = ViewInfo::first();
        return $this->sendResponse($viewinfo, "This is About us page");
    }
}
