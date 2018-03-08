<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->increments('id')->comment('文章编号');
            $table->integer('cat_id', false)->default(0)->comment('分类编号');
            $table->integer('user_id', false)->comment('用户编号');
            $table->string('user_name',32)->nullable()->comment('用户名');
            $table->string('title')->comment('标题');
            $table->string('author',32)->nullable()->comment('作者');
            $table->string('from')->nullable()->comment('来源');
            $table->string('fromurl')->nullable()->comment('来源地址');
            $table->string('url')->nullable()->comment('文章地址');
            $table->string('summary')->nullable()->comment('简介');
            $table->string('pic')->nullable()->comment('新闻列表图片');
            $table->string('thumb')->nullable();
            $table->tinyInteger('tag', false)->nullable();
            $table->timestamp('created_at', false)->nullable()->comment('添加时间');
            $table->tinyInteger('status', false)->nullable()->comment('文章编号');
            $table->text('content')->nullable()->comment('文字内容');
            $table->integer('view_times', false)->nullable()->comment('文章阅读浏览次数');
            $table->string('seotitle')->nullable()->comment('SEO标题');
            $table->string('keywords')->nullable()->comment('SEO关键词');
            $table->string('description')->nullable()->comment('SEO描述');
            $table->integer('display_order', false)->nullable()->comment('排序');
            $table->tinyInteger('is_recommended', false)->nullable()->comment('是否推荐 1->是 2->否');
            $table->timestamp('updated_at', false)->nullable()->comment('修改时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('article');
    }
}
