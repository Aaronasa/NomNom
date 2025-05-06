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
            Schema::create('order_details', function (Blueprint $table) {
                $table->id();
                $table->decimal('price', 8, 2);
                $table->string('unit');
                $table->string('namapenerima')->nullable();
                $table->string('image')->nullable();
                $table->foreignId('deliveryStatus_id')->constrained('delivery_statuses')->onDelete('cascade');
                $table->foreignId('menuDay_id')->constrained('menu_days')->onDelete('cascade');
                $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
