<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('uid', false);
            $table->integer('shop_id', false);
            $table->integer('cate_id', false)->comment('商品二级分类编号');
            $table->string('title')->comment('商品标题');
            $table->text('desc')->comment('商品描述');
            $table->tinyInteger('unit', false)->default(0)->comment('商品价格单位 0：每件 1：每时');
            $table->tinyInteger('type', false)->default(1)->comment('商品类型 1：作品 2：服务');
            $table->decimal('cash', 10, 2)->default(0);
            $table->string('cover')->nullable()->comment('商品封面');
            $table->tinyInteger('status', false)->default(0)->comment('商品状态 0：未审核 1：审核通过上架了  2：审核通过下架了  3：审核失败');
            $table->timestamp('tool_expiration_time')->comment('增值工具过期时间');
            $table->tinyInteger('is_recommend', false)->default(0)->comment('是否推荐到商城 0：不推荐 1：推荐');
            $table->timestamp('recommend_end', false)->nullable()->comment('推荐到商城截止时间');
            $table->integer('sales_num', false)->default(0)->comment('卖出数量');
            $table->integer('comments_num', false)->default(0)->comment('总评价数');
            $table->integer('good_comment', false)->default(0)->comment('好评数');
            $table->integer('view_num', false)->default(0)->comment('访问量');
            $table->tinyInteger('is_delete', false)->default(0)->comment('用户软删除 0表示未删除 1表示删除');
            $table->text('recommend_text')->comment('审核不通过原因');
            $table->string('seo_title');
            $table->string('seo_keyword');
            $table->text('seo_desc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('goods');
    }
}
