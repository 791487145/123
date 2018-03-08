<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_service', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('task_id', false)->default(0)->comment('任务id');
            $table->integer('service_id', false)->default(0)->comment('服务id');
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
        Schema::drop('task_service');
    }
}
