<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamp('orderDate');
            $table->decimal('totalPrice');
            $table->string('paymentStatus');
            // $table->dropForeign(['user_id']);
            $table->foreignId('user_id')
            ->constrained('users')
            ->index('user_order_id')
            ->references('id')->on('users')
            ->onDelete('cascade'); ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
