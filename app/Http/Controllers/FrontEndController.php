<?php

namespace App\Http\Controllers;

use Activation;
use App\ClientLog;
use App\Http\Middleware\SentinelAdmin;
use App\Http\Requests\FrontendRequest;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\UserRequest;
use App\Mail\Contact;
use App\Mail\ContactUser;
use App\Mail\Customer;
use App\Mail\ForgotPassword;
use App\Mail\Manager;
use App\Mail\Register;
use App\Mail\Send;
use App\Mail\Send_Customer;
use App\Payment;
use App\Product;
use App\ProductWeight;
use App\Setting;
use App\User;
use App\ViewInfo;
use Carbon\Carbon;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cassandra;
use Composer\DependencyResolver\Transaction;
use File;
use Hash;
use Illuminate\Http\Request;
use Mail;
use PhpParser\Node\Expr\Array_;
use PragmaRX\Google2FA\Google2FA;
use Redirect;
use Reminder;
use Sentinel;
use URL;
use Validator;
use vendor\project\StatusTest;
use View;
use Session;


class FrontEndController extends JoshController
{
    /*
     * $user_activation set to false makes the user activation via user registered email
     * and set to true makes user activated while creation
     */
    private $user_activation = false;

    /**
     * Account sign in.
     *
     * @return View
     */
    public function getLogin()
    {
        return view('login');
    }

    public function getLogin2(Request $request)
    {
        $value = Session::get('first_step');
        $time = Session::get('first_time');
        $delta = Carbon::now()->diffInSeconds($time);
        if ($delta < 120) {
            session(['second_step' => "true"]);
            session(['second_time' => Carbon::now()->toTimeString()]);
            return view('login2');
        } else {
            return redirect()->route('login');
        }
    }

