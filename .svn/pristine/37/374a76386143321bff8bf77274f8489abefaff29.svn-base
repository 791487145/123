<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_detail', function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment('用户详情编号');
            $table->integer('uid', false)->unique()->comment('用户编号');
            $table->string('realname', 32)->nullable()->comment('真实姓名');
            $table->tinyInteger('realname_status', false)->default(0)->comment('表示真实姓名是否公开 0表示不公开 1表示公开');
            $table->tinyInteger('sex', false)->default(0)->comment('0表示女 1表示男');
            $table->string('mobile', 20)->nullable()->comment('手机号码');
            $table->tinyInteger('mobile_status', false)->default(0)->comment('0表示不公开 1表示公开');
            $table->string('nickname',32)->nullable()->comment('app端用户昵称');
            $table->string('qq',20)->nullable()->comment('用户qq');
            $table->tinyInteger('qq_status', false)->default(0)->comment('qq是否公开 0表示不公开 1表示公开');
            $table->string('wechat',20)->nullable()->comment('用户微信号');
            $table->tinyInteger('wechat_status', false)->default(0)->comment('qq是否公开 0表示不公开 1表示公开');
            $table->string('card_number',32)->nullable()->comment('身份证号码');
            $table->integer('province', false)->nullable()->comment('用户省份');
            $table->integer('city', false)->nullable()->comment('用户城市');
            $table->integer('area', false)->nullable()->comment('用户地区');
            $table->string('avatar')->nullable()->comment('用户头像');
            $table->string('autograph')->nullable()->comment('个人签名');
            $table->string('introduce')->nullable()->comment('个人简介');
            $table->string('sign')->nullable()->comment('个人标签');
            $table->integer('employee_praise_rate')->default(0)->comment('做为服务商的好评数量');
            $table->integer('employer_praise_rate')->default(0)->comment('做为雇主的好评数量');
            $table->integer('receive_task_num')->nullable()->comment('承接任务数量');
            $table->integer('publish_task_num')->nullable()->comment('发布任务数量');
            $table->tinyInteger('shop_status', false)->default(0)->comment('店铺状态: -1.管理员禁用店铺 0.未开启店铺 1.开启店铺 2.关闭店铺');
            $table->decimal('balance', 10, 2)->default(0)->comment('用户资产余额');
            $table->tinyInteger('balance_status', false)->default(0)->comment('资产冻结 0表示未冻结 1表示资金被冻结');
            $table->timestamp('last_login_time')->nullable()->comment('最后一次登录时间');
            $table->string('backgroundurl')->nullable()->comment('空间个人资料背景图片');
            $table->tinyInteger('alternate_tips', false)->default(0)->comment('支付提示 0：提示 1：不提示');
            $table->integer('employee_num', false)->default(0)->comment('累计雇佣量');
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
        Schema::drop('user_detail');
    }
}
