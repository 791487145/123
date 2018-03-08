<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskAttachmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_attachment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('task_id', false)->default(0)->comment('任务ID');
            $table->integer('attachment_id', false)->default(0)->comment('附件ID');
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
        Schema::drop('task_attachment');
    }
}
