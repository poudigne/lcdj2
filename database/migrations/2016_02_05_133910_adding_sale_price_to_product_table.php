<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddingSalePriceToProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('products', function ($table) {
           $table->dropColumn('price');
           $table->decimal('sale_price', 5,2)->default(0.00);
            $table->decimal('cost_price', 5,2)->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function ($table) {
            $table->decimal('price', 5,2)->nullable();
            $table->dropColumn('sale_price');
            $table->dropColumn('cost_price');
        });
    }
}
