<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nav', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable()->comment('标题');
            $table->string('link_url')->nullable()->comment('链接');
            $table->string('style')->nullable()->comment('样式');
            $table->tinyInteger('sort',false)->nullable()->comment('排序');
            $table->tinyInteger('is_new_window',false)->default(1)->comment('是否新窗口打开 1->是 2->否');
            $table->tinyInteger('is_show',false)->default(1)->comment('显示模式 1->是 2->否');
            $table->string('code_name')->default('')->comment('');
            $table->timestamp('created_at')->nullable()->comment('添加时间');
            $table->timestamp('updated_at')->nullable()->comment('修改时间');
            $table->tinyInteger('is_first',false)->nullable()->comment('设为首页 1->是 0>否');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('nav');
    }
}
