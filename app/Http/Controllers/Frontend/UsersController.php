<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function loginRegister()
    {

        return view('frontend.pages.user.loginRegister');
    }
    public function loginUser()
    {
        # code...
    }
    public function registerUser()
    {
        # code...
    }
}
