<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVipshopOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vipshop_order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->comment('vip店铺购买订单编号');
            $table->string('title')->comment('订单标题');
            $table->unsignedInteger('uid')->comment('用户编号');
            $table->unsignedInteger('package_id')->comment('套餐编号');
            $table->unsignedInteger('shop_id')->comment('店铺编号');
            $table->unsignedTinyInteger('time_period')->default(0)->comment('套餐购买时长 单位：月');
            $table->decimal('cash', 10, 2)->default(0)->comment('金额');
            $table->unsignedTinyInteger('status')->default(0)->comment('订单状态 0：未支付 1：已支付');
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
        Schema::drop('vipshop_order');
    }
}
