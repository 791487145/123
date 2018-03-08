<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_comment', function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment('商品评价编号');
            $table->integer('goods_id', false)->comment('商品编号');
            $table->integer('uid', false)->comment('用户编号');
            $table->tinyInteger('comment_by', false)->comment('商品评价对象  0=>系统  1=>用户');
            $table->float('speed_score')->comment('速度得分');
            $table->float('quality_score')->comment('质量得分');
            $table->float('attitude_score')->comment('态度得分');
            $table->text('comment_desc')->comment('评价内容');
            $table->tinyInteger('type', false)->default(0)->comment('评价类型 0：好评 1：中评 2：差评');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('goods_comment');
    }
}
