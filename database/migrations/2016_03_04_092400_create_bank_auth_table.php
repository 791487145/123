<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankAuthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_auth', function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment('银行认证编号');
            $table->integer('uid', false)->comment('用户编号');
            $table->string('username', 32)->comment('用户名');
            $table->string('realname', 32)->nullable()->comment('真实姓名');
            $table->string('bank_name',100)->nullable()->comment('银行名称');
            $table->string('bank_img')->nullable()->comment('bank图标');
            $table->string('bank_account',32)->nullable()->comment('银行账号');
            $table->string('deposit_area')->nullable()->comment('开户行地区');
            $table->string('deposit_name')->nullable()->comment('开户行名称');
            $table->decimal('pay_to_user_cash', 10, 2)->nullable()->comment('打款给用户金额');
            $table->decimal('user_get_cash', 10, 2)->nullable()->comment('用户确认收到金额');
            $table->tinyInteger('status', false)->nullable()->comment('认证状态：0 待审核 1 待验证 2 认证通过 3 认证失败 4 禁用');
            $table->timestamp('auth_time')->nullable()->comment('认证时间');
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
        Schema::drop('bank_auth');
    }
}
