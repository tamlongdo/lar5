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
    
    /**
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $remember = ($request->has('remember')) ? true : false;
            $this->validate($request, [
                'email'     => 'required|email',
                'password'  => 'required',
                'remember'  =>  ''
            ]);
            
            if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $remember))
            {
                return redirect()->route('admin.home');
            }
            else
            {
                session()->flash('msg','Username or password was invalid!');
                return redirect()->route('admin.login')->withInput();
            }
        }
        return view('back.auth.login');
    }
    
    /**
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout() {
        Auth::logout();
    
        return redirect()->route('admin.login');
    }
}