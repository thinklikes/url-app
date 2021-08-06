<?php

namespace Services;

use App\Services\KeyGenerationService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Tests\TestCase;

class KeyGenerateServiceTest extends TestCase
{

    use DatabaseTransactions;

    public function testGenerateKeys()
    {
        $service = app(KeyGenerationService::class);

        $arr = $service->generateKeys(1, 16);

        $this->assertEquals([
            "1", "2", "3", "4", "5", "6", "7", "8", "9", "a", "b", "c", "d", "e", "f", "g"
        ],$arr);
    }

    public function testGenerateKeys2()
    {
        $service = app(KeyGenerationService::class);

        $arr = $service->generateKeys(99, 1);

        $this->assertEquals([
            "1B"
        ],$arr);
    }

    public function testFetchOne()
    {
        $expected = Str::random(8);
        DB::table('unused_keys')->insert([
           ['key' => $expected]
        ]);

        $service = app(KeyGenerationService::class);

        $key = $service->fetchOne();
        $this->assertEquals($expected, $key);
        $this->assertDatabaseHas('used_keys', ['key' => $expected]);
//        var_dump($arr);
    }
}
