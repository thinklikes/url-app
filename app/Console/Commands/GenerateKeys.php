<?php

namespace App\Console\Commands;

use App\Services\KeyGenerationService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class GenerateKeys extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:keys-generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(KeyGenerationService $service)
    {
        while(true) {
            $start = Cache::get('url_key', 0) + 1;

            $after = $service->generateKeys($start);
            if ($after > $start) {
                Cache::set('url_key', $after);
            }
            usleep(500);

        }

        return 0;
    }
}
