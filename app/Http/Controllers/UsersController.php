<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;

class UsersController extends Controller
{
    public function listing()
    {

        return view('users', [
            'users' => User::all(),
        ]);
    }

    public function see()
    {
        $user = User::where('email', request('email'))->firstOrFail();

        return view('user', [
            'user' => $user,
        ]);
    }
}
