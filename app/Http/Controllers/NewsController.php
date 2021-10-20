<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;

class NewsController extends Controller
{
    public function news()
    {
        $messages = auth()->user()
            ->following
            ->load('messages')
            ->flatMap->messages
            ->sortByDesc->created_at;

        return view('news', [
            'messages' => $messages,
        ]);
    }
}
