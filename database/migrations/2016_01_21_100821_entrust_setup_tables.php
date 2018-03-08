<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class EntrustSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        // Create table for storing roles
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id')->comment('角色编号');
            $table->string('name',32)->unique()->comment('角色名称（别名）');
            $table->string('display_name',32)->nullable()->comment('角色名称');
            $table->string('description')->nullable()->comment('角色描述');
            $table->nullableTimestamps();
        });

        // Create table for associating roles to users (Many-to-Many)
        Schema::create('role_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->comment('user_id');
            $table->integer('role_id')->unsigned()->comment('角色id');

            $table->foreign('user_id')->references('id')->on('manager')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'role_id']);
        });

        // Create table for storing permissions
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id')->comment('权限编号');
            $table->string('name',32)->unique()->comment('权限对应的路由别名');
            $table->string('display_name',32)->nullable()->comment('权限名称');
            $table->string('description')->nullable()->comment('权限描述');
            $table->integer('module_type')->nullable()->comment('所属模型');
            $table->nullableTimestamps();
        });

        // Create table for associating permissions to roles (Many-to-Many)
        Schema::create('permission_role', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned()->comment('关联权限id');
            $table->integer('role_id')->unsigned()->comment('关联角色id');

            $table->foreign('permission_id')->references('id')->on('permissions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('permission_role');
        Schema::drop('permissions');
        Schema::drop('role_user');
        Schema::drop('roles');
    }
}
