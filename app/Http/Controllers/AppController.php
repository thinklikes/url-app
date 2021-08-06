<?php

namespace App\Http\Controllers;

use App\Services\KeyGenerationService;
use App\Services\UrlService;
use Illuminate\Http\Request;

class AppController extends Controller
{
    protected $urlService;
    protected $keyService;

    public function __construct(UrlService $urlService, KeyGenerationService $keyService)
    {
        $this->urlService = $urlService;
        $this->keyService = $keyService;
    }

    public function shortening(Request $request)
    {
        try {
            $url = $request->input('url');
            $key = $this->keyService->fetchOne();
            $this->urlService->save($url, $key);
        } catch (\Exception $e) {
            var_dump($e->getFile());
            var_dump($e->getLine());
            var_dump($e->getMessage());
            return response()->json('', 404);
        }


        return response()->json(['shortening' => url("/" . $key)]);
    }
}
