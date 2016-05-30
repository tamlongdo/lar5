<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class AuthController extends Controller{
    
    public function register(Request $request) {
        if ($request->isMethod('get')) {
            User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            ]);
        }
    
        return redirect()->route('admin.login');
    }
    
    public function authenticate(Request $request) 
    {
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) 
        {
            return redirect()->route('admin.home');
        } else 
        {
            return view('back.auth.login');
        }
    }
    
    public function login()
    {
        return view('back.auth.login');
    }
    
    public function logout() {
        Auth::logout();
    
        return redirect()->route('admin.login');
    }
}