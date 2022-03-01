<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->integer('user_id')->nullable();
            $table->string('email')->nullable();
            $table->string('status');
            $table->string('courier')->nullable();
            $table->longText('sender');
            $table->longText('addressee');
            $table->longText('invoice')->nullable();
            $table->longText('transaction');
            $table->longText('items');
            $table->longText('meta');
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
        Schema::dropIfExists('orders');
    }
}