    public function postLogin2(Request $request)
    {
        $value = Session::get('second_step');
        $time = Session::get('second_time');
        $delta = Carbon::now()->diffInSeconds($time);
        if ($delta < 120) {
            //confirm
            $setting = Setting::first();
            $secret = $setting->otp_key;
            $val = $request->code;
            $google = new Google2FA();
            $flag = $google->verifyKey($secret, $val);
            if ($flag) {
                session(['pass' => 'true']);
                session(['pass_time' => Carbon::now()->toTimeString()]);
                $ipaddress = $request->ip();
                ClientLog::create([
                    'ipaddress' => $ipaddress
                ]);
                return redirect('/home');
            } else {
                return redirect()->route('login2');
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function postLogin(Request $request)
    {
        try {
            $setting = Setting::first();
            if ($setting->password == $request->password) {
                session(['first_step' => true]);
                session(['first_time' => Carbon::now()->toTimeString()]);
                return redirect()->route('login2');
            } else {
                return redirect('login')->with('error', 'Password is incorrect.');
                //return Redirect::back()->withInput()->withErrors($validator);
            }

        } catch (UserNotFoundException $e) {
            $this->messageBag->add('email', trans('auth/message.account_not_found'));
        } catch (NotActivatedException $e) {
            $this->messageBag->add('email', trans('auth/message.account_not_activated'));
        } catch (UserSuspendedException $e) {
            $this->messageBag->add('email', trans('auth/message.account_suspended'));
        } catch (UserBannedException $e) {
            $this->messageBag->add('email', trans('auth/message.account_banned'));
        } catch (ThrottlingException $e) {
            $delay = $e->getDelay();
            $this->messageBag->add('email', trans('auth/message.account_suspended', compact('delay')));
        }
        // Ooops.. something went wrong
        return Redirect::back()->withInput()->withErrors($this->messageBag);
    }

    /**
     * get user details and display
     */
    public function myAccount(User $user)
    {
        $user = Sentinel::getUser();
        $countries = $this->countries;
        return view('user_account', compact('user', 'countries'));
    }

    /**
     * update user details and display
     * @param Request $request
     * @param User $user
     * @return Return Redirect
     */
    public function update(User $user, FrontendRequest $request)
    {
        $user = Sentinel::getUser();
        //update values
        $user->update($request->except('password', 'pic', 'password_confirm'));

        if ($password = $request->get('password')) {
            $user->password = Hash::make($password);
        }
        // is new image uploaded?
        if ($file = $request->file('pic')) {
            $extension = $file->extension() ?: 'png';
            $folderName = '/uploads/users/';
            $destinationPath = public_path() . $folderName;
            $safeName = str_random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);

            //delete old pic if exists
            if (File::exists(public_path() . $folderName . $user->pic)) {
                File::delete(public_path() . $folderName . $user->pic);
            }
            //save new file path into db
            $user->pic = $safeName;

        }

        // Was the user updated?
        if ($user->save()) {
            // Prepare the success message
            $success = trans('users/message.success.update');
            //Activity log for update account
            activity($user->full_name)
                ->performedOn($user)
                ->causedBy($user)
                ->log('User Updated successfully');
            // Redirect to the user page
            return Redirect::route('my-account')->with('success', $success);
        }

        // Prepare the error message
        $error = trans('users/message.error.update');


        // Redirect to the user page
        return Redirect::route('my-account')->withInput()->with('error', $error);


    }

    /**
     * Account Register.
     *
     * @return View
     */
    public function getRegister()
    {
        // Show the page
        return view('register');
    }

    /**
     * Account sign up form processing.
     *
     * @return Redirect
     */
    public function postRegister(UserRequest $request)
    {
        $activate = $this->user_activation; //make it false if you don't want to activate user automatically it is declared above as global variable
        try {
            // Register the user
            $user = Sentinel::register($request->only(['first_name', 'last_name', 'email', 'password', 'gender']), $activate);
            //add user to 'User' group
            $role = Sentinel::findRoleByName('User');
            $role->users()->attach($user);
            //if you set $activate=false above then user will receive an activation mail
            if (!$activate) {
                // Data to be used on the email view
                $data = [
                    'user_name' => $user->first_name . ' ' . $user->last_name,
                    'activationUrl' => URL::route('activate', [$user->id, Activation::create($user)->code]),
                ];
                // Send the activation code through email
                Mail::to($user->email)
                    ->send(new Register($data));
                //Redirect to login page
                return redirect('login')->with('success', trans('auth/message.signup.success'));
            }
            // login user automatically
            Sentinel::login($user, false);
            //Activity log for new account
            activity($user->full_name)
                ->performedOn($user)
                ->causedBy($user)
                ->log('New Account created');
            // Redirect to the home page with success menu
            return Redirect::route("my-account")->with('success', trans('auth/message.signup.success'));

        } catch (UserExistsException $e) {
            $this->messageBag->add('email', trans('auth/message.account_already_exists'));
        }

        // Ooops.. something went wrong
        return Redirect::back()->withInput()->withErrors($this->messageBag);
    }

    /**
     * User account activation page.
     *
     * @param number $userId
     * @param string $activationCode
     *
     */
    public function getActivate($userId, $activationCode)
    {
        // Is the user logged in?
        if (Sentinel::check()) {
            return Redirect::route('my-account');
        }

        $user = Sentinel::findById($userId);

        if (Activation::complete($user, $activationCode)) {
            // Activation was successfull
            return Redirect::route('login')->with('success', trans('auth/message.activate.success'));
        } else {
            // Activation not found or not completed.
            $error = trans('auth/message.activate.error');
            return Redirect::route('login')->with('error', $error);
        }
    }

    /**
     * Forgot password page.
     *
     * @return View
     */
    public function getForgotPassword()
    {
        // Show the page
        return view('forgotpwd');

    }

    /**
     * Forgot password form processing page.
     * @param Request $request
     * @return Redirect
     */
    public function postForgotPassword(Request $request)
    {

        try {
            // Get the user password recovery code
            $user = Sentinel::findByCredentials(['email' => $request->email]);
            if (!$user) {
                return Redirect::route('forgot-password')->with('error', trans('auth/message.account_email_not_found'));
            }

            $activation = Activation::completed($user);
            if (!$activation) {
                return Redirect::route('forgot-password')->with('error', trans('auth/message.account_not_activated'));
            }

            $reminder = Reminder::exists($user) ?: Reminder::create($user);
            // Data to be used on the email view

            $data = [
                'user_name' => $user->first_name . ' ' . $user->last_name,
                'forgotPasswordUrl' => URL::route('forgot-password-confirm', [$user->id, $reminder->code])
            ];
            // Send the activation code through email
            Mail::to($user->email)
                ->send(new ForgotPassword($data));

        } catch (UserNotFoundException $e) {
            // Even though the email was not found, we will pretend
            // we have sent the password reset code through email,
            // this is a security measure against hackers.
        }

        //  Redirect to the forgot password
        return back()->with('success', trans('auth/message.forgot-password.success'));
    }

    /**
     * Forgot Password Confirmation page.
     *
     * @param string $passwordResetCode
     * @return View
     */
    public function getForgotPasswordConfirm(Request $request, $userId, $passwordResetCode = null)
    {
        if (!$user = Sentinel::findById($userId)) {
            // Redirect to the forgot password page
            return Redirect::route('forgot-password')->with('error', trans('auth/message.account_not_found'));
        }

        if ($reminder = Reminder::exists($user)) {
            if ($passwordResetCode == $reminder->code) {
                return view('forgotpwd-confirm', compact(['userId', 'passwordResetCode']));
            } else {
                return 'code does not match';
            }
        } else {
            return 'does not exists';
        }

    }

    /**
     * Forgot Password Confirmation form processing page.
     *
     * @param string $passwordResetCode
     * @return Redirect
     */
    public function postForgotPasswordConfirm(PasswordResetRequest $request, $userId, $passwordResetCode = null)
    {

        $user = Sentinel::findById($userId);
        if (!$reminder = Reminder::complete($user, $passwordResetCode, $request->get('password'))) {
            // Ooops.. something went wrong
            return Redirect::route('login')->with('error', trans('auth/message.forgot-password-confirm.error'));
        }

        // Password successfully reseted
        return Redirect::route('login')->with('success', trans('auth/message.forgot-password-confirm.success'));
    }

    /**
     * Contact form processing.
     * @param Request $request
     * @return Redirect
     */
    public function postContact(Request $request)
    {
        $data = [
            'contact-name' => $request->get('contact-name'),
            'contact-email' => $request->get('contact-email'),
            'contact-msg' => $request->get('contact-msg'),
        ];

        // Send Email to admin
        Mail::to('email@domain.com')
            ->send(new Contact($data));

        // Send Email to user
        Mail::to($data['contact-email'])
            ->send(new ContactUser($data));

        //Redirect to contact page
        return redirect('contact')->with('success', trans('auth/message.contact.success'));
    }

    public function showViewProduct($id)
    {
        $product = Product::find($id);
        $weight = ProductWeight::where(['product_id' => $id])->get();
        return view('single_product', compact('product', 'weight'));
    }

    public function requestBitCoin($id)
    {
        $secret = "7j0ap91o99cxj8k9";
        $setting = Setting::first();
        $address = $setting->address;
        $parameter = "1_" . $id;
        $url = 'https://blockchainapi.org/api/receive?method=create&address=' . $address . '&callback=https://darkrice.online/payment/btc_callback?type=' . $parameter;
        $response = file_get_contents($url);
        $response = json_decode($response);
        return $response->input_address;
    }

    public static function btcCallback(Request $request)
    {
//        $secret = "7j0ap91o99cxj8k9";
//        $type = $request->type;
//        $type = str_split($request->type);
//        $type = $type[0];
//        $setting = Setting::first();
//        $address = $setting->address;
//        //if ($request->secret != $secret) die();
//        if ($request->destination_address != $address) die();
//        $input_address = $request->input_address;
//        $input_transaction_hash = $request->input_transaction_hash;
//        $transaction_hash = $request->transaction_hash;
//        $value = $request->value;
//        $value = sprintf('%1.0f', $value);
//        $value_btc = $value / 100000000;
//        $transaction = Payment::where([
//            'input_address' => $input_address
//        ])->first();
//        $data = array();
//        $data[0] = $transaction;
//        $data[1] = $value_btc;
//        $data[2] = $type;
//        FrontEndController::sendEmail(($data));
    }

    public static function sendEmail($data)
    {
        $setting = Setting::first();
        $type = $data[2];
        if ($type == 1) {
            try {
                Mail::to($setting->receive_email)->send(new Send($data));
                Mail::to($data[0]->customer_email)->send(new Send_Customer($data));
            } catch (Swift_TransportException $e) {
                print_r($e->getMessage());
            }
        } else if ($type == 2) {
            try {
                Mail::to($setting->receive_email_two)->send(new Send($data));
                Mail::to($data[0]->customer_email)->send(new Send_Customer($data));
            } catch (Swift_TransportException $e) {
                print_r($e->getMessage());
            }
        }
    }

    public function payment(Request $request, $productid)
    {
        $this->validate($request, [
            'amount' => 'required',
            'custominfo' => 'required',
            'email' => 'required|email',
        ]);
        $product = Product::find($productid);
        $price_fee_first = $product->price_fee_first;
        $price_fee_second = $product->price_fee_second;
        $price_fee_third = $product->price_fee_third;
        $price_original = $product->price_original;
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
        if ($request->fee_first == "on") {
            $fee = $fee + $price_fee_first;
        }
        if ($request->fee_second == "on") {
            $fee = $fee + $price_fee_second;
        }
        if ($request->fee_third == "on") {
            $fee = $fee + $price_fee_third;
        }
        if ($fee == 0) {
            $fee = $price_fee_first;
        }
        $total_fee = $fee;
        $pay_amount = $total_fee + $price_product;
        $transaction = Payment::create([
            'product_id' => $request->productid,
            'amount' => $amount,
            'total_amount' => $pay_amount,
            'total_bitcoin' => 0,
            'pay_status' => 0,
            'customer_email' => $request->email,
            'custominfo' => $request->custominfo,
            'input_address' => 0,
            'payed_bitcoin' => 0,
        ]);
        $input_address = FrontEndController::requestBitCoin($transaction->id);
        $transaction->input_address = $input_address;
        $transaction->save();
        $response = file_get_contents('https://blockchain.info/ticker');
        $response = json_decode($response);
        $todayprice = ((Array)$response->EUR)['15m'];
        $total_btc = file_get_contents('https://blockchain.info/tobtc?currency=EUR&value=' . $transaction->total_amount);
        $transaction->total_bitcoin = $this->calculate($total_btc);
        $transaction->save();
        return view('transactions', compact('transaction', 'total_btc'), compact('todayprice'));
    }

    public function calculate($amount)
    {
        $amount = $amount * 100000000;
        $first = $amount / 0.99;
        return $first / 100000000;
    }

    public function confirmandback($id)
    {
        $transaction = Payment::find($id);
        $transaction->pay_status = 1;
        $transaction->save();
        return redirect()->route('single_product', $transaction->product_id);
    }

    public function payconfirm($id)
    {
        $transaction = Payment::find($id);
        $transaction->pay_status = 1;
        $transaction->save();
        $total_btc = file_get_contents('https://blockchain.info/tobtc?currency=EUR&value=' . $transaction->total_amount);
        $response = file_get_contents('https://blockchain.info/ticker');
        $response = json_decode($response);
        $todayprice = ((Array)$response->EUR)['15m'];
        $data = array();
        $data[0] = $transaction;
        $setting = Setting::first();
        try {
            Mail::to($setting->receive_email)->send(new Manager($data));
            Mail::to($data[0]->customer_email)->send(new Customer($data));
        } catch (Swift_TransportException $e) {
            print_r($e->getMessage());
        }
        return view('payconfirm', compact('transaction', 'total_btc'), compact('todayprice'));
    }

    public function showFrontEndView($name = null)
    {
        if (View::exists($name)) {
            if ($name == "products") {
                $product_list = Product::paginate(12);
                return view($name, compact('product_list'));
            } else {
                return view($name);
            }
        } else {
            abort('404');
        }
    }

    public function getLogout()
    {
        if (Sentinel::check()) {
            //Activity log
            $user = Sentinel::getuser();
            activity($user->full_name)
                ->performedOn($user)
                ->causedBy($user)
                ->log('LoggedOut');
            Sentinel::logout();
            return redirect('login')->with('success', 'You have successfully logged out!');
        } else {
            //return redirect('admin/signin')->with('error', 'You must be login!');
        }
    }
}
