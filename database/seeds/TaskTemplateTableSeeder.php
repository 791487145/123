<?php

use Illuminate\Database\Seeder;

class TaskTemplateTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('task_template')->delete();
        
        \DB::table('task_template')->insert(array (
            0 => 
            array (
                'id' => 6,
                'title' => '厦门小吃餐厅logo',
            'content' => '&lt;p style=&quot;margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;&lt;span style=&quot;font-weight: 700;&quot;&gt;客家人&rdquo;厦门经营特色小吃的餐厅，LOGO设计及简单应用&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;&lt;span style=&quot;font-weight: 700;&quot;&gt;经营介绍：&lt;/span&gt;&nbsp;&ldquo;客家人&rdquo;是一家以经营特色小吃为主的快餐餐厅特色餐品&ldquo;客家人&rdquo;是用独特的传统工艺制作而成，口感独特，明显区别其它面种，传承百年，获奖无数。&lt;/p&gt;&lt;p style=&quot;margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;&lt;span style=&quot;font-weight: 700;&quot;&gt;VI应用内容：&lt;/span&gt;设计LOGO、店面招牌设计(竖排，横排)、菜牌、名片、餐巾纸、筷子纸筒、牙签包装 、员工胸牌、服装设计。&lt;/p&gt;&lt;p style=&quot;margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;&lt;span style=&quot;font-weight: 700;&quot;&gt;设计要求：&lt;/span&gt;&lt;/p&gt;&lt;ul class=&quot;ml_20&quot; style=&quot;margin-bottom: 0px; margin-left: 20px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;&lt;li style=&quot;margin: 0px; padding: 0px; list-style: none;&quot;&gt;1、大气、简洁、明快;&lt;/li&gt;&lt;li style=&quot;margin: 0px; padding: 0px; list-style: none;&quot;&gt;2、有视觉冲击力，醒目易识别，突出餐饮品牌元素;&lt;/li&gt;&lt;li style=&quot;margin: 0px; padding: 0px; list-style: none;&quot;&gt;3、能体现特色，LOGO已有，但如限制了设计师的创意，可重新设计。&lt;/li&gt;&lt;li style=&quot;margin: 0px; padding: 0px; list-style: none;&quot;&gt;4、附上创意说明。&lt;/li&gt;&lt;/ul&gt;&lt;p style=&quot;margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;&lt;span style=&quot;font-weight: 700;&quot;&gt;知识产权说明：&lt;/span&gt;&lt;/p&gt;&lt;ul class=&quot;ml_20&quot; style=&quot;margin-bottom: 0px; margin-left: 20px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;&lt;li style=&quot;margin: 0px; padding: 0px; list-style: none;&quot;&gt;1、所设计的作品为原创，为第一次发布，未侵犯他人的著作权，如有侵犯他人著作权，由设计者承担所有法律责任;&lt;/li&gt;&lt;li style=&quot;margin: 0px; padding: 0px; list-style: none;&quot;&gt;2、中标的设计作品，我方支付设计制作费，即拥有该作品的知识产权，包括著作权,使用权和发布权等,有权对设计作品进行修改,组合和应用;设计者不得再向其他任何地方使用该设计作品;&lt;/li&gt;&lt;/ul&gt;',
                'cate_id' => 166,
                'status' => 1,
                'created_at' => '2016-07-04 17:38:29',
            ),
            1 => 
            array (
                'id' => 7,
                'title' => '节能灯宣传软文撰写',
            'content' => '&lt;p style=&quot;margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;软文主要围绕&ldquo;节能灯&rdquo;来写，要以消费者(可以是公司、网吧、酒店、工厂、超市，学校任意)需求来讲述通过使用该产品的效果，不能太过于做作.要有针对性。考虑到很多威客对我们公司不熟悉，了解产品请登录：www.XXXXXXcom ，详细了解大家可以和我直接联系，我的QQ是 xxxxxx&lt;/p&gt;&lt;p style=&quot;margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;&lt;span style=&quot;font-weight: 700;&quot;&gt;软文要求：&lt;/span&gt;&lt;/p&gt;&lt;ul class=&quot;ml_20&quot; style=&quot;margin-bottom: 0px; margin-left: 20px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;&lt;li style=&quot;margin: 0px; padding: 0px; list-style: none;&quot;&gt;1、软文将用于发布在各种行业论坛及博客，标题和内容绝对不能有广告味，要能引起点击和共鸣，能吸引网友参与讨论或点击浏览&lt;/li&gt;&lt;li style=&quot;margin: 0px; padding: 0px; list-style: none;&quot;&gt;2、文章要有吸引力，有趣味性， 要站在用户的角度来描写，帖子内容与标题给人感觉以个人感受、经验分享或消费经历为表现形式,以宣传推广我司业务。&lt;/li&gt;&lt;li style=&quot;margin: 0px; padding: 0px; list-style: none;&quot;&gt;3、要求原创(不能在网上搜了抄袭)，文笔或专业，或幽默，或结合时事，具备新闻性皆可。不要做的太像推广。&lt;/li&gt;&lt;li style=&quot;margin: 0px; padding: 0px; list-style: none;&quot;&gt;4、附上创意说明。&lt;/li&gt;&lt;/ul&gt;&lt;p style=&quot;margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;&lt;span style=&quot;font-weight: 700;&quot;&gt;知识产权说明：&lt;/span&gt;&lt;/p&gt;&lt;ul class=&quot;ml_20&quot; style=&quot;margin-bottom: 0px; margin-left: 20px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;&lt;li style=&quot;margin: 0px; padding: 0px; list-style: none;&quot;&gt;1、所设计的作品为原创，为第一次发布，未侵犯他人的著作权，如有侵犯他人著作权，由设计者承担所有法律责任;&lt;/li&gt;&lt;li style=&quot;margin: 0px; padding: 0px; list-style: none;&quot;&gt;2、中标的设计作品，我方支付设计制作费，即拥有该作品的知识产权，包括著作权,使用权和发布权等,有权对设计作品进行修改,组合和应用;设计者不得再向其他任何地方使用该设计作品;&lt;/li&gt;&lt;/ul&gt;',
                'cate_id' => 167,
                'status' => 1,
                'created_at' => '2016-07-04 17:39:05',
            ),
            2 => 
            array (
                'id' => 8,
                'title' => '汇编microship芯片源码',
            'content' => '&lt;p style=&quot;margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;想找一个熟悉microship芯片12F系列的朋友，在读懂程序功能的基础上，写出功能流程说明和注解，整理出流程合理的汇编源码，已有microship 8位 mcus的hex文件。这是一个比较简单的小程序。希望高手帮忙。提交物分两部分：&lt;/p&gt;&lt;p style=&quot;margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;&lt;span style=&quot;font-weight: 700;&quot;&gt;1. 程序功能说明：&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;这个程序在芯片中的工作流程说明和流程图，针脚的定义，输入输出信息。&lt;/p&gt;&lt;p style=&quot;margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;&lt;span style=&quot;font-weight: 700;&quot;&gt;2.汇编源码&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;&lt;span style=&quot;font-weight: 700;&quot;&gt;特别注意:&lt;/span&gt;&lt;/p&gt;&lt;ul class=&quot;ml_20&quot; style=&quot;margin-bottom: 0px; margin-left: 20px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;&lt;li style=&quot;margin: 0px; padding: 0px; list-style: none;&quot;&gt;a.要求的不是简单的反汇编，而是在读懂程序功能基础上，给出设计合理的汇编源码。&lt;/li&gt;&lt;li style=&quot;margin: 0px; padding: 0px; list-style: none;&quot;&gt;b.说明如何修改代码控制芯片管脚输入输出值。&lt;/li&gt;&lt;li style=&quot;margin: 0px; padding: 0px; list-style: none;&quot;&gt;c.要求必须对每行加以注释，使新手可以读懂。&lt;/li&gt;&lt;/ul&gt;&lt;p style=&quot;margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;附件中是hex文件和配置字，如果有不清楚的地方，随时联系。谢谢。&lt;/p&gt;',
                'cate_id' => 168,
                'status' => 1,
                'created_at' => '2016-07-04 17:39:57',
            ),
            3 => 
            array (
                'id' => 9,
                'title' => '电子商务网站计件推广',
            'content' => '&lt;p style=&quot;margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;&lt;span style=&quot;font-weight: 700;&quot;&gt;条件：&lt;/span&gt;QQ群发送，每3个QQ群为一稿，一份稿件为1元，多劳多得。&lt;/p&gt;&lt;p style=&quot;margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;&lt;span style=&quot;font-weight: 700;&quot;&gt;QQ群要求：&lt;/span&gt;QQ群人数需要在100人以上，在线人数必须超过30人.超过200人的超级群优先审核。在线人数不够30人的可以多发一个群。&lt;/p&gt;&lt;p style=&quot;margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;&lt;span style=&quot;font-weight: 700;&quot;&gt;发送对象：&lt;/span&gt;求职、招聘、服装、交友、星座等QQ群。&lt;/p&gt;&lt;p style=&quot;margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;&lt;span style=&quot;font-weight: 700;&quot;&gt;交稿条件：&lt;/span&gt;发送结束后提交一整张完整的对话框截图，截图包含(QQ群名称、QQ群总人数、在线人数和任务广告)&lt;/p&gt;&lt;p style=&quot;margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;&lt;span style=&quot;font-weight: 700;&quot;&gt;文案字体：&lt;/span&gt;宋体12 红色&lt;/p&gt;&lt;p style=&quot;margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;发布内容请下载附件。（需要上传附件）&lt;/p&gt;&lt;p style=&quot;margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;&lt;span style=&quot;font-weight: 700;&quot;&gt;完成时限：&lt;/span&gt;X月X日X时截止。&lt;/p&gt;',
                'cate_id' => 169,
                'status' => 1,
                'created_at' => '2016-07-04 17:40:54',
            ),
            4 => 
            array (
                'id' => 10,
                'title' => '汇编microship芯片源码',
            'content' => '&lt;p style=&quot;margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;想找一个熟悉microship芯片12F系列的朋友，在读懂程序功能的基础上，写出功能流程说明和注解，整理出流程合理的汇编源码，已有microship 8位 mcus的hex文件。这是一个比较简单的小程序。希望高手帮忙。提交物分两部分：&lt;/p&gt;&lt;p style=&quot;margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;&lt;span style=&quot;font-weight: 700;&quot;&gt;1. 程序功能说明：&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;这个程序在芯片中的工作流程说明和流程图，针脚的定义，输入输出信息。&lt;/p&gt;&lt;p style=&quot;margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;&lt;span style=&quot;font-weight: 700;&quot;&gt;2.汇编源码&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;&lt;span style=&quot;font-weight: 700;&quot;&gt;特别注意:&lt;/span&gt;&lt;/p&gt;&lt;ul class=&quot;ml_20&quot; style=&quot;margin-bottom: 0px; margin-left: 20px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;&lt;li style=&quot;margin: 0px; padding: 0px; list-style: none;&quot;&gt;a.要求的不是简单的反汇编，而是在读懂程序功能基础上，给出设计合理的汇编源码。&lt;/li&gt;&lt;li style=&quot;margin: 0px; padding: 0px; list-style: none;&quot;&gt;b.说明如何修改代码控制芯片管脚输入输出值。&lt;/li&gt;&lt;li style=&quot;margin: 0px; padding: 0px; list-style: none;&quot;&gt;c.要求必须对每行加以注释，使新手可以读懂。&lt;/li&gt;&lt;/ul&gt;&lt;p style=&quot;margin-bottom: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: 微软雅黑; font-size: 12px; line-height: 24px;&quot;&gt;附件中是hex文件和配置字，如果有不清楚的地方，随时联系。谢谢。&lt;/p&gt;',
                'cate_id' => 170,
                'status' => 1,
                'created_at' => '2016-07-04 17:41:52',
            ),
        ));
        
        
    }
}
