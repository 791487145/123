<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop', function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment('店铺id');
            $table->integer('uid', false)->comment('用户id');
            $table->tinyInteger('type', false)->comment('店铺类型  1=>个人店铺 2=>企业店铺');
            $table->string('shop_pic')->comment('店铺封面');
            $table->string('shop_name')->comment('店铺名称');
            $table->text('shop_desc')->comment('店铺介绍');
            $table->integer('province', false)->comment('省');
            $table->integer('city', false)->comment('市');
            $table->tinyInteger('status', false)->default(1)->comment('店铺状态  1=>开启  2=>关闭');
            $table->integer('total_comment', false)->nullable()->comment('对该店铺（商品加服务）总的评价数');
            $table->integer('good_comment', false)->nullable()->comment('对该店铺（商品加服务）好评价数');
            $table->string('shop_bg')->nullable()->comment('店铺背景图');
            $table->string('seo_title')->nullable()->comment('seo标题');
            $table->string('seo_keyword')->nullable()->comment('seo关键词');
            $table->string('seo_desc')->nullable()->comment('seo描述');
            $table->tinyInteger('is_recommend', false)->default(0)->comment('是否推荐 0=>不推荐  1=>推荐');
            $table->text('nav_rules')->comment('导航配置');
            $table->string('nav_color')->default('')->comment('导航肤色');
            $table->text('banner_rules')->comment('轮播图 附件编号json串 ');
            $table->string('central_ad')->default('')->comment('中部广告');
            $table->string('footer_ad')->default('')->comment('底部广告');
			$table->timestamp('created_at')->nullable()->comment('创建时间');
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
        Schema::drop('shop');
    }
}
