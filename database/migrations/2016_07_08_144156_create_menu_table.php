<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('id')->comment('自增索引');
            $table->string('name',32)->nullable()->comment('菜单名称');
            $table->string('route',100)->nullable()->comment('路由');
            $table->integer('pid',false)->default(0)->comment('父级id');
            $table->tinyInteger('level',false)->nullable()->comment('菜单等级');
            $table->string('note')->nullable()->comment('菜单说明信息');
            $table->integer('sort', false)->default(0)->comment('排序');
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
        Schema::drop('menu');
    }
}
