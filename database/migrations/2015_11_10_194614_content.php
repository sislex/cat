<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Content extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id');
            $table->string('type');
            $table->string('menu');
            $table->string('name');
            $table->integer('order');
            $table->string('pseudo_url');
            $table->string('title');
            $table->text('description');
            $table->text('keywords');
            $table->text('short_text');
            $table->text('text');
//            $table->longText('obj');
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
        Schema::drop('content');
    }
}
