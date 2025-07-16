<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RedirectControllerTest extends TestCase
{
    public function testRedirect(): void
    {
        $this->get('/redirect/from')
            ->assertRedirect('/redirect/to');
    }

    public function testRedirectHello(): void
    {
        $this->get('/redirect/name')
            ->assertRedirect('/redirect/name/Eza');
    }

    public function testRedirectAction(): void
    {
        $this->get('/redirect/action')
            ->assertRedirect('/redirect/name/Eza');
    }

    public function testRedirectAway(): void
    {
        $this->get('/redirect/abouteza')
            ->assertRedirect('https://ezapratama-portfolio.vercel.app/');
    }

}
