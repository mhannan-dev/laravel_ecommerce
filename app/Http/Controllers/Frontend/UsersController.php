<?php
namespace App\Http\Controllers\Frontend;
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
                    // echo "<pre>";print_r(Auth::user());die;
                    return redirect('cart');
                }
                Session::flash('user_reg_msg','Registration successfull');
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
