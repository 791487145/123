<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('im_message', function (Blueprint $table) {
            $table->increments('id')->comment('IM消息编号');
            $table->integer('from_uid',false)->nullable()->comment('消息发送人uid');
            $table->integer('to_uid',false)->nullable()->comment('消息接收人uid');
            $table->text('content')->comment('消息内容');
            $table->tinyInteger('status',false)->default(1)->comment('消息状态    1-未读    2-已读');
            $table->timestamp('created_at')->nullable()->comment('IM消息创建时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('im_message');
    }
}
