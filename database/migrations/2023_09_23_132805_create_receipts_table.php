<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->string('total');
            $table->enum('status', ['pending', 'accepted']);
            $table->string('notes');
            $table->string('tracking_number');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
