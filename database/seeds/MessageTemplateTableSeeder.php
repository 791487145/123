<?php

use Illuminate\Database\Seeder;

class MessageTemplateTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('message_template')->delete();
        
        \DB::table('message_template')->insert(array (
            0 => 
            array (
                'id' => 11,
                'code_name' => 'password_back',
                'name' => '密码找回',
            'content' => '&lt;p style=&quot;margin-top: 5px; margin-bottom: 5px; color: rgb(0, 0, 0); font-family: sans-serif; font-size: 16px; line-height: normal;&quot;&gt;亲爱的用户：&lt;/p&gt;&lt;p style=&quot;margin-top: 5px; margin-bottom: 5px; color: rgb(0, 0, 0); font-family: sans-serif; font-size: 16px; line-height: normal;&quot;&gt;您好！感谢您使用{{website}}，您正在进行邮箱验证，本次请求的验证码为：&lt;/p&gt;&lt;p style=&quot;margin-top: 5px; margin-bottom: 5px; color: rgb(0, 0, 0); font-family: sans-serif; font-size: 16px; line-height: normal;&quot;&gt;{{verification_code }}(为了保障您帐号的安全性，请在1小时内完成验证。)&lt;/p&gt;&lt;p style=&quot;margin-top: 5px; margin-bottom: 5px; color: rgb(0, 0, 0); font-family: sans-serif; font-size: 16px; line-height: normal;&quot;&gt;如有任何疑问，欢迎随时与我们联系，我们将竭诚为您服务！&lt;/p&gt;&lt;p style=&quot;margin-top: 5px; margin-bottom: 5px; color: rgb(0, 0, 0); font-family: sans-serif; font-size: 16px; line-height: normal;&quot;&gt;欢迎继续关注{{website&lt;span id=&quot;transmark&quot;&gt;&lt;/span&gt;}}！&lt;/p&gt;&lt;p style=&quot;margin-top: 5px; margin-bottom: 5px; color: rgb(0, 0, 0); font-family: sans-serif; font-size: 16px; line-height: normal;&quot;&gt;祝：&lt;/p&gt;&lt;p style=&quot;margin-top: 5px; margin-bottom: 5px; color: rgb(0, 0, 0); font-family: sans-serif; font-size: 16px; line-height: normal;&quot;&gt;工作学习顺利， 生活愉快！&lt;/p&gt;',
                'message_type' => 1,
                'is_open' => 1,
                'is_on_site' => 0,
                'is_send_email' => 0,
                'created_at' => NULL,
                'updated_at' => '2016-06-30 15:27:09',
                'num' => 3,
                'variable_str' => 'website,verification_code ,website&lt;span id=&quot;transmark&quot;&gt;&lt;/span&gt;',
            ),
            1 => 
            array (
                'id' => 23,
                'code_name' => 'task_publish_success',
                'name' => '任务发布成功',
                'content' => '&lt;p&gt;尊敬的{{username}}：&lt;/p&gt;&lt;p&gt;您的任务[{{task_number}}]{{task_title}}{{task_status}}，感谢您对{{website}}的信任。如有特殊情况，请致电客服，我们将协助您解决问题。&lt;/p&gt;&lt;p&gt;任务编号：{{task_number}}&lt;/p&gt;&lt;p&gt;任务标题：&lt;a href=&quot;{{href}}&quot; target=&quot;_blank&quot;&gt;{{task_link}}&lt;/a&gt;&lt;/p&gt;&lt;p&gt;任务状态：{{task_status}}&lt;/p&gt;&lt;p&gt;开始时间：{{start_time}}&lt;/p&gt;&lt;p&gt;投稿结束时间：{{manuscript_end_time}}&lt;span id=&quot;transmark&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;--------------------------------------------------------------------------------------------------------------------&lt;/p&gt;&lt;p&gt;此邮件为系统自动发出的邮件，请勿直接回复。&lt;/p&gt;',
                'message_type' => 2,
                'is_open' => 1,
                'is_on_site' => 1,
                'is_send_email' => 0,
                'created_at' => NULL,
                'updated_at' => '2016-11-03 14:40:55',
                'num' => 9,
                'variable_str' => 'username,task_number,task_title,task_status,website,href,task_link,start_time,manuscript_end_time',
            ),
            2 => 
            array (
                'id' => 24,
                'code_name' => 'task_win',
                'name' => '任务中标',
                'content' => '&lt;p&gt;尊敬的 {{username}}：&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;您的稿件被雇主选中，感谢您对{{website}}网的信任。如有特殊情况，请致电客服，我们将协助您解决问题。&lt;/p&gt;&lt;p&gt;任务编号：{{task_number}}&lt;/p&gt;&lt;p&gt;任务标题：&lt;a href=&quot;{{href}}&quot; target=&quot;_blank&quot;&gt;{{task_title}}&lt;/a&gt;&lt;/p&gt;&lt;p&gt;中标金额: {{win_price&lt;span id=&quot;transmark&quot;&gt;&lt;/span&gt;}}&lt;/p&gt;&lt;p&gt;--------------------------------------------------------------------------------------------------------------------&lt;/p&gt;&lt;p&gt;此邮件为系统自动发出的邮件，请勿直接回复。&lt;/p&gt;',
                'message_type' => 2,
                'is_open' => 1,
                'is_on_site' => 1,
                'is_send_email' => 0,
                'created_at' => NULL,
                'updated_at' => '2016-11-03 14:27:55',
                'num' => 6,
                'variable_str' => 'username,website,task_number,href,task_title,win_price&lt;span id=&quot;transmark&quot;&gt;&lt;/span&gt;',
            ),
            3 => 
            array (
                'id' => 25,
                'code_name' => 'task_audit_failure ',
                'name' => '任务审核失败',
                'content' => '&lt;p&gt;尊敬的 {{username}}：&lt;br/&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; 您的发布的任务 &lt;a href=&quot;{{href}}&quot; target=&quot;_blank&quot;&gt;{{task_title}}&lt;/a&gt; 未通过审核，感谢您对{{website&lt;span id=&quot;transmark&quot;&gt;&lt;/span&gt;}}的信任。如有特殊情况，请致电客服，我们将协助您解决问题。&lt;/p&gt;',
                'message_type' => 2,
                'is_open' => 1,
                'is_on_site' => 1,
                'is_send_email' => 0,
                'created_at' => NULL,
                'updated_at' => '2016-11-03 14:24:05',
                'num' => 4,
                'variable_str' => 'username,href,task_title,website&lt;span id=&quot;transmark&quot;&gt;&lt;/span&gt;',
            ),
            4 => 
            array (
                'id' => 26,
                'code_name' => 'audit_success',
                'name' => '审核通过',
                'content' => '&lt;p&gt;尊敬的 {{username}}：&lt;br/&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; 您的发布的任务已通过审核，感谢您对{{website}}的信任。如有特殊情况，请致电客服，我们将协助您解决问题。&lt;br/&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; &lt;span id=&quot;transmark&quot;&gt;&lt;/span&gt;任务编号：{{task_number}}&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;任务链接 ：{{task_link}}&lt;br/&gt;&lt;/p&gt;',
                'message_type' => 2,
                'is_open' => 1,
                'is_on_site' => 1,
                'is_send_email' => 0,
                'created_at' => NULL,
                'updated_at' => '2016-11-03 14:21:07',
                'num' => 4,
                'variable_str' => 'username,website,task_number,task_link',
            ),
            5 => 
            array (
                'id' => 28,
                'code_name' => 'task_delivery ',
                'name' => '任务交稿',
                'content' => '&lt;p&gt;尊敬的 {{username}}：&lt;/p&gt;&lt;p&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; {{name}}向您&lt;span id=&quot;transmark&quot;&gt;&lt;/span&gt;的&lt;a href=&quot;http://{{href}}&quot; target=&quot;_blank&quot;&gt;{{task_title}}&lt;/a&gt;提交了稿件。&lt;/p&gt;&lt;p&gt;感谢您对{{website}}的信任。如有特殊情况，请致电客服&lt;/p&gt;',
                'message_type' => 2,
                'is_open' => 1,
                'is_on_site' => 1,
                'is_send_email' => 0,
                'created_at' => NULL,
                'updated_at' => '2016-11-03 14:05:56',
                'num' => 5,
                'variable_str' => 'username,name,href,task_title,website',
            ),
            6 => 
            array (
                'id' => 29,
                'code_name' => 'trading_rights ',
                'name' => '交易维权受理',
                'content' => '&lt;p&gt;尊敬的{{username}}：&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;任务{{tasktitle}}相关稿件维权已被网站受理，请耐心等待平台的处理。&lt;/p&gt;&lt;p&gt;感谢您对{{website&lt;span id=&quot;transmark&quot;&gt;&lt;/span&gt;}}的信任。如有特殊情况，请致电客服&lt;/p&gt; ',
                'message_type' => 2,
                'is_open' => 1,
                'is_on_site' => 1,
                'is_send_email' => 0,
                'created_at' => NULL,
                'updated_at' => '2016-07-27 14:20:01',
                'num' => 3,
                'variable_str' => 'username,tasktitle,website&lt;span id=&quot;transmark&quot;&gt;&lt;/span&gt;',
            ),
            7 => 
            array (
                'id' => 30,
                'code_name' => 'trading_rights_result ',
                'name' => '交易维权结果',
                'content' => '&lt;p style=&quot;line-height: 18.5714px;&quot;&gt;尊敬的{{username}}：&lt;/p&gt;&lt;p style=&quot;line-height: 18.5714px;&quot;&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 经过平台判定，{{workname}}稿件维权处理结果为：{{ownername}}分配赏金{{ownermoney}}，{{workername}}分配赏金{{wokermoney}}&lt;/p&gt;&lt;p style=&quot;line-height: 18.5714px;&quot;&gt;感谢您对{{website&lt;span id=&quot;transmark&quot;&gt;&lt;/span&gt;}}的信任。如有特殊情况，请致电客服&lt;/p&gt;',
                'message_type' => 2,
                'is_open' => 1,
                'is_on_site' => 1,
                'is_send_email' => 0,
                'created_at' => NULL,
                'updated_at' => '2016-07-18 15:35:42',
                'num' => 7,
                'variable_str' => 'username,workname,ownername,ownermoney,workername,wokermoney,website&lt;span id=&quot;transmark&quot;&gt;&lt;/span&gt;',
            ),
            8 => 
            array (
                'id' => 32,
                'code_name' => 'agreement_documents',
                'name' => '任务交付',
            'content' => '&lt;p style=&quot;margin-top: 5px; margin-bottom: 5px; color: rgb(0, 0, 0); font-family: sans-serif; font-size: 16px; line-height: normal;&quot;&gt;尊敬的 {{username}}：&lt;/p&gt;&lt;p style=&quot;margin-top: 5px; margin-bottom: 5px; color: rgb(0, 0, 0); font-family: sans-serif; font-size: 16px; line-height: normal;&quot;&gt;用户{{initiator}}已经交付：&lt;/p&gt;&lt;p style=&quot;margin-top: 5px; margin-bottom: 5px; color: rgb(0, 0, 0); font-family: sans-serif; font-size: 16px; line-height: normal;&quot;&gt;任务链接：{{agreement_link}}&lt;/p&gt;&lt;p style=&quot;margin-top: 5px; margin-bottom: 5px; color: rgb(0, 0, 0); font-family: sans-serif; font-size: 16px; line-height: normal;&quot;&gt;感谢您对{{website&lt;span id=&quot;transmark&quot;&gt;&lt;/span&gt;}}的信任。如有特殊情况，请致电客服&lt;/p&gt;',
                'message_type' => 2,
                'is_open' => 1,
                'is_on_site' => 1,
                'is_send_email' => 0,
                'created_at' => NULL,
                'updated_at' => '2016-07-18 15:35:44',
                'num' => 4,
                'variable_str' => 'username,initiator,agreement_link,website&lt;span id=&quot;transmark&quot;&gt;&lt;/span&gt;',
            ),
            9 => 
            array (
                'id' => 33,
                'code_name' => 'Automatic_choose',
                'name' => '自动选稿',
            'content' => '&lt;p style=&quot;margin-top: 5px; margin-bottom: 5px; color: rgb(0, 0, 0); font-family: sans-serif; font-size: 16px; line-height: normal;&quot;&gt;尊敬的 {{username}}：&lt;/p&gt;&lt;p style=&quot;margin-top: 5px; margin-bottom: 5px; color: rgb(0, 0, 0); font-family: sans-serif; font-size: 16px; line-height: normal;&quot;&gt;您参与的任务{{task_number}}进行了自动选稿，任务信息：&lt;/p&gt;&lt;p style=&quot;margin-top: 5px; margin-bottom: 5px; color: rgb(0, 0, 0); font-family: sans-serif; font-size: 16px; line-height: normal;&quot;&gt;任务标题：&lt;a href=&quot;{{href}}&quot; target=&quot;_blank&quot;&gt;{{task_title}}&lt;/a&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 5px; margin-bottom: 5px; color: rgb(0, 0, 0); font-family: sans-serif; font-size: 16px; line-height: normal;&quot;&gt;感谢您对{{website&lt;span id=&quot;transmark&quot;&gt;&lt;/span&gt;}}的信任。如有特殊情况，请致电客服&lt;/p&gt;',
                'message_type' => 2,
                'is_open' => 1,
                'is_on_site' => 1,
                'is_send_email' => 0,
                'created_at' => NULL,
                'updated_at' => '2016-11-03 13:59:23',
                'num' => 5,
                'variable_str' => 'username,task_number,href,task_title,website&lt;span id=&quot;transmark&quot;&gt;&lt;/span&gt;',
            ),
            10 => 
            array (
                'id' => 34,
                'code_name' => 'manuscript_settlement ',
                'name' => '稿件结算',
            'content' => '&lt;p style=&quot;margin-top: 5px; margin-bottom: 5px; color: rgb(0, 0, 0); font-family: sans-serif; font-size: 16px; line-height: normal;&quot;&gt;尊敬的 {{username}}：&lt;/p&gt;&lt;p style=&quot;margin-top: 5px; margin-bottom: 5px; color: rgb(0, 0, 0); font-family: sans-serif; font-size: 16px; line-height: normal;&quot;&gt;您参与的任务已经结束。&lt;/p&gt;&lt;p style=&quot;margin-top: 5px; margin-bottom: 5px; color: rgb(0, 0, 0); font-family: sans-serif; font-size: 16px; line-height: normal;&quot;&gt;任务编号：{{task_number}}&lt;/p&gt;&lt;p style=&quot;margin-top: 5px; margin-bottom: 5px; color: rgb(0, 0, 0); font-family: sans-serif; font-size: 16px; line-height: normal;&quot;&gt;任务链接：{{task_link}}&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 5px; margin-bottom: 5px; color: rgb(0, 0, 0); font-family: sans-serif; font-size: 16px; line-height: normal;&quot;&gt;感谢您对{{website&lt;span id=&quot;transmark&quot;&gt;&lt;/span&gt;}}的信任。如有特殊情况，请致电客服&lt;/p&gt;',
                'message_type' => 2,
                'is_open' => 1,
                'is_on_site' => 1,
                'is_send_email' => 0,
                'created_at' => NULL,
                'updated_at' => '2016-07-18 15:35:45',
                'num' => 4,
                'variable_str' => 'username,task_number,task_link,website&lt;span id=&quot;transmark&quot;&gt;&lt;/span&gt;',
            ),
            11 => 
            array (
                'id' => 37,
                'code_name' => 'task_failed',
                'name' => '任务失败',
            'content' => '&lt;span style=&quot;color: rgb(0, 0, 0); font-family: sans-serif; font-size: 16px; line-height: normal;&quot;&gt;您发布的{{task_title}}任务&lt;/span&gt;&lt;a href=&quot;http://demo.kppw.cn/admin/index.php?do=task&amp;amp;id={%E4%BB%BB%E5%8A%A1%E7%BC%96%E5%8F%B7}&quot; _href=&quot;index.php?do=task&amp;amp;id={任务编号}&quot; style=&quot;font-family: sans-serif; font-size: 16px; line-height: normal;&quot;&gt;&lt;/a&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: sans-serif; font-size: 16px; line-height: normal;&quot;&gt;因{{reason&lt;span id=&quot;transmark&quot;&gt;&lt;/span&gt;}}已经失败。&lt;/span&gt;',
                'message_type' => 2,
                'is_open' => 1,
                'is_on_site' => 1,
                'is_send_email' => 0,
                'created_at' => NULL,
                'updated_at' => '2016-11-03 13:34:15',
                'num' => 2,
                'variable_str' => 'task_title,reason&lt;span id=&quot;transmark&quot;&gt;&lt;/span&gt;',
            ),
            12 => 
            array (
                'id' => 38,
                'code_name' => 'task_finish',
                'name' => '任务完成',
            'content' => '&lt;span style=&quot;color: rgb(0, 0, 0); font-family: sans-serif; font-size: 16px; line-height: normal;&quot;&gt;您发布的{{task_title}}任务&lt;/span&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: sans-serif; font-size: 16px; line-height: normal;&quot;&gt;&lt;span id=&quot;transmark&quot;&gt;&lt;/span&gt;已经完成&lt;/span&gt;',
                'message_type' => 2,
                'is_open' => 1,
                'is_on_site' => 1,
                'is_send_email' => 0,
                'created_at' => NULL,
                'updated_at' => '2016-11-03 13:34:14',
                'num' => 1,
                'variable_str' => 'task_title',
            ),
            13 => 
            array (
                'id' => 44,
                'code_name' => 'report ',
                'name' => '举报通知',
            'content' => '&lt;p style=&quot;margin-top: 5px; margin-bottom: 5px; color: rgb(0, 0, 0); font-family: sans-serif; font-size: 16px; line-height: normal;&quot;&gt;尊敬的 {{username}}：&lt;/p&gt;&lt;p style=&quot;margin-top: 5px; margin-bottom: 5px; color: rgb(0, 0, 0); font-family: sans-serif; font-size: 16px; line-height: normal;&quot;&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; 您举报的&lt;a href=&quot;{{href}}&quot; target=&quot;_blank&quot;&gt;{{tasktitle}}&lt;/a&gt;网站已经受理完成，请等待网站的处理&lt;/p&gt;&lt;p style=&quot;margin-top: 5px; margin-bottom: 5px; color: rgb(0, 0, 0); font-family: sans-serif; font-size: 16px; line-height: normal;&quot;&gt;感谢您对{{website&lt;span id=&quot;transmark&quot;&gt;&lt;/span&gt;}}的信任。如有特殊情况，请致电客服&lt;/p&gt;',
                'message_type' => 2,
                'is_open' => 1,
                'is_on_site' => 1,
                'is_send_email' => 0,
                'created_at' => NULL,
                'updated_at' => '2016-11-03 13:48:19',
                'num' => 4,
                'variable_str' => 'username,href,tasktitle,website&lt;span id=&quot;transmark&quot;&gt;&lt;/span&gt;',
            ),
            14 => 
            array (
                'id' => 45,
                'code_name' => 'feedback ',
                'name' => '意见反馈',
                'content' => '尊敬的{{username}}：&lt;br&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; 您的投诉建议本平台已经处理，反馈意见为：{{content}}&lt;br&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; 感谢您的支持！！&lt;span id=&quot;transmark&quot;&gt;&lt;/span&gt;&lt;br&gt;',
                'message_type' => 1,
                'is_open' => 1,
                'is_on_site' => 1,
                'is_send_email' => 0,
                'created_at' => NULL,
                'updated_at' => '2016-07-15 16:58:42',
                'num' => 2,
                'variable_str' => 'username,content',
            ),
            15 => 
            array (
                'id' => 46,
                'code_name' => 'registration_activation',
                'name' => '注册激活',
                'content' => '',
                'message_type' => NULL,
                'is_open' => 1,
                'is_on_site' => 1,
                'is_send_email' => 0,
                'created_at' => NULL,
                'updated_at' => '2016-11-09 17:40:24',
                'num' => 1,
                'variable_str' => '',
            ),
            16 => 
            array (
                'id' => 47,
                'code_name' => 'shop_rights',
                'name' => '店铺维权结果',
                'content' => '&lt;p style=&quot;line-height: 18.5714px;&quot;&gt;尊敬的{{username}}：&lt;/p&gt;&lt;p style=&quot;line-height: 18.5714px;&quot;&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 经过平台判定，交易&lt;a href=&quot;http://{{href}}&quot; target=&quot;_blank&quot; textvalue=&quot;{{trade_name}}&quot;&gt;{{trade_name}}&lt;/a&gt;维权处理结果为：&lt;span style=&quot;text-decoration: underline;&quot;&gt;{{content}}&lt;/span&gt;,&lt;/p&gt;&lt;p style=&quot;line-height: 18.5714px;&quot;&gt;感谢您对{{website}}的信任。如有特殊情况，请致电客服&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;',
                'message_type' => 2,
                'is_open' => 1,
                'is_on_site' => 1,
                'is_send_email' => 0,
                'created_at' => NULL,
                'updated_at' => '2016-11-03 13:49:29',
                'num' => 5,
                'variable_str' => 'username,href,trade_name,content,website',
            ),
            17 => 
            array (
                'id' => 48,
                'code_name' => 'question_accept',
                'name' => '问答采纳',
                'content' => '&lt;p style=&quot;line-height: 18.5714px;&quot;&gt;尊敬的{{username}}：&lt;/p&gt;&lt;p style=&quot;line-height: 18.5714px;&quot;&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 经过{{from_name}}的筛选，您回答问题{{queation}}的答案已被采纳。&lt;/p&gt;&lt;p style=&quot;line-height: 18.5714px;&quot;&gt;感谢您对{{website&lt;span id=&quot;transmark&quot;&gt;&lt;/span&gt;}}的信任。如有特殊情况，请致电客服&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;',
                'message_type' => 2,
                'is_open' => 1,
                'is_on_site' => 1,
                'is_send_email' => 0,
                'created_at' => NULL,
                'updated_at' => '2016-10-20 14:18:44',
                'num' => 4,
                'variable_str' => 'username,from_name,queation,website&lt;span id=&quot;transmark&quot;&gt;&lt;/span&gt;',
            ),
            18 => 
            array (
                'id' => 49,
                'code_name' => 'bid_work_check_success',
                'name' => '招标任务阶段审核稿件通过',
                'content' => '&lt;p style=&quot;white-space: normal; line-height: normal;&quot;&gt;尊敬的 {{username}}：&lt;/p&gt;&lt;p style=&quot;white-space: normal; line-height: normal;&quot;&gt;您参与的任务该阶段已完成。&lt;/p&gt;&lt;p style=&quot;white-space: normal; line-height: normal;&quot;&gt;任务标题：{{task_name}}&lt;/p&gt;&lt;p style=&quot;white-space: normal; line-height: normal;&quot;&gt;任务链接：{{task_link}}&lt;br/&gt;&lt;/p&gt;&lt;p style=&quot;white-space: normal; line-height: normal;&quot;&gt;感谢您对{{website&lt;span id=&quot;transmark&quot;&gt;&lt;/span&gt;}}的信任。如有特殊情况，请致电客服&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;',
                'message_type' => NULL,
                'is_open' => 1,
                'is_on_site' => 1,
                'is_send_email' => 0,
                'created_at' => NULL,
                'updated_at' => '2017-09-14 14:41:21',
                'num' => 4,
                'variable_str' => 'username,task_name,task_link,website&lt;span id=&quot;transmark&quot;&gt;&lt;/span&gt;',
            ),
            19 => 
            array (
                'id' => 50,
                'code_name' => 'bid_work_check_failure',
                'name' => '招标任务阶段审核稿件失败',
                'content' => '&lt;p style=&quot;white-space: normal; line-height: normal;&quot;&gt;尊敬的 {{username}}：&lt;/p&gt;&lt;p style=&quot;white-space: normal; line-height: normal;&quot;&gt;您参与的任务该阶段稿件审核不通过,请修改过后再次提交哦。&lt;/p&gt;&lt;p style=&quot;white-space: normal; line-height: normal;&quot;&gt;任务标题：{{task_name}}&lt;/p&gt;&lt;p style=&quot;white-space: normal; line-height: normal;&quot;&gt;任务链接：{{task_link}}&lt;br/&gt;&lt;/p&gt;&lt;p style=&quot;white-space: normal; line-height: normal;&quot;&gt;感谢您对{{website&lt;span id=&quot;transmark&quot;&gt;&lt;/span&gt;}}的信任。如有特殊情况，请致电客服&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;',
                'message_type' => NULL,
                'is_open' => 1,
                'is_on_site' => 1,
                'is_send_email' => 0,
                'created_at' => NULL,
                'updated_at' => '2017-09-14 14:46:40',
                'num' => 4,
                'variable_str' => 'username,task_name,task_link,website&lt;span id=&quot;transmark&quot;&gt;&lt;/span&gt;',
            ),
        ));
        
        
    }
}
