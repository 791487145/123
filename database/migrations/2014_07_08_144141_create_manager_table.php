<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manager', function (Blueprint $table) {
            $table->increments('id')->comment('管理员编号');
            $table->string('username',32)->comment('管理员用户名');
            $table->string('realname',32)->nullable()->comment('真实姓名');
            $table->string('password',32)->comment('管理员密码');
            $table->string('salt',10)->nullable()->comment('随机码');
            $table->string('telephone',20)->nullable()->comment('手机号码');
            $table->string('QQ',20)->nullable()->comment('qq号');
            $table->string('email',100)->nullable()->comment('邮箱');
            $table->timestamp('birth')->nullable()->comment('出生日期');
            $table->smallInteger('status')->default(1)->comment('1开启，2关闭');
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
        Schema::drop('manager');
    }
}
