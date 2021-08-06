<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class UrlRepository
{
    public function save(string $url, string $key)
    {
        DB::table('urls')->insert([['url' => $url, 'key' => $key]]);
    }
}
