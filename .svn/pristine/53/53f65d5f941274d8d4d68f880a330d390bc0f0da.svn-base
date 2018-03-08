<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlipayAuthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alipay_auth', function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment('支付宝认证编号');
            $table->integer('uid', false)->comment('用户编号');
            $table->string('username', 32)->nullable()->comment('用户名');
            $table->string('realname', 32)->nullable()->comment('真实姓名');
            $table->string('alipay_name',32)->nullable()->comment('支付宝姓名');
            $table->string('alipay_account',100)->nullable()->comment('支付宝账户');
            $table->decimal('pay_to_user_cash', 10, 2)->nullable()->comment('平台打款给用户的金额');
            $table->decimal('user_get_cash', 10, 2)->nullable()->comment('用户确认收到的金额');
            $table->tinyInteger('status', false)->nullable()->comment('认证状态 0：待审核 1：已打款待验证 2：认证成功 3：认证失败');
            $table->timestamp('auth_time')->nullable()->comment('认证时间');
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
        Schema::drop('alipay_auth');
    }
}
