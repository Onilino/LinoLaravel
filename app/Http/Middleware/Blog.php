<?php

namespace App\Http\Middleware;

use App\Models\Article;
use App\Models\Channel;
use Closure;
use Illuminate\Http\Request;

class Blog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->channel_id) {
            Channel::where('id', $request->channel_id)->firstOrFail();
        } else if ($request->article_id) {
            Article::where('id', $request->article_id)->firstOrFail();
        }

        return $next($request);
    }
}
