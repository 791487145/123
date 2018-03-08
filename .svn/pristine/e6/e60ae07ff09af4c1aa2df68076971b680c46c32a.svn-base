<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskPaySectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_pay_section',function(Blueprint $table){
			 $table->increments('id')->unsigned()->comment('任务交付表自增id');
             $table->integer('task_id')->comment('任务id');
             $table->integer('uid')->comment('威客uid\n');
             $table->string('name')->comment('支付阶段名称');			 
             $table->decimal('price',10,0)->comment('阶段支付金额');
             $table->integer('status')->default(0)->comment('支付状态 0:未支付 1:已支付');
			 $table->integer('work_id')->comment('关联任务稿件id');
			 $table->integer('verify_status')->default(0)->comment('稿件审核状态 0:待审核 1:审核通过 2:审核失败');
             $table->timestamp('created_at')->comment('创建时间');
             $table->timestamp('updated_at')->comment('修改时间');
             $table->integer('section_status')->default(0)->comment('0：未进行，1：进行中，2：维权中，3：完成');
             $table->integer('case_status')->default(0)->comment('支付方案状态 0:等待威客同意  1:同意 2:拒绝'); 
             $table->string('desc')->comment('备注\n');
			 $table->integer('percent')->comment('支付比例\n');	
             $table->integer('sort')->comment('支付阶段');			 
             $table->timestamp('pay_at')->comment('支付时间');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('task_pay_section');
    }
}
