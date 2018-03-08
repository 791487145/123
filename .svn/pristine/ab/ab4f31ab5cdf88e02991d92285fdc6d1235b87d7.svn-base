<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskRightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_rights', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('role', false)->default(0)->comment('维权角色 0表示威客维权 1表示雇主维权');
            $table->tinyInteger('type', false)->default(1)->comment('维权类型');
            $table->integer('task_id', false)->default(0)->comment('维权任务id');
            $table->integer('work_id', false)->default(0)->comment('投稿记录id');
            $table->text('desc')->comment('维权描述');
            $table->tinyInteger('status', false)->default(0)->comment('状态 0表示未处理 1表示未处理');
            $table->integer('from_uid', false)->default(0)->comment('原告维权者id');
            $table->integer('to_uid', false)->default(0)->comment('被告维权者id');
            $table->integer('handle_uid', false)->default(0)->comment('处理维权的管理员id');
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
        Schema::drop('task_rights');
    }
}
