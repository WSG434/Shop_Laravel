<?php

namespace App\Models;

use App\Jobs\ProductJsonProperties;
use Domain\Catalog\Facades\Sorter;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Queue\Queue;
use Support\Casts\PriceCast;
use Support\Traits\Models\HasSlug;

class Product extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'brand_id',
        'price',
        'thumbnail',
        'on_home_page',
        'sorting',
        'text',
        'json_properties'
    ];

    protected $casts = [
        'price' => PriceCast::class,
        'json_properties' => 'array'
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::created(function (Product $product){

            ProductJsonProperties::dispatch($product)
                ->delay(now()->addSeconds(2));

        });
    }

    public function scopeFiltered(Builder $query)
    {

        return app(Pipeline::class)
            ->send($query)
            ->through(filters())
            ->thenReturn();
    }

    public function scopeSorted(Builder $query)
    {
        Sorter::run($query);
    }

    public function scopeHomePage(Builder $query)
    {
        $query->where('on_home_page', true)
            ->orderBy('sorting')
            ->limit(6);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class)
            ->withPivot('value');
    }

    public function optionValues(): BelongsToMany
    {
        return $this->belongsToMany(OptionValue::class);
    }
}
