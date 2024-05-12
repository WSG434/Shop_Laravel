<?php
declare(strict_types=1);

namespace Domain\Order\Actions;

use App\Http\Requests\OrderFormRequest;
use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\DTOs\NewUserDTO;
use Domain\Order\DTOs\CustomerOrderDTO;
use Domain\Order\DTOs\OrderDTO;
use Domain\Order\Models\Order;

final class NewOrderAction
{
    public function __invoke(OrderDTO $order, CustomerOrderDTO $customer, bool $createAccount)
    {
        $registerAction = app(RegisterNewUserContract::class);

        if($createAccount){
            $registerAction(NewUserDTO::make(
                $customer->fullName(),
                $customer->email,
                $order->password
            ));
        }

        return Order::query()->create([
//           'user_id' => auth()->id(),
            'payment_method_id' => $order->payment_method_id,
            'delivery_type_id' => $order->delivery_type_id
        ]);
    }
}
