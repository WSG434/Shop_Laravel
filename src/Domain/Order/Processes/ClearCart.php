<?php
declare(strict_types=1);

namespace Domain\Order\Processes;

use Domain\Order\Contracts\OrderProcessContract;
use Domain\Order\Models\Order;

final class ClearCart implements OrderProcessContract
{

    #[\Override] public function handle(Order $order, $next)
    {
        cart()->truncate();
        return $next($order);
    }
}
