<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('interview', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('访谈标题');
            $table->unsignedInteger('uid')->comment('用户编号');
            $table->string('username');
            $table->unsignedInteger('shop_id')->comment('店铺编号');
            $table->string('shop_name')->comment('店铺名');
            $table->string('shop_cover')->comment('店铺封面');
            $table->text('desc')->comment('访谈内容');
            $table->unsignedInteger('view_count')->default('0')->comment('浏览数');
            $table->tinyInteger('list')->default('0')->comment('排序 倒序');
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
        //
        Schema::drop('interview');
    }
}
