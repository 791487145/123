<?php

use Illuminate\Database\Seeder;

class AgreementTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('agreement')->delete();
        
        \DB::table('agreement')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '注册协议',
                'content' => '<div align="center"><b><font size="5">注册协议</font></b><br></div><font size="3">           <span id="transmark"></span>东方舵手关键的是该机的后果回到合肥国家的繁华国家的繁华高房价</font>',
                'code_name' => 'register',
                'created_at' => '2016-06-06 16:09:02',
                'updated_at' => '2016-07-18 11:27:23',
            ),
            1 => 
            array (
                'id' => 5,
                'name' => '任务发布协议',
                'content' => 'dfdsgfdgfd',
                'code_name' => 'task_publish',
                'created_at' => '2016-06-07 16:14:16',
                'updated_at' => '2016-06-07 16:14:16',
            ),
            2 => 
            array (
                'id' => 6,
                'name' => '文件交付协议',
                'content' => '大富大贵到凤凰股份的合法的合规呵呵',
                'code_name' => 'task_delivery ',
                'created_at' => '2016-06-07 16:21:15',
                'updated_at' => '2016-06-07 16:21:15',
            ),
            3 => 
            array (
                'id' => 7,
                'name' => '文件交稿协议',
                'content' => '非官方一个人团圆trytruth报告和法国恢复热一热一',
                'code_name' => 'task_draft',
                'created_at' => '2016-06-08 10:54:00',
                'updated_at' => '2016-06-08 10:54:00',
            ),
        ));
        
        
    }
}
