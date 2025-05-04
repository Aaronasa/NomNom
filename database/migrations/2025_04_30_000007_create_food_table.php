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
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->string('foodName');
            $table->string('foodDescription');
            $table->string('foodPrice');
            $table->string('foodImage');
            $table->foreignId('restaurant_id')->constrained(
                table: 'restaurants',
                indexName: 'Restaurant_Food_Id'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};
