<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testGet()
    {
        $this->get('/pzn')
            ->assertStatus(200)
            ->assertSeeText('Hello Programmer Zaman Now');
    }

    public function testRedirect()
    {
        $this->get('/youtube')
            ->assertStatus(302) // Redirect status
            ->assertRedirect('/pzn');
    }

    public function testFallback()
    {
        $this->get('/404')
            ->assertSeeText('404');
    }

    public function testRouteParameter()
    {
        $this->get('products/1')
            ->assertSeeText('Product 1');

        $this->get('products/2')
            ->assertSeeText('Product 2');

        $this->get('/products/1/items/XXX')
            ->assertSeeText('Product 1, Item XXX');
    }

    public function testRouterParameterRegex()
    {
        $this->get('categories/93')
            ->assertSeeText('Category 93');

        $this->get('categories/eza')
            ->assertSeeText('404 by Eza Pratama');
    }

    public function testRouterOptionalParameter()
    {
        $this->get('users/eza')
            ->assertSee('User : eza');

        $this->get('users/')
            ->assertSeeText('User : 404');
    }

    public function testRouteConflict()
    {
        $this->get('conflict/ratri')
            ->assertSeeText('Conflict ratri');

        $this->get('conflict/eza')
            ->assertSeeText('Conflict Eza Pratama');
    }

    public function testNamedRoute()
    {
        $this->get('/produk/12345')
            ->assertSeeText('Link http://localhost/products/12345');

        $this->get('/produk-redirect/12345')
            ->assertRedirect('/products/12345');
    }
}
