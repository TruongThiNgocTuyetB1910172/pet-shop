<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('service_service_packages', function (Blueprint $table) {
            $table->id();
            $table->integer('service_id');
            $table->integer('service_package_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_service_packages');
    }
};
