<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employ_goods', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('employ_id')->comment('关联雇佣id');
            $table->integer('service_id')->comment('关联服务id');
            $table->timestamp('created_at')->comment('关联创建时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('employ_goods');
    }
}
