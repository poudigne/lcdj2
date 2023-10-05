<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnProductInsertTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::unprepared('
          CREATE TRIGGER tr_on_product_insert AFTER INSERT ON `products` FOR EACH ROW
               BEGIN
                   INSERT INTO inventories (`product_id`, `created_at`, `updated_at`) VALUES (NEW.id, now(), now());
               END
          ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    public function down()
    {
        DB::unprepared('DROP TRIGGER `tr_on_product_insert`');
    }
}
