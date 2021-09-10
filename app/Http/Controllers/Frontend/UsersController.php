<?php
namespace App\Http\Controllers\Frontend;
use App\Models\Cart;
use App\Models\User;
use App\Models\Country;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
class UsersController extends Controller
{
    public function loginRegisterPage()
    {
        Session::forget('error');
        Session::forget('success');
        return view('frontend.pages.user.loginRegister');
    }
    public function registerUser(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();
            $userCount = User::where('email', $data['email'])->count();
            if ($userCount > 0) {
                Session::flash('error', 'User already exist!');
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
                Session::put('success', $message);
                return redirect()->back();
            }
        }
    }
    public function loginUser(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                $userStatus = User::where('email', $data['email'])->first();

                if ($userStatus->status == 0) {
                    Auth::logout();
                    return redirect()->back()->with('error', 'Please confirm your email first');
                }
                //Update user cart with user id
                if (!empty(Session::get('session_id'))) {
                    $user_id = Auth::user()->id;
                    //echo "<pre>"; print_r($user_id); die;
                    $session_id = Session::get('session_id');
                    Cart::where('session_id', $session_id)->update(['user_id'=> $user_id]);
                }
                return redirect('/cart');
            } else {
                return redirect()->back()->with('error', 'Invalid password or user name');
            }
        }
    }
    public function checkEmail(Request $request)
    {
        $data = $request->all();
        $emailCount = User::where('email', $data['email'])->count();
        dd($emailCount);
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
    public function confirmAccount($email)
    {
        Session::forget('error');
        Session::forget('success');
        //Decode user email
        $email = base64_decode($email);
        //Check user email exist
        $userCount = User::where('email', $email)->count();
        if ($userCount > 0) {
            //User email alrady activated or not
            $userDetails = User::where('email', $email)->first();
            if ($userDetails->status == 1) {
                $message = "Your email account is already activated! Please login";
                Session::put('error', $message);
                return redirect('login-register');
            } else {
                //Update user status to 1
                User::where('email', $email)->update(['status' => 1]);
                //Send register email
                $messageData = ['name' => $userDetails['name'], 'email' => $userDetails['email'], 'mobile' => $userDetails['mobile'], 'email' => $email];
                Mail::send('emails.register', $messageData, function ($message) use ($email) {
                    $message->to($email);
                    $message->subject('Welcome to eCommerce website');
                });
                $message = "Your email account is activated! You can login now";
                Session::put('success', $message);
                return redirect('login-register');
            }
        } else {
            abort(404);
        }
    }
    public function forgotPassword(Request $request)
    {
        Session::forget('error');
        Session::forget('success');
        if ($request->isMethod('post')) {
            $data = $request->all();
            $emailCount = User::where('email', $data['email'])->count();
            if ($emailCount == 0) {
                $message = "This email does not exist";
                Session::put('error', $message);
                return redirect()->back();
            }
            $random_password = Str::random(8);
            $new_password = Hash::make($random_password);
            //Update password
            User::where('email', $data['email'])->update(['password' => $new_password]);
            //Get user name
            $userName = User::select('name')->where('email', $data['email'])->first();
            //Send forgot password email
            $email = $data['email'];
            $name = $userName->name;
            $messageData = [
                'email' => $email,
                'name' => $name,
                'password' => $random_password
            ];
            //dd($messageData['password']);
            Mail::send(
                'emails.forgot_pass',
                $messageData,
                function ($message) use ($email) {
                    $message->to($email);
                    $message->subject('New password eCommerce website');
                }
            );
            //Return back to login page
            $message = "Please check your inbox for new passsord";
            Session::put('success', $message);
            Session::forget('error');
            return redirect('login-register');
        }
        return view('frontend.pages.user.forgotPass');
    }
    public function logoutUser(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
    public function account(Request $request)
    {
        $title = "User account";
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id)->toArray();
        $countries = Country::get()->toArray();
        if ($request->isMethod('post')) {
            $data = $request->all();
            $user = User::find($user_id);
            $user->name = $data['name'];
            $user->address = $data['address'];
            $user->country = $data['country'];
            $user->state = $data['state'];
            $user->city = $data['city'];
            $user->pin_code = $data['pin_code'];
            $user->mobile = $data['mobile'];
            $user->save();
            $message = "Your information is updated";
            Session::put('success', $message);
            Session::forget('error');
            return redirect()->route('account')->with('success', $message);
        }
        return view('frontend.pages.user.account', compact('title', 'userDetails', 'countries'));
    }
    public function checkUserPassword(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            $user_id = Auth::user()->id;
            $checkPassword = User::select('password')->where('id', $user_id)->first();
            if (Hash::check($data['current_password'], $checkPassword['password'])) {
                return "true";
            } else {
                return "false";
            }
        }
    }
    public function updateUserPassword(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->all();
            $user_id = Auth::user()->id;
            $checkPassword = User::select('password')->where('id', $user_id)->first();
            if (Hash::check($data['current_password'], $checkPassword['password'])) {
                $new_password = Hash::make($data['new_password']);
                User::where('id', $user_id)->update(['password' => $new_password]);
                $message = "Your password is updated";
                Session::put('success', $message);
                Session::forget('error');
                return redirect()->back();
            } else {
                $message = "Your password is incorrect";
                Session::put('error', $message);
                Session::forget('success');
                return redirect()->back();
            }
        }
    }
}
