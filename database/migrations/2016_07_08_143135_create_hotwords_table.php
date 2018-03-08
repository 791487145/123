<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotwordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotwords', function (Blueprint $table) {
            $table->increments('id')->comment('热词编号');
            $table->integer('sort',false)->default(0)->comment('排序、站长手动排序');
            $table->string('words',32)->nullable()->comment('热词');
            $table->integer('count',false)->default(1)->comment('搜索次数');
            $table->timestamp('time')->nullable()->comment('最近搜索时间');
            $table->tinyInteger('auto',false)->default(0)->comment('是否自动添加 0-否  1-是');
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
        Schema::drop('hotwords');
    }
}
