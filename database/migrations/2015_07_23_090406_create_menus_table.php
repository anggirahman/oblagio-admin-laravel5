<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus' ,  function(Blueprint $table){
            $table->increments('id');
            $table->integer('parent_id');
            $table->string('title' ,  40);
            $table->string('controller' , 40);
            $table->integer('order');
            $table->timestamps();
            $table->index(['parent_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::drop('menus');
    }
}
