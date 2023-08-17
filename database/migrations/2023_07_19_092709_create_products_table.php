<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration
{
    public function up(): void

    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string( 'name');
            $table->text( 'description');
            $table->string( 'stock');
            $table->double( 'original_price');
            $table->double( 'selling_price');
            $table->string( 'sku');
            $table->string( 'image');
            $table->integer('category_id');
            $table->tinyInteger('feature')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
