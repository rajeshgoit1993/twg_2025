<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{

    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('usa_sale');
            $table->text('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop("sales");
    }
}
