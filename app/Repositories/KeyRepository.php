<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class KeyRepository
{
    public function insertUnusedKeys(array $keys)
    {
        DB::beginTransaction();
        try {
            if (! empty($keys)) {
                foreach (array_chunk($keys, 1000) as $splice) {
                    DB::table('unused_keys')->insert($splice);
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
        }
        DB::commit();
    }

    public function getCountOfUnusedKeys()
    {
        return DB::table('unused_keys')->count();
    }

    public function fetchOne()
    {
        DB::beginTransaction();
        try {
            DB::commit();
            $key = DB::table('unused_keys')->lockForUpdate()->first()->key;

            DB::table('unused_keys')->where('key', $key)->delete();

            DB::table('used_keys')->insert([['key' => $key]]);
        } catch (\Exception $e) {
            DB::rollBack();
        }

        return $key;
    }
}
