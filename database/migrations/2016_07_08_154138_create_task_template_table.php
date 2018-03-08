<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_template', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('模板标题');
            $table->text('content')->comment('模板内容');
            $table->integer('cate_id', false)->default(0)->comment('模板类型 关联task_cate表');
            $table->tinyInteger('status', false)->default(0)->comment('0表示启用 1表示禁用');
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
        Schema::drop('task_templet');
    }
}
