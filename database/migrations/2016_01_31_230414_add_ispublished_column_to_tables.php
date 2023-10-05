<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIspublishedColumnToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function ($table) { $table->boolean('is_published')->default(0)->after('id'); });
        Schema::table('news',       function ($table) { $table->boolean('is_published')->default(0)->after('id'); });
        Schema::table('products',   function ($table) { $table->boolean('is_published')->default(0)->after('id'); });
        Schema::table('events',     function ($table) { $table->boolean('is_published')->default(0)->after('id'); });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function ($table) { $table->dropColumn('is_published'); });
        Schema::table('news',       function ($table) { $table->dropColumn('is_published'); });
        Schema::table('products',   function ($table) { $table->dropColumn('is_published'); });
        Schema::table('events',     function ($table) { $table->dropColumn('is_published'); });
    }
}
