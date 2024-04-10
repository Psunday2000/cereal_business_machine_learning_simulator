<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('stocks', function (Blueprint $table) {
        $table->id();
        $table->integer('year');
        $table->foreignId('product_id')->constrained();
        $table->integer('quantity_produced');
        $table->integer('quantity_sold')->default(0);
        $table->integer('leftover_stock')->default(0);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
