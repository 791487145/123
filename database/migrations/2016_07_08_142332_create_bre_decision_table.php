<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBreDecisionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bre_decision', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rule_id',false)->comment('规则ID');
            $table->integer('action_id',false)->comment('操作ID');
            $table->integer('before_status',false)->default(0)->comment('操作执行前状态值');
            $table->integer('after_status',false)->default(0)->comment('操作执行后状态值');
            $table->integer('sort',false)->default(1)->comment('操作执行顺序');
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
        Schema::drop('bre_decision');
    }
}
