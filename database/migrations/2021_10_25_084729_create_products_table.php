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
            $table->id();
            $table->unsignedBigInteger('product_category_id');
            $table->string('code');
            $table->string('name');
            $table->integer('stock');
            $table->decimal('price', 11, 2);
            $table->decimal('reseller_price', 11, 2);
            $table->decimal('store_price', 11, 2);
            $table->boolean('is_avaliable')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('product_category_id')->references('id')->on('product_categories')->onDelete('cascade');
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
