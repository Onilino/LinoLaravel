<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Channel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ShowArticleTest extends TestCase
{
    /**
     * @TODO Use a fake database
     */
    //use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @test
     * @return void
     */
    function it_shows_an_article_with_youtube_video()
    {
        Storage::fake('local');

        $content = <<<EOT
---
title: My title
youtube: https://www.youtube.com/embed/abcde
---

**very important**

EOT;

        $channel = new Channel([
            'name' => 'discover',
            'slug' => 'discover',
            'illustration' => null,
            'colour' => 'black',
        ]);
        $channel->save();

        $article = new Article([
            'channel_id' => 1,
            'name' => '2018/01/01 Test',
            'slug' => '2018-01-01-test',
            'youtube' => 'first',
            'file' => '2018-01-01-test.md'
        ]);
        $article->save();

        Storage::put('blog/discover/2018-01-01-test.md', $content);

        $this->get('blog/articles/1')
            ->assertSuccessful()
            ->assertSee('2018/01/01 Test')
            ->assertSee('src="https://www.youtube.com/embed/first"', false)
            ->assertSee('<strong>very important</strong>', false);
    }
}
