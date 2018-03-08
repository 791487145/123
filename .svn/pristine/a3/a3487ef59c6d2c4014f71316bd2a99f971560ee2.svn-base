<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',32)->comment('任务类型名称');
            $table->text('desc')->comment('任务类型描述');
            $table->tinyInteger('status', false)->default(0)->comment('0表示关闭 1表示开启');
            $table->string('alias')->nullable()->comment('任务模式别名');
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
        Schema::drop('task_type');
    }
}
