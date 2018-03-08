<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnionAttachmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('union_attachment', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('object_id', false)->comment('对象id');
            $table->tinyInteger('object_type', false)->comment('对象类型 1 企业认证 2雇佣附件 3雇佣交稿附件 4商品附件');
            $table->integer('attachment_id', false)->comment('关联附件id');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('union_attachment');
    }
}
