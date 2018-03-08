<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('task_id',false)->nullable()->comment('关联任务id');
            $table->integer('from_uid',false)->nullable()->comment('评论者ID');
            $table->integer('to_uid',false)->nullable()->comment('被评论者ID');
            $table->string('comment')->nullable()->comment('评论内容');
            $table->tinyInteger('comment_by',false)->nullable()->comment('0表示来自威客 1表示来自雇主 2表示系统产生');
            $table->float('speed_score')->nullable()->comment('速度评分');
            $table->float('quality_score')->nullable()->comment('质量评分');
            $table->float('attitude_score')->nullable()->comment('态度评分');
            $table->tinyInteger('type',false)->default(0)->comment('1代表好评 2代表中评 3代表差评');
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
        Schema::drop('comments');
    }
}
