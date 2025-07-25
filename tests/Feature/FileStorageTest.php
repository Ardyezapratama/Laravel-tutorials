<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileStorageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStorage()
    {
        $filesystem = Storage::disk('local');
        $filesystem->put('file.txt', 'Ardy Eza Pratama');

        $content = $filesystem->get('file.txt');

        self::assertEquals('Ardy Eza Pratama', $content);
    }

    public function testStoragePublic()
    {
        $filesystem = Storage::disk('public');
        $filesystem->put('file.txt', 'Ardy Eza Pratama');
        $content = $filesystem->get('file.txt');
        self::assertEquals('Ardy Eza Pratama', $content);
    }
}
