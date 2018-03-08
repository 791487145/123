<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('district', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id')->comment('地区编号');
            $table->integer('upid', false)->index()->comment('上级id');
            $table->string('name')->index()->comment('名称');
            $table->integer('type', false)->index()->comment('类型');
            $table->integer('displayorder', false)->index()->comment('排序');
            $table->string('spelling')->index()->comment('地区对应的拼音');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('district');
    }
}
