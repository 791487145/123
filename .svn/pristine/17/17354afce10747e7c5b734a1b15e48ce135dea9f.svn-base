<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuccessCaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('success_case', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid', false)->default(0)->comment('创建用户ID');
            $table->string('username')->comment('发布人name');
            $table->string('title')->comment('成功案例标题');
            $table->mediumText('desc')->nullable()->comment('成功案例描述');
            $table->string('url')->nullable()->comment('成功案例跳转链接');
            $table->string('pic')->nullable()->comment('成功案例封面');
            $table->integer('cate_id', false)->default(0)->comment('成功案例分类');
            $table->tinyInteger('type', false)->default(0)->comment('成功案例发布方式: 0->平台 1->用户');
            $table->integer('view_count')->comment('访问次数');
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
        Schema::drop('success_case');
    }
}
