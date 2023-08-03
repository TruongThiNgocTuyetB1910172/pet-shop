<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration
{
    public function up(): void
    {
        Schema::create('service_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->double( 'original_price')->nullable();
            $table->double( 'selling_price')->nullable();
            $table->string('image');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_packages');
    }
};
