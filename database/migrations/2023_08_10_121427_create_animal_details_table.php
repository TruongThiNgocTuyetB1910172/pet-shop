<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('animal_details', function (Blueprint $table) {
            $table->id();
            $table->string('weight');
            $table->integer('animal_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animal_details');
    }
};
