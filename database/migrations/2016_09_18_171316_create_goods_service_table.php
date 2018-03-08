<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_service', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('service_id', false)->comment('增值服务编号');
            $table->integer('goods_id', false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('goods_service');
    }
}
