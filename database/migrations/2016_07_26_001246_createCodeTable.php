<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('code', function (Blueprint $table) {
            $table->increments('cid');
            $table->integer('uid');
            $table->integer('rid');
            $table->string('file_name');
            $table->longText('content');
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
         Schema::drop('code');
    }
}
