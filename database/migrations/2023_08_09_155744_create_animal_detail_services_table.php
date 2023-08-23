<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('animal_detail_services', function (Blueprint $table) {
            $table->id();
            $table->integer('service_id');
            $table->integer('animal_detail_id');
            $table->double('price');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animal_detail_services');
    }
};
