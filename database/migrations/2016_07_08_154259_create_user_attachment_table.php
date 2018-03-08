<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAttachmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_attachment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid', false)->default(0)->comment('用户id');
            $table->integer('attachment_id', false)->default(0)->comment('附件记录id');
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
        Schema::drop('user_attachment');
    }
}
