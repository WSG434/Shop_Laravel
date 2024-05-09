<?php

use Domain\Cart\Models\CartItem;
use Domain\Product\Models\OptionValue;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cart_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('product_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->unsignedBigInteger('price');

            $table->unsignedBigInteger('quantity');

            $table->string('string_option_values')
                ->nullable();

            $table->timestamps();

        });


        Schema::create('cart_item_option_value', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(CartItem::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignIdFor(OptionValue::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->timestamps();
        });



    }

    public function down(): void
    {
        if(!app()->isProduction()){
            Schema::dropIfExists('cart_items');
        }
    }
};
