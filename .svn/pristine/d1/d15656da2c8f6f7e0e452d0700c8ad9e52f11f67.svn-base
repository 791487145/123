<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('任务标题');
            $table->longText('desc')->nullable()->comment('任务描述');
            $table->integer('type_id', false)->comment('任务类型');
            $table->integer('cate_id', false)->comment('任务分类');
            $table->string('phone',32)->comment('联系电话');
            $table->integer('region_limit', false)->default(0)->comment('地域限制');
            $table->tinyInteger('status', false)->default(0)->comment('任务状态:\n0 暂不发布 \n1 已经发布 2托管赏金\n 3审核通过\n 4威客交稿\n 5雇主选稿\n 6任务公示\n 7交付验收\n 8双方互评 9已结束 10失败 11维权 ');
            $table->decimal('bounty',10,2)->default(0)->comment('赏金金额');
            $table->tinyInteger('bounty_status', false)->default(0)->comment('赏金状态\n0 未托管\n1 已托管');
            $table->timestamp('verified_at')->nullable()->comment('审核时间');
            $table->timestamp('begin_at')->nullable()->comment('任务开始时间');
            $table->timestamp('end_at')->nullable()->comment('任务结束时间');
            $table->timestamp('delivery_deadline')->nullable()->comment('交稿结束时间');
            $table->timestamp('selected_work_at')->nullable()->comment('选稿时间');
            $table->timestamp('publicity_at')->nullable()->comment('任务公示时间');
            $table->timestamp('checked_at')->nullable()->comment('验收期进入时间');
            $table->timestamp('comment_at')->nullable()->comment('双方互评开始时间');
            $table->decimal('show_cash',10,2)->default(0)->comment('展示赏金');
            $table->decimal('real_cash',10,2)->default(0)->comment('实付赏金');
            $table->decimal('deposit_cash',10,2)->default(0)->comment('已托管金额');
            $table->integer('province', false)->default(0)->comment('省');
            $table->integer('city', false)->default(0)->comment('城市');
            $table->integer('area', false)->default(0)->comment('地区');

            $table->integer('view_count', false)->default(0)->comment('浏览次数');
            $table->integer('delivery_count', false)->default(0)->comment('投稿数量');
            $table->integer('uid', false)->nullable()->comment('用户ID');
            $table->string('username',32)->nullable()->comment('用户名');
            $table->tinyInteger('worker_num', false)->nullable()->comment('服务商数量');
            $table->tinyInteger('top_status', false)->default(0)->comment('是否置顶 1表示置顶 0表示非置顶');
            $table->tinyInteger('engine_status',false)->default(0)->comment('搜索引擎屏蔽 0表示不屏蔽 1表示屏蔽');
            $table->tinyInteger('work_status',false)->default(0)->comment('稿件是否隐藏 0表示不隐藏 1表示隐藏');
            $table->string('service', 32)->nullable()->comment('增值服务的id');
            $table->tinyInteger('task_success_draw_ratio',false)->default(0)->comment('表示任务成功抽成比率');
            $table->tinyInteger('task_fail_draw_ratio',false)->default(0)->comment('表示任务失败抽成比率');
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
        Schema::drop('task');
    }
}
