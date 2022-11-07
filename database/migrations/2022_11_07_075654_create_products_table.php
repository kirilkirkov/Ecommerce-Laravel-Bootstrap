<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('image')->nullable();
            $table->unsignedInteger('folder')->comment('product_id is name of folder');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->unsignedInteger('category_id')->comment('category id');
            $table->unsignedInteger('quantity')->default(0);
            $table->string('url');
            $table->string('link_to')->nullable();
            $table->unsignedInteger('order_position');
            $table->unsignedInteger('procurements')->default(0);
            $table->string('tags');
            $table->boolean('hidden')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
