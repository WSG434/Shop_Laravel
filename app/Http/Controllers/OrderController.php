<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderFormRequest;
use Database\Factories\BrandFactory;
use Domain\Order\Actions\NewOrderAction;
use Domain\Order\Models\DeliveryType;
use Domain\Order\Models\PaymentMethod;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function handle(OrderFormRequest $request, NewOrderAction $action): RedirectResponse
    {
        $order = $action($request);
        return redirect()
            ->route('home');
    }
}
