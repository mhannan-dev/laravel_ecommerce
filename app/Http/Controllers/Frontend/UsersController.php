<?php
namespace App\Http\Controllers\Frontend;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
                $user = new User;
                $user->name = $data['name'];
                $user->mobile = $data['email'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->status = 1;
                $user->save();
                // Attempt to login the user
                if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                    // echo "<pre>";print_r(Auth::user());die;
                    return redirect('cart');
                }
                Session::flash('user_reg_msg', 'Registration successfull');
                return redirect()->back();
            }
        }
    }
    public function loginUser()
    {
        # code...
    }
    public function logoutUser(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
