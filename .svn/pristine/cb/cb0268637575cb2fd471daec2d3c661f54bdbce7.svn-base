<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageReceiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_receive', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code_name', 32)->nullable()->comment('模板别名');
            $table->string('message_title',32)->nullable()->comment('标题');
            $table->longText('message_content')->comment('消息内容');
            $table->integer('js_id',false)->nullable()->comment('接收人id');
            $table->integer('fs_id',false)->nullable()->comment('发送人id');
            $table->tinyInteger('message_type',false)->nullable()->comment('消息类型 1=>系统消息 2=>交易动态 3=>站内信');
            $table->timestamp('receive_time')->nullable()->comment('收信时间');
            $table->tinyInteger('status',false)->default(0)->comment('状态 1=>已读 0=>未读');
            $table->timestamp('read_time')->nullable()->comment('读取时间');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('message_receive');
    }
}
