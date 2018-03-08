<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdTargetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_target', function (Blueprint $table) {
            $table->increments('target_id');
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->string('description')->nullable();
            $table->string('targets')->nullable();
            $table->string('position')->nullable();
            $table->string('ad_size')->nullable();
            $table->integer('ad_num', false)->nullable();
            $table->string('pic')->nullable();
            $table->tinyInteger('is_open', false)->nullable();
            $table->text('content')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ad_target');
    }
}
