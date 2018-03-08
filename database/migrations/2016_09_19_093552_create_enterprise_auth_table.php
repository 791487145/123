<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnterpriseAuthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enterprise_auth', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('uid', false)->nullable()->comment('用户编号');
            $table->string('company_name')->nullable()->comment('公司名称');
            $table->integer('cate_id', false)->nullable()->comment('行业末级分类');
            $table->integer('employee_num', false)->nullable()->comment('员工人数');
            $table->string('business_license')->nullable()->comment('营业执照');
            $table->timestamp('begin_at')->nullable()->comment('开始经营时间');
            $table->string('website')->nullable()->comment('公司网址');
            $table->integer('province', false)->comment('省');
            $table->integer('city', false)->nullable()->comment('市');
            $table->integer('area', false)->nullable()->comment('区');
            $table->string('address')->nullable()->comment('公司详细地址');
            $table->tinyInteger('status', false)->default(0)->comment('认证状态 0：待验证 1：成功 2：失败');
            $table->timestamp('auth_time')->nullable()->comment('认证时间');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('enterprise_auth');
    }
}
