<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('user_id');
            $table->string('amount');
            $table->string('total');
            $table->integer('quantity');
            $table->enum('status',['pending', 'accepted', 'inDelivery', 'success', 'cancel', 'refund'])->default('pending');
            $table->string('notes');
            $table->text('shippingAddress');
            $table->string('emailAddress');
            $table->string('username');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
