<?php
declare(strict_types=1);

namespace App\Providers;

use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\ServiceProvider;
use Support\FakerImageProvider;

class TestingServiceProvider extends ServiceProvider
{
    public function register() :void
    {
        $this->app->singleton(Generator::class, function (){
            $faker = Factory::create();
            $faker->addProvider(new FakerImageProvider($faker));
            return $faker;
        });
    }

    public function boot() :void
    {

    }
}
