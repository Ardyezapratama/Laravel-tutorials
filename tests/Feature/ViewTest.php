<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testViewHello()
    {
        $this->get('/hello')
            ->assertStatus(200)
            ->assertViewIs('hello')
            ->assertSeeText('Hello Ratri');

        $this->get('/hello-again')
            ->assertStatus(200)
            ->assertViewIs('hello')
            ->assertSeeText('Hello Eza');
    }

    public function testViewHelloWorld()
    {
        $this->get('hello-world')
            ->assertStatus(200)
            ->assertViewIs('hello.world')
            ->assertSeeText('World Eza');
    }

    public function testTemplate()
    {
        $this->view('hello', ['name' => 'Eza'])
            ->assertSeeText('Hello Eza');
    }

}
