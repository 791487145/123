<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('task_id', false)->default(0)->comment('任务ID');
            $table->text('desc')->comment('被关注者id');
            $table->tinyInteger('status', false)->default(0)->comment('状态 0表示威客投稿 1表示威客中标 2表示威客交付 3表示验收成功 4表示验收失败(交易维权）');
            $table->tinyInteger('forbidden', false)->default(0)->comment('是否禁用稿件 0表示启用 1表示禁用');
            $table->integer('uid', false)->default(0)->comment('威客ID');
            $table->tinyInteger('bid_by', false)->default(0)->comment('中标选中对象 0表示雇主选中 1表示系统选中');
            $table->timestamp('bid_at')->nullable()->comment('中标时间');
            $table->timestamp('created_at')->nullable()->comment('稿件创建时间');
			$table->decimal('price',10,2)->nullable()->comment('威客报价金额');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('work');
    }
}
