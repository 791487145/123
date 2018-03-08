<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkAttachmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_attachment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('task_id', false)->default(0)->comment('任务ID');
            $table->integer('work_id', false)->default(0)->comment('稿件ID');
            $table->integer('attachment_id', false)->default(0)->comment('附件ID');
            $table->string('type',32)->nullable()->comment('附件类型');
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
        Schema::drop('work_attachment');
    }
}
