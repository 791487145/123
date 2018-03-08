<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskPayTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('task_pay_type',function(Blueprint $table){
			$table->increments('id')->unsigned()->comment('任务支付表自增id');
			$table->integer('task_id')->comment('任务id');
            $table->integer('pay_type')->default(1)->comment('支付方式  1:一次性 2:50:50 3:50:30:20 4:自定义');
		    $table->string('pay_type_append')->comment('pay_type=4时 支付方式');
            $table->integer('status')->default(0)->comment('状态 0:待审核 1:威客同意 2:威客拒绝');
            $table->timestamp('created_at')->comment('创建时间');
			$table->timestamp('updated_at')->comment('修改时间');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('task_pay_type');
    }
}
