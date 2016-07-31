<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepositoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('repository', function (Blueprint $table) {
            $table->increments('rid');
            $table->integer('uid');
            $table->integer('catid');
            $table->string('repo_name');
            $table->string('repo_description');
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
        Schema::drop('repository');
    }
}
