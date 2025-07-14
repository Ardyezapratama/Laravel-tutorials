<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FacadeTest extends TestCase
{
    public function testConfig()
    {
        $firstName = config('contoh.author.first');
        $firstName2 = Config::get('contoh.author.first');

        self::assertEquals($firstName, $firstName2);
    }

    public function testMockFacade()
    {
        Config::shouldReceive('get')->with('contoh.author.first')->andReturn('Ratri Septya');
        $firstName = Config::get('contoh.author.first');

        self::assertEquals('Ratri Septya', $firstName);
    }
}
