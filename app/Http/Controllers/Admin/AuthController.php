<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\GetData;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ChangeProfile;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function loginForm()
    {
        return view('admin.auth.login');
    }

    public function loginFormSubmit(LoginRequest $request)
    {
        $userInfo = User::where('email', $request->email)->first();
        if (!$userInfo) {
            return back()->with('error', 'We do not recognize your email address...');
        } else {
            if (Hash::check($request->password, $userInfo->password)) {
                if ($userInfo->status != 0) {
                    Auth::login($userInfo);
                    // $request->session()->put('LoggedUser', $userInfo);
                    return redirect(route('admin.auth.dashboard'))->with('success', 'Login Successfull...');
                } else {
                    return back()->with('error', 'Your account is currently disactivate...!');
                }
            } else {
                return back()->with('error', 'Incorrect password...!');
            }
        }
    }

    public function forgotePasswordForm()
    {
        return view('admin.auth.forgot_password');
    }

    public function forgotePasswordFormSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required'
        ]);
        // dd($request->all());
        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPasswordForm($token, Request $request)
    {
        $data = DB::table('password_resets')->where(['email'=>$request->email, 'token'=>$token])->first();
        if ($data) {
            return view('admin.auth.reset_password', ['email' => $request->email, 'token' => $token])->with('success', 'Your email has been successfully verirfy');
        }
        return "Token Expired";
        // return redirect('/')->with("error","token expired...");
    }

    public function resetPasswordFormSubmit(ResetPasswordRequest $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    // 'status' => config("constants.user.status_code.active"),
                ])->setRememberToken(Str::random(60));
                $user->save();
                Auth::login($user);
                // session()->put('LoggedUser', $user);
            }
        );
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('admin.auth.dashboard')->with('success', __($status))
            : back()->withErrors(['password' => [__($status)]]);
    }

    public function changePasswordForm()
    {
        return view('admin.auth.change_password');
    }

    public function changePasswordFormSubmit(ChangePasswordRequest $request)
    {
        // $user = User::find($request->id);
        $user = GetData::getUserDetail($request->id);
        if (Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();

            return back()->with('success', 'Your password has been changed successfully...!');
        } else {
            return back()->with('error', 'Please enter correct Current Password...!');
        }
    }

    public function changeProfile()
    {
        return view('admin.auth.change_profile');
    }

    public function userProfileFormSubmit(ChangeProfile $request)
    {
        $user = GetData::getUserDetail($request->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->company = $request->company;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->address2 = $request->address2;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->zipcode = $request->zipcode;
        $user->url = $request->url;
        if ($request->hasFile('logo'))
        {
            if ($user->logo) {
                File::delete(public_path('storage/publishers/') . $user->logo);
            }
            $image = $request->file('logo');
            $imageName = 'publisher-' . $user->id . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/publishers'), $imageName);
            $user->logo = $imageName;
        }
        $user->save();

        Auth::setUser($user);
        // $user->makeHidden(['email']);
        return back()->with('success', 'Your profile has been changed successfully...!');
    }

    public function logout()
    {
        if (Auth::user()) {
            Auth::logout();
            return redirect(route("admin.auth.loginForm"))->with('success', 'Logout Successfull...!');
        }
    }
}
