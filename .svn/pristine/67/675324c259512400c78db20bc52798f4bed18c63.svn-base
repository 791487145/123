<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagePrivilegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_privileges', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('package_id')->comment('套餐编号');
            $table->unsignedInteger('privileges_id')->comment('特权编号');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('package_privileges');
    }
}
