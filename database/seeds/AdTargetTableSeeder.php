<?php

use Illuminate\Database\Seeder;

class AdTargetTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ad_target')->delete();
        
        \DB::table('ad_target')->insert(array (
            0 => 
            array (
                'target_id' => 1,
                'name' => '首页_顶部幻灯片广告',
                'code' => 'HOME_TOP_SLIDE',
                'description' => '首页_顶部幻灯片广告',
                'targets' => '',
                'position' => NULL,
                'ad_size' => NULL,
                'ad_num' => 6,
                'pic' => NULL,
                'is_open' => 1,
                'content' => NULL,
            ),
            1 => 
            array (
                'target_id' => 2,
                'name' => '首页_底部广告',
                'code' => 'HOME_BOTTOM',
                'description' => '首页_底部广告',
                'targets' => '',
                'position' => NULL,
                'ad_size' => NULL,
                'ad_num' => 1,
                'pic' => NULL,
                'is_open' => 1,
                'content' => NULL,
            ),
            2 => 
            array (
                'target_id' => 3,
                'name' => '任务大厅_底部广告',
                'code' => 'TASKLIST_BOTTOM',
                'description' => '任务大厅_底部广告',
                'targets' => '',
                'position' => NULL,
                'ad_size' => NULL,
                'ad_num' => 1,
                'pic' => NULL,
                'is_open' => 1,
                'content' => NULL,
            ),
            3 => 
            array (
                'target_id' => 4,
                'name' => '任务大厅_右上方广告',
                'code' => 'TASKLIST_RIGHT_TOP',
                'description' => '任务大厅_右上方广告',
                'targets' => '',
                'position' => NULL,
                'ad_size' => NULL,
                'ad_num' => 1,
                'pic' => NULL,
                'is_open' => 1,
                'content' => NULL,
            ),
            4 => 
            array (
                'target_id' => 5,
                'name' => '任务详情_右侧广告',
                'code' => 'TASKINFO_RIGHT',
                'description' => '任务详情_右侧广告',
                'targets' => '',
                'position' => NULL,
                'ad_size' => NULL,
                'ad_num' => 1,
                'pic' => NULL,
                'is_open' => 1,
                'content' => NULL,
            ),
            5 => 
            array (
                'target_id' => 6,
                'name' => '登陆注册_左侧广告',
                'code' => 'LOGIN_LEFT',
                'description' => '登录注册_左侧广告',
                'targets' => '',
                'position' => NULL,
                'ad_size' => NULL,
                'ad_num' => 1,
                'pic' => NULL,
                'is_open' => 1,
                'content' => NULL,
            ),
            6 => 
            array (
                'target_id' => 7,
                'name' => '服务商_底部广告',
                'code' => 'SELLERLIST_BOTTOM',
                'description' => '服务商_底部广告',
                'targets' => '',
                'position' => NULL,
                'ad_size' => NULL,
                'ad_num' => 1,
                'pic' => NULL,
                'is_open' => 1,
                'content' => NULL,
            ),
            7 => 
            array (
                'target_id' => 8,
                'name' => '服务商_右上方广告',
                'code' => 'SELLERLIST_RIGHT_TOP',
                'description' => '服务商_右上方广告',
                'targets' => '',
                'position' => NULL,
                'ad_size' => NULL,
                'ad_num' => 1,
                'pic' => NULL,
                'is_open' => 1,
                'content' => NULL,
            ),
            8 => 
            array (
                'target_id' => 9,
                'name' => '成功案例_底部广告',
                'code' => 'CASELIST_BOTTOM',
                'description' => '成功案例_底部广告',
                'targets' => '',
                'position' => NULL,
                'ad_size' => NULL,
                'ad_num' => 1,
                'pic' => NULL,
                'is_open' => 1,
                'content' => NULL,
            ),
            9 => 
            array (
                'target_id' => 10,
                'name' => '成功案例详情_底部广告',
                'code' => 'CASEINFO_BOTTOM',
                'description' => '成功案例详情_底部广告',
                'targets' => '',
                'position' => NULL,
                'ad_size' => NULL,
                'ad_num' => 1,
                'pic' => NULL,
                'is_open' => 1,
                'content' => NULL,
            ),
            10 => 
            array (
                'target_id' => 11,
                'name' => '成功案例详情_右上方广告',
                'code' => 'CASEINFO_RIGHT_TOP',
                'description' => '成功案例详情_右上方广告',
                'targets' => '',
                'position' => NULL,
                'ad_size' => NULL,
                'ad_num' => 1,
                'pic' => NULL,
                'is_open' => 1,
                'content' => NULL,
            ),
            11 => 
            array (
                'target_id' => 12,
                'name' => '资讯中心_顶部广告',
                'code' => 'NEWSLIST_TOP',
                'description' => '资讯中心_顶部广告',
                'targets' => '',
                'position' => NULL,
                'ad_size' => NULL,
                'ad_num' => 1,
                'pic' => NULL,
                'is_open' => 1,
                'content' => NULL,
            ),
            12 => 
            array (
                'target_id' => 13,
                'name' => '资讯中心_右上方广告',
                'code' => 'NEWSLIST_RIGHT_TOP',
                'description' => '资讯中心_右上方广告',
                'targets' => '',
                'position' => NULL,
                'ad_size' => NULL,
                'ad_num' => 1,
                'pic' => NULL,
                'is_open' => 1,
                'content' => NULL,
            ),
            13 => 
            array (
                'target_id' => 14,
                'name' => '资讯中心详情_顶部广告',
                'code' => 'NEWSINFO_TOP',
                'description' => '资讯中心详情_顶部广告',
                'targets' => '',
                'position' => NULL,
                'ad_size' => NULL,
                'ad_num' => 1,
                'pic' => NULL,
                'is_open' => 1,
                'content' => NULL,
            ),
            14 => 
            array (
                'target_id' => 15,
                'name' => '资讯中心详情_右上方广告',
                'code' => 'NEWSINFO_RIGHT_TOP',
                'description' => '资讯中心详情_右上方广告',
                'targets' => '',
                'position' => NULL,
                'ad_size' => NULL,
                'ad_num' => 1,
                'pic' => NULL,
                'is_open' => 1,
                'content' => NULL,
            ),
            15 => 
            array (
                'target_id' => 16,
                'name' => '任务稿件交付_右下方广告',
                'code' => 'TASKDELIVERY_RIGHT_BUTTOM',
                'description' => '任务稿件交付_右下方广告',
                'targets' => '',
                'position' => NULL,
                'ad_size' => NULL,
                'ad_num' => 1,
                'pic' => NULL,
                'is_open' => 1,
                'content' => NULL,
            ),
            16 => 
            array (
                'target_id' => 17,
                'name' => '回答列表_右上方广告',
                'code' => 'ANSWERLIST_RIGHT_TOP',
                'description' => '回答列表_右上方广告',
                'targets' => '',
                'position' => NULL,
                'ad_size' => NULL,
                'ad_num' => 1,
                'pic' => NULL,
                'is_open' => 1,
                'content' => NULL,
            ),
            17 => 
            array (
                'target_id' => 18,
                'name' => '问答中心_顶部广告',
                'code' => 'QUESTIONLIST_TOP',
                'description' => '问答中心_顶部广告',
                'targets' => '',
                'position' => NULL,
                'ad_size' => NULL,
                'ad_num' => 1,
                'pic' => NULL,
                'is_open' => 1,
                'content' => NULL,
            ),
            18 => 
            array (
                'target_id' => 19,
                'name' => 'VIP_顶部幻灯片广告',
                'code' => 'VIP_TOP_SLIDE',
                'description' => 'VIP_顶部幻灯片广告',
                'targets' => '',
                'position' => NULL,
                'ad_size' => NULL,
                'ad_num' => 6,
                'pic' => NULL,
                'is_open' => 1,
                'content' => NULL,
            ),
            19 => 
            array (
                'target_id' => 20,
                'name' => '威客商城_底部广告',
                'code' => 'SHOP_BOTTOM',
                'description' => '威客商城_底部广告',
                'targets' => '',
                'position' => NULL,
                'ad_size' => NULL,
                'ad_num' => 1,
                'pic' => NULL,
                'is_open' => 1,
                'content' => NULL,
            ),
        ));
        
        
    }
}
