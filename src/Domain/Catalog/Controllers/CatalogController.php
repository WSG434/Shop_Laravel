<?php

namespace Domain\Catalog\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordFormRequest;
use App\Models\Product;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Domain\Catalog\ViewModels\CategoryViewModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;

class CatalogController extends Controller
{


   public function __invoke(?Category $category)
   {
       $brands = Brand::query()
           ->select(['id', 'title'])
           ->has('products')
           ->get();

       $categories = Category::query()
           ->select(['id', 'title', 'slug'])
           ->has('products')
           ->get();

       $products = Product::query()
           ->select(['id', 'title', 'slug', 'price', 'thumbnail'])
           ->paginate(6);

       return view('catalog.index', [
           'products' => $products,
           'categories' => $categories,
           'brands' => $brands,
           'category' => $category
       ]);
   }
}
