<?php

namespace App\Services;

use App\Repositories\UrlRepository;

class UrlService
{
    protected $repository;

    public function __construct(UrlRepository $repo)
    {
        $this->repository = $repo;
    }

    public function save($key, $url)
    {
        $this->repository->save($key, $url);
    }
}
