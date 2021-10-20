<?php

namespace App\Http\Controllers;

use App\Helpers\SlugHelper;
use App\Models\Channel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ChannelController extends Controller
{
    protected const COLOURS = [ 'danger', 'primary', 'success', 'warning', 'black', 'dark', 'light', 'white', 'link', 'info' ];

    public function new()
    {
        flash('Unable to create channel (see errors in form)')->error();
        request()->validate([
            'name' => 'required',
            'colour' => [
                'required',
                Rule::in(self::COLOURS),
            ],
        ]);

        $name = request('name');
        $slug = SlugHelper::slugify($name);
        $colour = request('colour');

        if (Channel::where('slug', $slug)->exists()) {
            flash("Channel's name already exists")->error();
            return back()->withInput();
        }

        if (request('image')) {
            $illustration = basename(request('image')->store('channels', 'public'));
        }

        Channel::create([
            'name' => $name,
            'slug' => $slug,
            'illustration' => $illustration ?? null,
            'colour' => $colour
        ]);

        flash()->clear();
        flash('Channel successfully created !')->success();
        return back();
    }

    public function show($channel_id)
    {
        $channel = Channel::where('id', $channel_id)->first();

        return view('blog.channel', [
            'channel' => $channel,
        ]);
    }
}
