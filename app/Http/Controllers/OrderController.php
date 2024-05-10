<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderFormRequest;
use Domain\Order\Models\DeliveryType;
use Domain\Order\Models\PaymentMethod;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $items = cart()->items();

        if($items->isEmpty()){
            throw new \DomainException('Корзина пуста');
        }

        return view('order.index', [
           'items' => $items,
           'payments' => PaymentMethod::query()->get(),
           'deliveries' => DeliveryType::query()->get()
        ]);
    }

    public function handle(OrderFormRequest $request): RedirectResponse
    {
        return redirect()
            ->route('home');
    }
}
