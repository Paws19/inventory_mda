<?php

namespace App\Http\Controllers\RedirectController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetController extends Controller
{
    public function dashboard(){
        return view('homepage.homepage');
    }

    public function loginPage(){
        return view('layout.loginpage');
    }
}
