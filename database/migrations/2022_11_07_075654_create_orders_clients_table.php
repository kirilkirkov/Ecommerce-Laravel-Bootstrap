<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_clients', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('for_order');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email', 100);
            $table->string('phone', 30);
            $table->text('address');
            $table->string('city', 20);
            $table->string('post_code', 10);
            $table->text('notes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_clients');
    }
}
