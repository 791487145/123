<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id')->comment('订单编号');
            $table->string('code',64)->nullable()->comment('订单编号');
            $table->string('title')->nullable()->comment('订单标题');
            $table->integer('uid',false)->nullable()->comment('用户ID');
            $table->integer('task_id',false)->nullable()->comment('任务订单的任务id');
            $table->float('cash')->nullable()->comment('订单金额');
            $table->tinyInteger('status',false)->default(0)->comment('订单状态: 0');
            $table->tinyInteger('invoice_status',false)->default(0)->comment('开票状态');
            $table->string('note')->nullable()->comment('订单备注');
            $table->timestamp('created_at')->nullable()->comment('创建时间');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('order');
    }
}
