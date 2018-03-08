<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_item', function (Blueprint $table) {
            $table->string('auth_code',32)->primary()->comment('认证类型 实名：realname 银行：bank 支付宝：alipay');
            $table->string('auth_title')->nullable()->comment('认证名称');
            $table->string('auth_desc')->nullable()->comment('认证描述');
            $table->string('auth_ico')->nullable()->comment('认证图标');
            $table->string('auth_small_ico')->nullable()->comment('认证小图标');
            $table->string('auth_big_ico')->nullable()->comment('认证大图标');
            $table->tinyInteger('auth_open', false)->nullable()->comment('认证是否开启 0：未开启 1：已开启');
            $table->tinyInteger('list_order', false)->nullable()->comment('认证排序');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('auth_item');
    }
}
