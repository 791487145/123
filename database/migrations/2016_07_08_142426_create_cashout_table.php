<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashout', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid',false)->comment('提现用户ID');
            $table->tinyInteger('pay_type',false)->comment('平台支付渠道类型');
            $table->string('pay_account',100)->comment('平台支付账号');
            $table->string('pay_code',100)->comment('平台支付渠道流水号');
            $table->decimal('cash',10,2)->comment('提现金额');
            $table->decimal('fees',10,2)->comment('提现手续费');
            $table->decimal('real_cash',10,2)->nullable()->comment('用户提现真实金额');
            $table->integer('admin_uid',false)->comment('管理员账号');
            $table->tinyInteger('cashout_type',false)->comment('提现类型 1：支付宝 2：银行卡');
            $table->string('cashout_account',32)->comment('提现账号');
            $table->tinyInteger('status',false)->default(0);
            $table->string('note',255)->nullable()->comment('提现备注');
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
        Schema::drop('cashout');
    }
}
