<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class EncryptionTest extends TestCase
{
    public function testEcryption()
    {
        $encrypt = Crypt::encrypt('Eza Pratama');

        $decrypt = Crypt::decrypt($encrypt);

        self::assertEquals('Eza Pratama', $decrypt);
    }
}
