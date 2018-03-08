<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_report', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('type', false)->default(1)->comment('举报类型 1表示滥发广告 2违规信息 3虚假交换 4涉嫌抄袭 5重复交稿 6其他');
            $table->integer('task_id', false)->default(0)->comment('举报的投稿的任务id');
            $table->integer('work_id', false)->default(0)->comment('所举报的投稿记录');
            $table->text('desc')->comment('举报描述');
            $table->tinyInteger('status', false)->default(0)->comment('状态 0表示未处理 1表示未处理');
            $table->integer('from_uid', false)->default(0)->comment('举报用户ID');
            $table->integer('to_uid', false)->default(0)->comment('被举报用户ID');
            $table->integer('attachment_ids', false)->default(0)->comment('json 记录长传的附件的id');
            $table->integer('handle_type', false)->default(0)->comment('处理方式 0表示禁用稿件 1表示举报无效 2表示屏蔽用户');
            $table->integer('handle_uid', false)->default(0)->comment('处理举报的管理员id');
            $table->timestamp('created_at')->nullable()->comment('创建时间');
            $table->timestamp('handled_at')->nullable()->comment('处理时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('task_report');
    }
}
