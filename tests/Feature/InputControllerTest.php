<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/input/hello?name=Eza')
            ->assertSeeText('Hello Eza');

        $this->post('/input/hello', [
            'name' => 'Ratri',
        ])->assertSeeText('Hello Ratri');
    }

    public function testInputNested()
    {
        $this->post('/input/hello/first', [
            'name' => [
                'first' => 'Eza',
                'last' => 'Pratama'
            ],
        ])->assertSeeText('Hello Eza');
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input', [
            'name' => [
                'first' => 'Eza',
                'last' => 'Pratama'
            ],
        ])->assertSeeText('name')
            ->assertSeeText('first')
            ->assertSeeText('last')
            ->assertSeeText('Eza')
            ->assertSeeText('Pratama');
    }

    public function testInputArray()
    {
        $this->post('/input/hello/array', [
            'products' => [
                [
                    'name' => 'Apple Mac Book Pro',
                    'price' => 15000000,
                ],
                [
                    'name' => 'MSI Cyborg 15',
                    'price' => 12000000,
                ]
            ]
        ])->assertSeeText("Apple Mac Book Pro")
            ->assertSeeText("MSI Cyborg 15");
    }
}
