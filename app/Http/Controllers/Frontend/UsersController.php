<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Frontend\UserRegRequest;
use Illuminate\Contracts\Session\Session as SessionSession;

class UsersController extends Controller
{
    public function loginRegisterPage()
    {
        return view('frontend.pages.user.loginRegister');
    }
    public function registerUser(Request $request)
    {
        if ($request->isMethod('post')) {
            Session::forget('error_message');
            Session::forget('success_message');
            $data = $request->all();
            $userCount = User::where('email', $data['email'])->count();
            if ($userCount > 0) {
                Session::flash('user_exist_msg', 'User already exist!');
                return redirect()->back();
            } else {
                //Register User
                $user = new User;
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->mobile = $data['mobile'];
                $user->password = Hash::make($data['password']);
                $user->status = 0;
                $user->save();
                //Send confirmation email to user
                $email = $data['email'];
                $messageData = [
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'code' => base64_encode($data['email'])
                ];
                Mail::send(
                    'emails.confirmation',
                    $messageData,
                    function ($message) use ($email) {
                        $message->to($email);
                        $message->subject('Confirmation your ecommerce account');
                    }
                );
                $message = "Please confirm your email to active your email";
                Session::put('success_message', $message);
                return redirect()->back();

                // Attempt to login the user
                // if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                //     //Update user cart with user id
                //     if (!empty(Session::get('session_id'))) {
                //         $user_id = Auth::user()->id;
                //         $session_id = Session::get('session_id');
                //         Cart::where('session_id', $session_id)->update(['user_id' => $user_id]);
                //     }
                //     //Send mail after user registration
                //     $email = $data['email'];
                //     $messageData = ['name'=>$data['name'], 'email'=>$data['email'],'mobile'=>$data['mobile'],'email'=>$data['email']];
                //     Mail::send('emails.register', $messageData, function ($message)use($email) {
                //         $message->to($email);
                //         $message->subject('Welcome to eCommerce website');
                //     });
                //     return redirect()->back();
                // }
            }
        }
    }
    public function loginUser(Request $request)
    {
        if ($request->isMethod('post')) {
            Session::forget('error_message');
            Session::forget('success_message');
            $data = $request->all();
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                //Checking user activated or not
                $userStatus = User::where('email',$data['email'])->first();
                if($userStatus->status == 0){
                    Auth::logout();
                    $message = "Please confirm your email first";
                    Session::put('error_message', $message);
                    return redirect()->back();
                }
                //Update user cart with user id
                if (!empty(Session::get('session_id'))) {
                    $user_id = Auth::user()->id;
                    $session_id = Session::get('session_id');
                    Cart::where('session_id', $session_id)->update(['user_id' => $user_id]);
                }
                return redirect('/cart');
            } else {
                Session::flash('user_login_err', 'Invalid password or user name');
                return redirect()->back();
            }
        }
    }
    public function checkEmail(Request $request)
    {
        $data = $request->all();
        $emailCount = User::where('email', $data['email'])->count();
        if ($emailCount > 0) {
            return "false";
        } else {
            return "true";
        }
    }
    public function checkMobileNo(Request $request)
    {
        $data = $request->all();
        $moblCount = User::where('mobile', $data['mobile'])->count();
        if ($moblCount > 0) {
            return "false";
        } else {
            return "true";
        }
    }
    public function logoutUser(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
