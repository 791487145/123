<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('增值服务标题');
            $table->string('description')->comment('增值服务描述');
            $table->decimal('price',10,2)->comment('增值服务价格');
            $table->tinyInteger('type', false)->nullable()->comment('增值服务类型 1表示任务 2表示商店服务');
            $table->string('identify', 100)->nullable()->comment('唯一标识');
            $table->tinyInteger('status', false)->default(1)->comment('状态 1=>启用 2->禁用');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('service');
    }
}
