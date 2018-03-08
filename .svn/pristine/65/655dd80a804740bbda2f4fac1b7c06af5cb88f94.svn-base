<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alias',255)->nullable()->comment('配置项别名');
            $table->text('rule')->nullable()->comment('配置项规则');
            $table->string('type',255)->default('')->comment('配置项类型');
            $table->string('title',255)->nullable();
            $table->string('desc',255)->nullable()->comment('配置描述');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('config');
    }
}
