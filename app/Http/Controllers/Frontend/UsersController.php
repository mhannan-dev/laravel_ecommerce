<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Request;

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
    public function registerUser(Request $request)
    {
        dd($request);
        if ($request->isMethod('post')) {
            $data = $request->all();
            echo "<pre>";
            print_r($data);
            die;
        }
    }
}
