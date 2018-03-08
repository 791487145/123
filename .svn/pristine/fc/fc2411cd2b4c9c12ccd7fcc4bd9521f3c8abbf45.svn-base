<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employ', function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment('雇佣任务表自增id');
            $table->string('title')->comment('雇佣的标题');
            $table->text('desc')->comment('雇佣描述');
            $table->string('phone')->comment('雇佣者的联系电话');
            $table->decimal('bounty', 10, 2)->comment('任务赏金');
            $table->tinyInteger('bounty_status', false)->comment('是否托管 0表示未托管 1表示已经托管');
            $table->timestamp('delivery_deadline')->comment('截止时间');
            $table->tinyInteger('status', false)->comment('状态 0表示雇佣创建 1表示接受雇佣 2表示已经交付 3表示验收成功 4表示完成 5表示拒绝雇佣 6表示雇主取消任务 7表示雇主维权 8表示威客维权 9表示雇佣过期');
            $table->integer('employee_uid', false)->comment('被雇佣人的uid');
            $table->integer('employer_uid', false)->comment('雇佣者的id');
            $table->timestamp('employed_at')->comment('接受雇佣的时间');
            $table->tinyInteger('employ_percentage', false)->commment('任务成功抽成比率');
            $table->string('seo_title')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->string('seo_content')->nullable();
            $table->timestamp('cancel_at')->nullable()->comment('在此时间之后雇主就能够取消雇佣了');
            $table->timestamp('except_max_at')->nullable()->comment('接受雇佣的最终时间限制');
            $table->timestamp('end_at')->nullable()->comment('结束时间');
            $table->timestamp('begin_at')->nullable()->comment('开始时间');
            $table->timestamp('accept_deadline')->nullable()->comment('验收截止时间');
            $table->timestamp('accept_at')->nullable()->comment('验收时间');
            $table->timestamp('right_allow_at')->nullable()->comment('威客交付之后的维权期限');
            $table->timestamp('comment_deadline')->nullable()->comment('评价截止时间');
            $table->tinyInteger('employ_type', false)->default(0)->comment('0表示雇佣 1表示服务雇佣');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('employ');
    }
}
