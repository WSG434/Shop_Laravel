<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProductJsonProperties implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @return void
     */
    public function __construct(
        public Product $product
    )
    {
    }

    public function handle(): void
    {
        $properties = $this->product->properties
            ->mapWithKeys(fn($property) => [$property->title => $property->pivot->value]);

        $this->product->updateQuietly(['json_properties' => $properties]);
    }

    public function uniqueId()
    {
        return $this->product->id;
    }
}
