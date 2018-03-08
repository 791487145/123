<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgreementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agreement', function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment('协议编号');
            $table->string('name')->nullable()->comment('协议名称');
            $table->text('content')->nullable()->comment('协议内容');
            $table->string('code_name')->nullable()->comment('名称代号');
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
        Schema::drop('agreement');
    }
}
