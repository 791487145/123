<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecommendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recommend', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('position_id', false)->default(0)->comment('推荐位ID');
            $table->string('type',20)->comment('类型（service代表服务商 successcase代表成功案例 article代表文章 task代表任务');
            $table->integer('recommend_id', false)->default(0)->comment('推荐id');
            $table->string('recommend_type',20)->default('image')->comment('推荐类型（目前只有图片类型）');
            $table->string('recommend_name',20)->comment('推荐名称');
            $table->string('recommend_pic',300)->comment('推荐图片');
            $table->string('url',100)->comment('跳转链接');
            $table->timestamp('start_time')->nullable()->comment('开始时间');
            $table->timestamp('end_time')->nullable()->comment('结束时间');
            $table->tinyInteger('sort', false)->default(0)->comment('排序');
            $table->tinyInteger('is_open', false)->default(1)->comment('是否开启 1-开启 2-关闭 3-删除');
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
        Schema::drop('recommend');
    }
}
