<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer',function(Blueprint $table){
            $table->increments('id')->unsigned()->comment('回答列表自增id');
            $table->integer('uid')->unsigned()->comment('回答者id');
            $table->integer('questionid')->unsigned()->comment('问题id');
            $table->text('content')->comment('回答内容');
            $table->tinyInteger('adopt',false)->comment('答案是否被采纳 0表示未采纳 1表示已采纳');
            $table->decimal('cash',10,2)->default(0)->comment('打赏金额');
            $table->timestamp('time')->comment('回答时间');
            $table->integer('praisenum')->unsigned()->comment('点赞次数');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('answer');
    }
}
