<?php

namespace App\Http\Controllers;

use App\Helpers\SlugHelper;
use App\Models\Article;
use App\Models\Channel;
use Illuminate\Support\Facades\Storage;
use Mni\FrontYAML\Parser;

class ArticleController extends Controller
{
    public function new($channel_id)
    {
        flash('Unable to create article (see errors in form)')->error();
        request()->validate([
            'name' => 'required',
            'file' => ['required', 'mimetypes:text/plain'],
        ]);

        $name = request('name');
        $slug = SlugHelper::slugify($name);
        $youtube = substr(strstr(request('youtube'), 'v='), 2) ?? null;
        $file = $slug . '.md';

        if (Article::where([
                ['slug', $slug],
                ['channel_id', $channel_id],
            ])->exists()) {
            flash("Article's name already exists for this channel")->error();
            return back()->withInput();
        }


        $article = Article::create([
            'channel_id' => $channel_id,
            'name' => $name,
            'slug' => $slug,
            'youtube' => $youtube,
            'file' => $file,
        ]);

        Storage::put("blog/{$article->channel->slug}/{$file}", request('file')->get());

        flash()->clear();
        flash("Article successfully created on channel {$article->channel->name} !")->success();
        return back();
    }

    public function show($article_id)
    {
        $article = Article::where('id', $article_id)->first();
        $content = Storage::get("blog/{$article->channel->slug}/{$article->file}");
        $parser = new Parser();

        return view('blog.article', [
            'article' => $article,
            'content' => $parser->parse($content)->getContent(),
        ]);
    }
}
