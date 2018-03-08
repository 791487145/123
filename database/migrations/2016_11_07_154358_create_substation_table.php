<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubstationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('substation', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('district_id')->unsinged()->comment('地区id');
            $table->string('name',20)->comment('站点名称');
            $table->tinyInteger('status',false)->default(2)->comment('状态 1=>开启  2=>关闭');
            $table->tinyInteger('sort',false)->default(0)->comment('排序');
            $table->timestamp('created_at')->nullable()->comment('站点创建时间');
            $table->timestamp('updated_at')->nullable()->comment('站点修改时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('substation');
    }
}
