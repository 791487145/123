<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_category', function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment('文章分类编号');
            $table->integer('pid', false)->default(0)->comment('文章分类父编号');
            $table->string('cate_name',32)->nullable()->comment('分类名称');
            $table->integer('articles', false)->nullable()->comment('文章数量');
            $table->integer('display_order', false)->nullable()->comment('排序');
            $table->string('url')->nullable()->comment('链接地址');
            $table->integer('user_id', false)->nullable()->comment('用户编号');
            $table->string('user_name',32)->nullable()->comment('用户名');
            $table->timestamp('created_at')->nullable()->comment('创建时间');
            $table->text('description')->nullable()->comment('SEO描述');
            $table->text('seotitle')->nullable()->comment('SEO标题');
            $table->text('keyword')->nullable()->comment('SEO关键词');
            $table->timestamp('updated_at')->nullable()->comment('修改时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('article_category');
    }
}
