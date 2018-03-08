<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_order', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('code')->comment('订单号');
            $table->string('title')->comment('订单标题');
            $table->integer('uid', false)->comment('用户编号');
            $table->integer('object_id', false)->comment('对象编号');
            $table->tinyInteger('object_type', false)->comment('对象类型 1：购买作品  2：购买商品 3：商品推荐增值服务');
            $table->decimal('cash', 10);
            $table->tinyInteger('status', false)->comment('订单状态 0：未支付 1：已支付 2：确认收货 3：维权中 4：已结束 5:维权结束');
            $table->tinyInteger('invoice_status', false)->nullable();
            $table->string('note')->nullable();
            $table->timestamp('created_at')->comment('创建订单时间');
            $table->timestamp('pay_time')->nullable()->comment('支付时间');
            $table->float('trade_rate', 10)->comment('交易提成比例 单位为%');
            $table->timestamp('confirm_time')->comment('确认文件时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shop_order');
    }
}
