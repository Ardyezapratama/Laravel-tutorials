<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CookieControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateCookie()
    {
        $this->get('/cookie/set')
            ->assertSeeText('Hello Cookie')
            ->assertCookie('User-Id', 'ezapratama')
            ->assertCookie('Is-Member', 'true');
    }

    public function testGetCookie()
    {
        $this->withCookie('User-Id', 'ezapratama')
            ->withCookie('Is-Member', 'true')
            ->get('/cookie/get')
            ->assertJson([
                'userId' => 'ezapratama',
                'isMember' => 'true'
            ]);
    }
}
