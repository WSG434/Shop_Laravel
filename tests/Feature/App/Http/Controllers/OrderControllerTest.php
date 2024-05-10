<?php
declare(strict_types=1);

namespace Feature\App\Http\Controllers;

use Domain\Order\Enums\OrderStatuses;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_mytest(): void
    {
        dd(OrderStatuses::cases());
//        dd(array_column(OrderStatuses::cases(), 'value'));
    }

}
