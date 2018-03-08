<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->comment('用户编号');
            $table->string('name',32)->nullable()->comment('用户名');
            $table->string('email',100)->unique()->nullable()->comment('用户邮箱');
            $table->string('mobile',20)->default('')->comment('用户手机注册');
            $table->tinyInteger('email_status', false)->default(0)->comment('用户邮箱认证状态0：未认证1：待验证2：已经认证');
            $table->string('password', 32)->nullable()->comment('用户密码');
            $table->string('alternate_password', 32)->nullable()->comment('支付密码');
            $table->string('salt', 10)->nullable()->comment('随机码');
            $table->tinyInteger('status', false)->nullable()->comment('账户状态 0：未激活 1：已激活 2：禁用');
            $table->timestamp('overdue_date')->nullable()->comment('找回密码邮件过期时间');
            $table->string('validation_code', 10)->nullable()->comment('找回密码随机码');
            $table->timestamp('expire_date')->nullable()->comment('重置密码邮件过期时间');
            $table->string('reset_password_code')->nullable()->comment('重置密码验证随机码');
            $table->rememberToken();
            $table->timestamp('last_login_time')->nullable()->comment('最后一次登录时间');
            $table->tinyInteger('source', false)->default(1)->comment('注册来源 1-来自pc 2-来自手机');
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
        Schema::drop('users');
    }
}
