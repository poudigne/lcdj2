<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftdeletesToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) { $table->softDeletes(); });
        Schema::table('categories', function ($table) { $table->softDeletes(); });
        Schema::table('inventories', function ($table) { $table->softDeletes(); });
        Schema::table('media', function ($table) { $table->softDeletes(); });
        Schema::table('news', function ($table) { $table->softDeletes(); });
        Schema::table('products', function ($table) { $table->softDeletes(); });
        Schema::table('category_news', function ($table) { $table->softDeletes(); });
        Schema::table('category_product', function ($table) { $table->softDeletes(); });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) { $table->dropColumn('deleted_at'); });
        Schema::table('categories', function ($table) { $table->dropColumn('deleted_at'); });
        Schema::table('inventories', function ($table) { $table->dropColumn('deleted_at'); });
        Schema::table('media', function ($table) { $table->dropColumn('deleted_at'); });
        Schema::table('news', function ($table) { $table->dropColumn('deleted_at'); });
        Schema::table('products', function ($table) { $table->dropColumn('deleted_at'); });
        Schema::table('category_news', function ($table) { $table->dropColumn('deleted_at'); });
        Schema::table('category_product', function ($table) { $table->dropColumn('deleted_at'); });
    }
}
