<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cate', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',32)->comment('任务分类名称');
            $table->integer('pid',false)->comment('父级分类ID');
            $table->string('path',255)->nullable()->comment('分类路径');
            $table->string('pic',255)->nullable()->comment('分类图标');
            $table->smallInteger('sort')->default(0)->comment('排序，指的是任务分类在本级的排序');
            $table->integer('choose_num',false)->default(0)->comment('任务分类被点击次数');
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
        Schema::drop('cate');
    }
}
