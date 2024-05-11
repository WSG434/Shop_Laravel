<?php
declare(strict_types=1);

namespace Domain\Order\Processes;

use Domain\Order\Contracts\OrderProcessContract;
use Domain\Order\Exceptions\OrderProccessException;
use Domain\Order\Models\Order;

final class CheckProductQuantities implements OrderProcessContract
{

    #[\Override] public function handle(Order $order, $next)
    {
        foreach (cart()->items() as $item) {
            if($item->product->quantity < $item->quantity){
                throw new OrderProccessException('Не осталось товара');
            }
        }

        return $next($order);
    }
}
