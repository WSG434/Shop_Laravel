<?php

namespace App\Http\Controllers;

use App\View\ViewModels\CatalogViewModel;
use Domain\Catalog\Models\Category;
use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class CatalogController extends Controller
{
   public function __invoke(?Category $category)
   {
       return (new CatalogViewModel($category))
           ->view('catalog.index');
   }
}
