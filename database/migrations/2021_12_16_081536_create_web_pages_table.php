<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_pages', function (Blueprint $table) {
            $table->id();
            $table->string('es_slug')->unique();
            $table->string('ca_slug')->unique();
            $table->string('en_slug')->unique();
            $table->string('type');
            $table->text('categories');
            $table->text('tags');
            $table->text('name');
            $table->longText('description');
            $table->longText('content');
            $table->longText('seo');
            $table->longText('meta');
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
        Schema::dropIfExists('web_pages');
    }
}
