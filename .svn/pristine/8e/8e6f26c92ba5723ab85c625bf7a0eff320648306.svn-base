<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad', function (Blueprint $table) {
            $table->increments('id')->comment('广告编号');
            $table->integer('target_id', false)->nullable()->comment('广告位编号');
            $table->string('ad_type')->nullable()->comment('广告类型(目前只有图片类型 image代表图片类型)');
            $table->string('ad_posotion')->nullable()->comment('位置');
            $table->string('ad_name')->nullable()->comment('链接名称');
            $table->string('ad_file')->nullable()->comment('广告文件');
            $table->text('ad_content')->nullable()->comment('广告内容');
            $table->string('ad_url')->nullable()->comment('广告url');
            $table->timestamp('start_time')->nullable()->comment('开始时间');
            $table->timestamp('end_time')->nullable()->comment('结束时间');
            $table->integer('uid', false)->nullable()->comment('用户编号');
            $table->string('username')->nullable()->comment('用户名');
            $table->string('listorder')->nullable()->comment('排序');
            $table->tinyInteger('is_open', false)->default(1)->comment('是否开启 1-开启 2-关闭 3-删除');
            $table->timestamp('created_at')->nullable()->comment('广告创建时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ad');
    }
}
