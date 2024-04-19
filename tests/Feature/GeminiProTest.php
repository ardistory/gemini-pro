<?php

namespace Tests\Feature;

use App\Repository\GeminiPro;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class GeminiProTest extends TestCase
{
    public function testGeminiPro()
    {
        $geminiPro1 = App::make(GeminiPro::class);
        $geminiPro2 = App::make(GeminiPro::class);

        $this->assertSame($geminiPro1, $geminiPro2);
    }
}
