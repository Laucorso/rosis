<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->date('date');
            $table->integer('order_id');
            $table->integer('user_id')->nullable();
            $table->string('name');
            $table->string('nif');
            $table->string('address');
            $table->string('city');
            $table->string('zip');
            $table->longText('items');
            $table->longText('meta')->nullable();
            $table->float('total');
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
        Schema::dropIfExists('invoices');
    }
}
