<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserRegister;
use Illuminate\Support\Facades\Session;

class UserRegisterController extends Controller
{


    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:user_registers,username|max:255',
            'useremail' => 'required|email|unique:user_registers,useremail|max:255',
            'userpassword' => 'required|min:6',
        ]);
        UserRegister::create([
            'username' => $request->username,
            'useremail' => $request->useremail,
            'userpassword' => bcrypt($request->userpassword),
        ]);

        return redirect('/login')->with('success', 'Registration successful. Please login now!');
    }


    public function login(Request $request)
    {
        $request->validate([
            'username_or_email' => 'required',
            'password' => 'required',
        ]);
        $user = UserRegister::where('useremail', $request->username_or_email)
            ->orWhere('username', $request->username_or_email)
            ->first();
        if ($user && password_verify($request->password, $user->userpassword)) {
            // Session::put('username', $user->username);
            if ($user->userrole === 1) { 
                Session::put('user_id', $user->id);
                Session::put('admin', $user);
                return redirect('/admin-dashboard')->with('success', 'Welcome Admin!');
            } elseif ($user->userrole === 2) {
                Session::put('user_id', $user->id);
                Session::put('manager', $user);
                return redirect('/manager-dashboard')->with('success', 'Welcome Manager!');
            } elseif ($user->userrole === 3) { 
                Session::put('user_id', $user->id);
                Session::put('adviser', $user);
                return redirect('/adviser-dashboard')->with('success', 'Welcome Adviser!');
            }else{
                return redirect('/login')->with(['failure' => 'Please wait for admin approvel.']);
            }
            return redirect('/login')->withErrors(['username_or_email' => 'Please wait for admin approvel.']);
        }
    
        // Invalid credentials
        return back()
            ->withErrors(['username_or_email' => 'Invalid credentials.'])
            ->withInput();
    }
    

    public function logout()
    {
        Session::flush(); 
        return redirect('/login')->with('success', 'You have logged out successfully.');
    }


}
