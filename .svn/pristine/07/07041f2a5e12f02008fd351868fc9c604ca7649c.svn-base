<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOauthBindTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oauth_bind', function (Blueprint $table) {
            $table->increments('id')->comment('oauth绑定关系编号');
            $table->string('oauth_id',255)->nullable()->comment('授权id');
            $table->string('oauth_nickname',255)->nullable()->comment('第三方授权昵称');
            $table->tinyInteger('oauth_type',false)->nullable()->comment('第三方授权类型 0：QQ 1：微博 2：微信 3:app');
            $table->integer('uid',false)->nullable()->comment('用户编号');
            $table->timestamp('created_at')->nullable()->comment('授权创建时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('oauth_bind');
    }
}
