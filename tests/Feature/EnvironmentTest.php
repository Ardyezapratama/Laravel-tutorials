<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testEnvironment()
    {
        $authorName = env('AUTHOR_NAME');
        self::assertEquals('EzaPrat', $authorName);
    }

    public function testDefaultEnv(): void
    {
        $projectType = env('PROJECT_TYPE', 'Individual');
        self::assertEquals('Individual', $projectType);
    }
}
