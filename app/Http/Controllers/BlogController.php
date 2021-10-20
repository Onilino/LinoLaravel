<?php

namespace App\Http\Controllers;

use App\Models\Channel;

class BlogController extends Controller
{
    public function home()
    {
        $channels = Channel::all();

        return view('blog.blog', [
            'channels' => $channels,
        ]);
    }
}
