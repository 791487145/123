<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('work_id', false)->default(0)->comment('稿件ID');
            $table->string('comment')->comment('评论内容');
            $table->integer('uid', false)->default(0)->comment('评论人ID');
            $table->string('nickname',32)->comment('昵称');
            $table->integer('task_id', false)->default(0)->comment('所属任务ID');
            $table->integer('pid', false)->default(0)->comment('父级评论ID');
            $table->timestamp('created_at')->nullable()->comment('创建时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('work_comments');
    }
}
