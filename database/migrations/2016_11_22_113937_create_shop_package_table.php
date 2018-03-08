<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopPackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_package', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('shop_id')->comment('店铺编号');
            $table->unsignedInteger('package_id')->comment('套餐编号');
            $table->string('privileges_package')->default('')->comment('特权项');
            $table->unsignedInteger('uid')->comment('用户编号');
            $table->string('username')->comment('用户名');
            $table->unsignedTinyInteger('duration')->comment('套餐总时长 单位：月');
            $table->decimal('price', 10, 2)->comment('套餐总价');
            $table->timestamp('start_time')->comment('开始时间');
            $table->timestamp('end_time')->comment('结束时间');
            $table->unsignedTinyInteger('status')->default(0)->comment('套餐状态 0：生效中 1：已过期');
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
        Schema::drop('shop_package');
    }
}
