<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question',function(Blueprint $table){
            $table->increments('id')->unsigned()->comment('问题列表自增id');
            $table->integer('num')->default(0)->comment('问题浏览次数');
            $table->string('discription',255)->nullable()->comment('问题的描述');
            $table->tinyInteger('status',false)->comment('问题是否解决 1表示发布 2表示审核通过 3表示已经回答 4表示问题解决 5表示审核失败');
            $table->integer('uid')->unsigned()->comment('提问者uid');
            $table->timestamp('time')->comment('提问时间');
            $table->timestamp('verify_at')->comment('审核时间');
            $table->integer('category',false)->comment('问题类别');
            $table->integer('answernum',false)->comment('问题被回答次数');
            $table->integer('praisenum',false)->comment('点赞次数');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('question');
    }
}
