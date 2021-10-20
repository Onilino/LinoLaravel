<?php

namespace App\Http\Controllers;

class AccountController extends Controller
{
    public function logout()
    {
        auth()->logout();

        flash('You are now disconnected !')->success();
        return redirect('/');
    }

    public function changePassword()
    {
        request()->validate([
            'old-password' => 'required',
            'new-password' => ['required', 'confirmed', 'min:8'],
            'new-password_confirmation' => 'required',
        ]);

        auth()->user()->update([
           'password' => bcrypt(request('new-password')),
        ]);

        flash('Password successfully modified !')->success();
        return redirect('/my-account');
    }

    public function changeAvatar()
    {
        request()->validate([
            'avatar' => ['required', 'image'],
        ]);

        $file = basename(request('avatar')->store('avatars', 'public'));
        auth()->user()->update([
            'avatar' => $file,
        ]);

        flash('Your avatar have been updated !')->success();
        return back();
    }
}
