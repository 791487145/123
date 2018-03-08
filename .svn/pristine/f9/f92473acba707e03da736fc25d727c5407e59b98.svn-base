<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachment', function (Blueprint $table) {
            $table->increments('id')->comment('附件编号');
            $table->string('name',128)->nullable()->comment('附件名');
            $table->string('type',45)->nullable()->comment('附件类型(jpg,png,doc,xls,ppt...)');
            $table->integer('size',false)->nullable()->comment('附件大小 单位KB');
            $table->string('url',255)->nullable()->comment('附件地址');
            $table->tinyInteger('status',false)->default(0)->comment('0表示待删除附件 1表示任务附件');
            $table->integer('user_id',false)->comment('所属用户id');
            $table->string('disk',20)->comment('文件存储驱动');
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
        Schema::drop('attachment');
    }
}
