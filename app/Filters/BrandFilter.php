<?php
declare(strict_types=1);

namespace App\Filters;

use Domain\Catalog\Filters\AbstractFilter;
use Domain\Catalog\Models\Brand;
use Illuminate\Contracts\Database\Eloquent\Builder;

final class BrandFilter extends AbstractFilter
{

    #[\Override] public function title(): string
    {
        return 'Бренды';
    }

    #[\Override] public function key(): string
    {
        return 'brands';
    }

    #[\Override] public function apply(Builder $query): Builder
    {
        return $query->when($this->requestValue(), function(Builder $q) {
           $q->whereIn('brand_id', $this->requestValue());
        });
    }

    #[\Override] public function values(): array
    {
        return Brand::query()
            ->select(['id', 'title'])
            ->has('products')
            ->get()
            ->pluck('title', 'id')
            ->toArray();
    }

    #[\Override] public function view(): string
    {
        return 'catalog.filters.brands';
    }
}
