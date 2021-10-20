<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function form()
    {
        if (auth()->check()) {
            return redirect('/');
        }

        return view('login');
    }

    public function login()
    {
        request()->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        $auth_statut = auth()->attempt([
            'email' => strtolower(request('email')),
            'password' => request('password'),
        ]);

        if ($auth_statut) {
            flash('You are now connected !')->success();
            return back();
        }

        return back()->withInput()->withErrors([
                'email' => 'Your credentials are incorrect'
        ]);
    }
}
