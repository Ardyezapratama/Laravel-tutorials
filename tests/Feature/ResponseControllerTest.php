<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    public function testResponse()
    {
        $this->get('/response/hello')
            ->assertStatus(200)
            ->assertSeeText('Hello Response');
    }

    public function testHeader()
    {
        $this->get('/response/header')
            ->assertStatus(200)
            ->assertSeeText('Eza')
            ->assertSeeText('Pratama')
            ->assertHeader('Content-Type', 'application/json')
            ->assertHeader('Author', 'Eza Pratama')
            ->assertHeader('App', 'Belajar Laravel');
    }

    public function testView(): void
    {
        $this->get('/response/type/view')
            ->assertSeeText('Hello Eza');
    }

    public function testJson(): void
    {
        $this->get('/response/type/json')
            ->assertJson([
                'firstname' => 'Eza',
                'lastname' => 'Pratama'
            ]);
    }

    public function testFile(): void
    {
        $this->get('/response/type/file')
            ->assertHeader('Content-Type', 'image/png');
    }

    public function testDonwnload(): void
    {
        $this->get('/response/type/download')
            ->assertDownload('eza-4.png');
    }
}
