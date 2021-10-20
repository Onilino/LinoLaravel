<?php

namespace App\Http\Controllers;

use App\Models\Message;

class MessagesController extends Controller
{
    public function publish()
    {
        request()->validate([
           'message' => 'required',
        ]);

        auth()->user()->messages()->create([
            'content' => request('message'),
        ]);

        flash('Message successfully published !')->success();
        return back();
    }
}
