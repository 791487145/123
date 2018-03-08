<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('链接名称');
            $table->string('content')->nullable()->comment('链接名称');
            $table->timestamp('addtime')->nullable()->comment('添加时间');
            $table->tinyInteger('status',false)->default(1)->comment('1启用，2禁用');
            $table->tinyInteger('sort',false)->nullable()->comment('排序');
            $table->string('pic')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('link');
    }
}
