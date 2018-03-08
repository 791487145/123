<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserFocusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_focus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid', false)->default(0)->comment('用户id');
            $table->integer('focus_uid', false)->default(0)->comment('被关注者id');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_focus');
    }
}
