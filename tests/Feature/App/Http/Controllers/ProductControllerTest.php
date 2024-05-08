<?php

namespace Feature\App\Http\Controllers;

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProductController;
use Database\Factories\BrandFactory;
use Database\Factories\ProductFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_success_response(): void
    {
        $product = ProductFactory::new()->createOne();

        $this->get(action(ProductController::class, $product))
            ->assertOk();
    }

}
