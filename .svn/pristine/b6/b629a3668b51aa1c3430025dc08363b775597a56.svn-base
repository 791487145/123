<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_log', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('log_type', false)->comment('日志类型');
            $table->integer('uid')->comment('操作用户ID');
            $table->string('username',32)->comment('用户名');
            $table->tinyInteger('user_type', false)->default(0)->comment('用户类型');
            $table->string('log_content')->comment('日志详情');
            $table->string('IP',32)->comment('IP地址');
            $table->timestamp('created_at')->nullable()->comment('创建时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('system_log');
    }
}
