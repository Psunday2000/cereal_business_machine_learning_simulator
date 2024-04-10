<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuantityBoughtToSalesTable extends Migration
{
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->integer('quantity_bought');
        });
    }

    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn('quantity_bought');
        });
    }
}
