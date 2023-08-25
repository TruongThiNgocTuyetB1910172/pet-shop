<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('user_name');
            $table->string('house_number');
            $table->string('phone_number');
            $table->string('address');
            $table->integer('ward_id');
            $table->integer('district_id');
            $table->integer('province_id');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
