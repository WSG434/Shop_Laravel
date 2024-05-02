<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RefreshCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shop:refresh';

    protected $description = 'Refresh';

    public function handle(): int
    {
        if(app()->isProduction()){
            return self::FAILURE;
        }

        Storage::deleteDirectory('images/products');
        Storage::createDirectory('images/products');

        $this->call('migrate:fresh',[
            '--seed' => true
        ]);


        return self::SUCCESS;
    }
}
