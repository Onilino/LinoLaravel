<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Channel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ShowArticlesListTest extends TestCase
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
    function it_shows_articles_list()
    {
        Storage::fake('local');

        $channel = new Channel([
           'name' => 'discover',
           'slug' => 'discover',
           'illustration' => null,
           'colour' => 'black',
        ]);
        $channel->save();

        $content = <<<EOT
---
title: My article 1
youtube: https://www.youtube.com/embed/first
---

**very important**

EOT;

        Storage::put('blog/discover/salut1.md', $content);

        $article = new Article([
            'channel_id' => 1,
            'name' => 'salut1',
            'slug' => 'salut1',
            'youtube' => 'first',
            'file' => 'salut1.md'
        ]);
        $article->save();
        $content = <<<EOT
---
title: My article 2
youtube: https://www.youtube.com/embed/second
---

**very important**

EOT;

        Storage::put('blog/discover/salut2.md', $content);

        $article = new Article([
            'channel_id' => 1,
            'name' => 'salut2',
            'slug' => 'salut2',
            'youtube' => 'second',
            'file' => 'salut2.md'
        ]);
        $article->save();

        $this->get('blog/channels/1')
            ->assertSuccessful()
            ->assertSee('salut1')
            ->assertSee('salut2')
            ->assertSee('src="https://www.youtube.com/embed/first"', false)
            ->assertSee('src="https://www.youtube.com/embed/second"', false)
            ->assertSee('blog/articles/1')
            ->assertSee('blog/articles/2');
    }
}
