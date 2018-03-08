<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnionRightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('union_rights', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->tinyInteger('type', false)->comment('维权类型，不同的对象有不同的维权类型 雇佣维权 1表示维归信息 2虚假交稿 3涉嫌抄袭 4其他');
            $table->integer('object_id', false)->comment('对象关联id');
            $table->string('object_type')->nullable()->comment('对象类型 1表示雇佣维权 2:购买商品');
            $table->text('desc')->comment('维权描述');
            $table->tinyInteger('status', false)->default(0)->comment('处理状态 0表示未处理 1表示已处理(通过) 2已处理（不通过）');
            $table->integer('from_uid', false)->comment('维权者id');
            $table->integer('to_uid', false)->comment('被维权者id');
            $table->integer('handel_uid', false)->comment('后台处理者id');
            $table->timestamp('handled_at')->comment('维权处理时间');
            $table->tinyInteger('is_delete', false)->default(0)->comment('软删除  1=>删除  0=>未删除');
            $table->decimal('from_price', 10)->nullable()->comment('维权方获得金额');
            $table->decimal('to_price', 10)->nullable()->comment('被维权方获得金额');
            $table->timestamp('created_at')->comment('维权创建时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('union_rights');
    }
}
