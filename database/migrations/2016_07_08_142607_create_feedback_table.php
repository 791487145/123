<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid',false)->default(0)->comment('反馈用户ID');
            $table->string('phone',32)->default(0)->comment('反馈用户手机');
            $table->string('desc')->nullable()->comment('用户反馈内容');
            $table->tinyInteger('type',false)->default(0)->comment('用户反馈类型: 0 普通');
            $table->tinyInteger('status',false)->default(1)->comment('回复状态 1-未回复 2-已回复');
            $table->string('replay')->nullable()->comment('回复内容');
            $table->timestamp('created_time')->nullable()->comment('用户反馈时间');
            $table->timestamp('handle_time')->nullable()->comment('用户反馈处理时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('feedback');
    }
}
