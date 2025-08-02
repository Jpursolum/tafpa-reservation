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
    Schema::create('cart_banners', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // e.g., "Deal of the Month"
        $table->string('subtitle'); // e.g., "Hikan Strawberry"
        $table->text('description');
        $table->string('discount_text'); // e.g., "30% off per kg"
        $table->string('image'); // path or URL
        $table->datetime('countdown_until')->nullable(); // for the timer
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_banners');
    }
};
