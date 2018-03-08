<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBreRuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bre_rule', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('规则名称');
            $table->text('description')->comment('规则详细描述');
            $table->string('image')->nullable()->comment('规则图标');
            $table->tinyInteger('status',false)->default(0)->comment('规则状态: 0 关闭 1 开启');
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
        Schema::drop('bre_rule');
    }
}
