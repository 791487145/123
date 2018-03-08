<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_record', function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment('认证记录编号');
            $table->integer('auth_id', false)->nullable()->comment('认证编号');
            $table->integer('uid', false)->nullable()->comment('关联用户id');
            $table->string('username', 32)->comment('用户名');
            $table->string('auth_code', 32)->comment('认证code');
            $table->tinyInteger('status', false)->comment('认证记录编号');
            $table->timestamp('auth_time')->nullable()->comment('认证时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('auth_record');
    }
}
