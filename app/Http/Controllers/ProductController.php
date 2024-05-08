<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class ProductController extends Controller
{

    public function __invoke(Product $product): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $product->load(['optionValues.option']);

        session()->put('also.' . $product->id, $product->id);

        $also = Product::query()
            ->where(function ($q) use ($product){
                $q->whereIn('id', session('also'))
                    ->where('id', '!=', $product->id);
            })
            ->get();


        $options = $product->optionValues->mapToGroups(function($item){
            return [$item->option->title => $item];
        });

        return view('product.show', [
            'product' => $product,
            'options' => $options,
            'also' => $also
        ]);
    }
}
