<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Frontend\UserRegRequest;

class UsersController extends Controller
{
    public function loginRegisterPage()
    {
        return view('frontend.pages.user.loginRegister');
    }
    public function registerUser(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $userCount = User::where('email', $data['email'])->count();
            if ($userCount > 0) {
                Session::flash('user_exist_msg', 'User already exist!');
                return redirect()->back();
            } else {
                // Form validation
                $validatedData = $request->validate([
                    'name' => 'required',
                    'email' => 'required|email',
                    'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                    'password' => 'required',
                ]);
                $validatedData['password'] = bcrypt($validatedData['password']);
                $validatedData['status'] = 1;
                User::create($validatedData);
                // Attempt to login the user
                if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                    //Update user cart with user id
                    if (!empty(Session::get('session_id'))) {
                        $user_id = Auth::user()->id;
                        $session_id = Session::get('session_id');
                        Cart::where('session_id', $session_id)->update(['user_id' => $user_id]);
                    }
                    return redirect('cart');
                }
                Session::flash('user_reg_msg', 'Registration successfull');
                return redirect()->back();
            }
        }
    }
    public function loginUser(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
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
