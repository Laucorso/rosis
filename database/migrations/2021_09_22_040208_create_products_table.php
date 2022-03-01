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
            $table->integer('parent_id')->nullable();
            $table->string('sku');
            $table->string('es_slug')->unique();
            $table->string('ca_slug')->unique();
            $table->string('en_slug')->unique();
            $table->text('name');
            $table->text('categories');
            $table->text('tags');
            $table->string('type');
            $table->longText('description');
            $table->longText('images');
            $table->float('price');
            $table->float('sale_price');
            $table->string('tax_type');
            $table->float('weight');
            $table->string('dimensions');
            $table->float('stock');
            $table->longText('seo');
            $table->longText('meta');
            $table->longText('subitems');
            $table->boolean('active');
            $table->timestamps();
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
