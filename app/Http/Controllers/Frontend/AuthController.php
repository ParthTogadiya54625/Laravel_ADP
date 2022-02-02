<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('frontend.auth.login');
    }

    public function login(Request $request)
    {
        // return $request->all();
        $userInfo = User::where('email', $request->email)->first();
        if (!$userInfo) {
            return back()->with('error', 'We do not recognize your email address...');
        } else {
            if ($userInfo->hasRole('user')) {
                if (Hash::check($request->password, $userInfo->password)) {
                    if ($userInfo->status != 0) {
                        Auth::login($userInfo);
                        return redirect(route('frontend.dashboard'))->with('success', 'Login Successfull...');
                    } else {
                        return back()->with('error', 'Your account is currently disactivate...!');
                    }
                } else {
                    return back()->with('error', 'Incorrect password...!');
                }
            }else{
                return back()->with('error', 'You are not user...!');
            }
        }
    }

    public function dashboard()
    {
        return view('frontend.dashboard.dashboard');
    }

    public function logout()
    {
        if (Auth::user()) {
            Auth::logout();
            return redirect(route('frontend.login'))->with('success', 'Logout Successfull...!');
        }
    }
}
