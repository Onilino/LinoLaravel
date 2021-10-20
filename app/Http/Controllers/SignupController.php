<?php

namespace App\Http\Controllers;

use App\Models\User;

class SignupController extends Controller
{
    public function  form()
    {
        if (auth()->check()) {
            return redirect('/');
        }

        return view('signup');
    }

    public function signup()
    {
        request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:8'],
            'password_confirmation' => ['required']
        ], [
            'password.min' => 'For safety reasons, you must provides at least a 8 characters password\'s length.'
        ]);

        $email = strtolower(request('email'));

        if (User::where('email', 'like', $email)->exists()) {
            return redirect('/signup')
                ->withErrors([
                    'email' => 'User email already exists',
                ])->withInput();
        }

        User::create([
            'email' => $email,
            'password' => bcrypt(request('password'))
        ]);

        auth()->attempt([
            'email' => $email,
            'password' => request('password'),
        ]);

        flash('User <b>' . request('email') . '</b> successfully saved')->success();
        return redirect('/');
    }
}
