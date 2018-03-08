<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrivilegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('privileges', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('')->comment('特权名称');
            $table->text('desc')->comment('特权描述');
            $table->string('code', 50)->default('')->comment('特权编码');
            $table->unsignedTinyInteger('list')->default(0)->comment('排序 倒序');
            $table->unsignedTinyInteger('type')->default(0)->comment('特权类型 0：自定义特权 1：内置特权');
            $table->unsignedTinyInteger('status')->default(0)->comment('特权停用启用状态 0：启用 1：停用');
            $table->unsignedTinyInteger('is_recommend')->default(0)->comment('推荐状态 0：未推荐 1：已推荐');
            $table->string('ico')->default('')->comment('特权图标');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('privileges');
    }
}
