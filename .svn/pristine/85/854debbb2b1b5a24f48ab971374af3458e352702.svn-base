<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBreActionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bre_action', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('行为操作标题');
            $table->string('description')->nullable()->comment('行为操作详情描述');
            $table->string('url')->comment('行为操作访问路径');
            $table->string('class')->comment('行为操作执行调用类名');
            $table->string('function')->nullable()->comment('行为操作执行调用方法名');
            $table->string('params')->nullable()->comment('行为操作执行调用方法的参数');
            $table->string('method')->default('GET')->comment('行为操作请求方式: GET POST PUT DELETE');
            $table->tinyInteger('status',false)->default(1)->comment('操作开启状态: 0 关闭 1开启');
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
        Schema::drop('bre_action');
    }
}
