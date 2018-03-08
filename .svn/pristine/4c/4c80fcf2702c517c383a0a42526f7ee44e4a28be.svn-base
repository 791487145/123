<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskExtraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_extra', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('task_id', false)->default(0)->comment('任务ID');
            $table->string('seo_title')->nullable()->comment('seo标题');
            $table->string('seo_keyword')->nullable()->comment('seo关键词');
            $table->string('seo_content')->nullable()->comment('seo描述');
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
        Schema::drop('task_extra');
    }
}
