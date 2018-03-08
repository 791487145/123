<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployCommmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employ_comment', function (Blueprint $table) {
            $table->increments('id')->unsinged();
            $table->integer('employ_id', false);
            $table->integer('from_uid', false);
            $table->integer('to_uid', false);
            $table->string('comment')->nullable();
            $table->tinyInteger('comment_by', false)->nullable()->comment('评价对象');
            $table->tinyInteger('speed_score', false)->nullable()->comment('速度分数 1-5');
            $table->tinyInteger('quality_score', false)->nullable()->comment('质量分数 1-5');
            $table->tinyInteger('attitude_score', false)->nullable()->comment('态度分数 1-5');
            $table->tinyInteger('type', false)->nullable()->comment('评价类型 1表示好评 2表示中评 3表示差评');
            $table->timestamp('created_at')->comment('创建时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('employ_comment');
    }
}
