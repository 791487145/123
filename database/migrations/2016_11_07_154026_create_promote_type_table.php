<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromoteTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('promote_type',function(Blueprint $table){
            $table->increments('id')->unsigned()->comment('推广类型列表自增id');
            $table->string('name',30)->nullable()->comment('推广类型名称');
            $table->string('code_name',100)->nullable()->comment('名称代号 （拼音大写）');
            $table->tinyInteger('type')->unsigned()->comment('推广类型  1=>注册推广');
            $table->decimal('price')->comment('推广金额');
            $table->integer('finish_conditions')->unsigned()->comment('完成推广的条件  1=>实名认证  2=>邮箱认证 3=>支付认证');
            $table->tinyInteger('is_open')->unsigned()->comment('是否开启 1=>开启 2=>关闭');
            $table->timestamp('created_at')->comment('创建时间');
            $table->timestamp('updated_at')->comment('修改时间');
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
        Schema::drop('promote_type');

    }
}
