<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagShopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_shop', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('tag_id', false)->comment('kppw_skill_tags表的主键id');
            $table->integer('shop_id', false)->comment('kppw_shop表的主键id即店铺id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tag_shop');
    }
}
