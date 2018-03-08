<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswerPraiseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_praise',function(Blueprint $table){
            $table->increments('id')->unsigned()->comment('点赞列表自增id');
            $table->integer('answerid')->unsigned()->comment('关联答案id');
            $table->integer('uid')->unsigned()->comment('关联点赞uid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('answer_praise');
    }
}
