<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->increments('sid');
            $table->integer('uid');
            $table->dateTime('submit_time');
            $table->longText('code');
            $table->string('lang');
            $table->longText('input');
            $table->longText('output');
            $table->longText('err_info');
            $table->integer('run_status'); // 0 for in queue 1 for send to go 2 for finished
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
        Schema::drop('submissions');
    }
}
