<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminAccount_model as AdminAccount;

class LoginController extends Controller
{
    
public function login(Request $request)
{
    
    $request -> validate([
        'username' => 'required|email',
        'password' => 'required|string',
    ]);

    $credentials = $request->only('username', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('dashboard');
    } else {
        return redirect()->back()->with('error', 'Invalid credentials');
    }


}
}
