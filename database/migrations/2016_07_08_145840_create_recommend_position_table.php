<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecommendPositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recommend_position', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('推荐位名称');
            $table->string('code')->comment('推荐位别名');
            $table->string('position')->comment('推荐位位置描述');
            $table->string('pic')->nullable()->comment('推荐位图片');
            $table->tinyInteger('num', false)->default(0)->comment('推荐位下可推荐的数量');
            $table->tinyInteger('is_open', false)->default(1)->comment('是否开启推荐位');
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
        Schema::drop('recommend_position');
    }
}
