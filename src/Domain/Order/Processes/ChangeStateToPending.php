<?php
declare(strict_types=1);

namespace Domain\Order\Processes;

use Domain\Order\Contracts\OrderProcessContract;
use Domain\Order\Models\Order;
use Domain\Order\States\PendingOrderState;

final class ChangeStateToPending implements OrderProcessContract
{
    #[\Override] public function handle(Order $order, $next)
    {
        $order->status->transitionTo(new PendingOrderState($order));

        return $next($order);
    }
}
