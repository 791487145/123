<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_template', function (Blueprint $table) {
            $table->increments('id')->comment('信息邮件配置编号');
            $table->string('code_name',32)->nullable()->comment('名称代号');
            $table->string('name',32)->nullable()->comment('信息邮件配置名称');
            $table->longText('content')->comment('消息模版');
            $table->tinyInteger('message_type',false)->nullable()->comment('类型 1->系统消息 2->交易动态');
            $table->tinyInteger('is_open',false)->nullable()->comment('是否开启 1->是 2->否');
            $table->tinyInteger('is_on_site',false)->default(0)->comment('站内信息 1->是');
            $table->tinyInteger('is_send_email',false)->default(0)->comment('发送邮件 1->是');
            $table->integer('num',false)->default(0)->comment('模板变量个数');
            $table->string('variable_str',255)->nullable()->comment('变量名称 以逗号隔开');
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
        Schema::drop('message_template');
    }
}
