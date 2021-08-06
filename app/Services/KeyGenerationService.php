<?php

namespace App\Services;

use App\Repositories\KeyRepository;

class KeyGenerationService
{
    const MAX_COUNT_OF_UNUSED_KEYS = 10000;
    protected $repository;

    public function __construct(KeyRepository $repo)
    {
        $this->repository = $repo;
    }

    public function generateKeys(int $start): int
    {
        $length = self::MAX_COUNT_OF_UNUSED_KEYS - $this->repository->getCountOfUnusedKeys();

        if ($length == 0) {
            return $start;
        }

        $keys = array_map(function ($num) {
            return ['key' => $this->base10to62($num)];
        }, range($start, ($start + $length - 1)));

        $this->repository->insertUnusedKeys($keys);

        return ($start + $length - 1);
    }

    protected function base10to62(int $num): string
    {
        $b = 62;
        $base='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $r = $num  % $b ;
        $res = $base[$r];
        $q = floor($num/$b);
        while ($q) {
            $r = $q % $b;
            $q =floor($q/$b);
            $res = $base[$r].$res;
        }

        return $res;
    }

    public function fetchOne()
    {
        return $this->repository->fetchOne();
    }
}
