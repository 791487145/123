<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRealnameAuthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realname_auth', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('uid', false)->comment('关联用户id');
            $table->string('username', 32)->comment('用户名');
            $table->string('realname', 32)->comment('用户真实姓名');
            $table->string('card_number')->comment('用户证件号');
            $table->string('card_front_side')->comment('身份证正面');
            $table->string('card_back_dside')->comment('身份证背面');
            $table->string('validation_img')->comment('持证验证图片');
            $table->tinyInteger('status', false)->default(0)->comment('认证状态 0：待验证 1：成功 2：失败');
            $table->tinyInteger('card_type', false)->default(1)->comment('证件类型  1-身份证  2-护照');
            $table->tinyInteger('type', false)->default(1)->comment('认证类型  1-身份认证  2-企业认证');
            $table->timestamp('auth_time')->nullable()->comment('认证通过时间');
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
        Schema::drop('realname_auth');
    }
}
