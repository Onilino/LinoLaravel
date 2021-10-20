<?php

namespace App\Http\Controllers;

use App\Mail\NewFollower;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class FollowsController extends Controller
{
    public function create()
    {
        $follower = auth()->user();
        $followed = User::where('email', request('email'))->firstOrFail();

        $follower->following()->attach($followed);

        Mail::to($followed)->send(new NewFollower($follower));

        flash('You are now following ' . $followed->email)->success();
        return back();
    }

    public function delete()
    {
        $follower = auth()->user();
        $followed = User::where('email', request('email'))->firstOrFail();

        $follower->following()->detach($followed);

        flash("You are now not following anymore $followed->email")->success();
        return back();
    }
}
