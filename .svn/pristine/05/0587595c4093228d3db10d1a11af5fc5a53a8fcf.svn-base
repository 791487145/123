<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhoneAuthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phone_auth', function (Blueprint $table) {
            $table->increments('id')->comment('序号');
            $table->string('phone',20)->comment('手机号');
            $table->string('code',20)->comment('手机验证码');
            $table->timestamp('overdue_date',false)->nullable()->comment('过期时间');
            $table->timestamp('created_at')->nullable()->comment('创建时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('phone_auth');
    }
}
