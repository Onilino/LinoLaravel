<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomepageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @test
     * @return void
     */
    function it_shows_the_homepage()
    {
        $this->get('/')
            ->assertSuccessful()
            ->assertViewIs('users');
    }
}
