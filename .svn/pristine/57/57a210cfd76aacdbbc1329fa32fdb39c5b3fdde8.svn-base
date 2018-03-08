<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinancialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial', function (Blueprint $table) {
            $table->increments('id')->comment('财务编号');
            $table->tinyInteger('action',false)->default(1)->comment('收支行为(1:发布任务 2:接受任务 3:用户充值 4:用户提现 5:购买增值服务 6:购买用户商品 7:任务失败退款)');
            $table->tinyInteger('pay_type',false)->nullable()->comment('支付渠道类型(1:表示余额 2:表示支付宝 3:表示微信 4:表示银联)');
            $table->string('pay_account',255)->nullable()->comment('支付账号');
            $table->string('pay_code',255)->nullable()->comment('支付渠道流水号');
            $table->decimal('cash',10,2)->default(0)->comment('金额');
            $table->integer('uid',false)->nullable()->comment('用户ID');
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
        Schema::drop('financial');
    }
}
