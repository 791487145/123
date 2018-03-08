<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employ_work', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->text('desc')->comment('稿件描述');
            $table->integer('employ_id', false)->comment('稿件id');
            $table->tinyInteger('status', false)->comment('状态 0表示没有验收 1表示验收');
            $table->integer('uid', false)->comment('交稿威客id');
            $table->string('type')->comment('文件后缀');
            $table->timestamp('created_at')->comment('创建时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('employ_work');
    }
}
