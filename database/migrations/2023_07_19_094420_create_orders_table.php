<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->enum('status', ['pending', 'accepted', 'inDelivery', 'success', 'cancel', 'refund'])->default('pending');
            $table->string('notes')->nullable();
            $table->text('shipping_address');
            $table->string('tracking_number');
            $table->integer('total');
            $table->string('admin_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
