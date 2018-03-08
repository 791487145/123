<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('子订单标题');
            $table->string('note')->comment('子订单备注');
            $table->float('cash', 8, 2)->default(0.00)->comment('子订单金额');
            $table->integer('uid', false)->comment('创建用户ID');
            $table->string('order_id')->comment('父订单ID');
            $table->string('order_code')->comment('父订单编号');
            $table->integer('product_id', false)->default(0)->comment('对象ID(TASK,SERVICE,TOOL)');
            $table->tinyInteger('product_type', false)->comment('对象类型:1:TASK,2:SERVICE,3:TOOL');
            $table->tinyInteger('status', false)->default(0)->comment('子订单状态');
            $table->timestamp('created_at')->nullable()->comment('创建时间');
            $table->timestamp('updated_at')->nullable()->comment('修改时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sub_order');
    }
}
