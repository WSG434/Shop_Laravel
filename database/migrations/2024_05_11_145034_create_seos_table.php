<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seos', function (Blueprint $table) {
            $table->id();

            $table->string('url')
                ->unique();

            $table->string('title');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        if(!app()->isProduction()){
            Schema::dropIfExists('seos');
        }
    }
};
