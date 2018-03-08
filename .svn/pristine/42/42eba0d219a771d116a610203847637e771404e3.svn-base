<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImAttentionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('im_attention', function (Blueprint $table) {
            $table->increments('id')->comment('联系人关系编号');
            $table->integer('uid',false)->nullable()->comment('用户编号');
            $table->integer('friend_uid',false)->nullable()->comment('好友uid编号');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('im_attention');
    }
}
