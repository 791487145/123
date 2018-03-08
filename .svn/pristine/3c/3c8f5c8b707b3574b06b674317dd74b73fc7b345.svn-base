<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('promote',function(Blueprint $table){
            $table->increments('id')->unsigned()->comment('推广列表自增id');
            $table->integer('from_uid')->unsigned()->comment('推广人id');
            $table->integer('to_uid')->unsigned()->comment('被推广人id');
            $table->decimal('price')->comment('推广成功获得推广金额');
            $table->integer('finish_conditions')->unsigned()->comment('完成推广的条件  1=>实名认证  2=>邮箱认证 3=>支付认证');
            $table->tinyInteger('type')->unsigned()->comment('推广类型  1=>注册推广');
            $table->tinyInteger('status')->unsigned()->comment('推广状态  1=>推广中  2=>完成');
            $table->timestamp('created_at')->comment('推广时间');
            $table->timestamp('updated_at')->comment('完成推广时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('promote');
    }
}
