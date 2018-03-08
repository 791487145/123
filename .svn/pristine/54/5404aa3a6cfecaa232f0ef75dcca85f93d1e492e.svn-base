<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skill_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tag_name')->comment('技能标签');
            $table->integer('cate_id', false)->default(0)->comment('关联的任务类型');
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
        Schema::drop('skill_tags');
    }
}
