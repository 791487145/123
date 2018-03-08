<?php

use Illuminate\Database\Seeder;

class ConfigTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('config')->delete();
        
        \DB::table('config')->insert(array (
            0 => 
            array (
                'id' => 1,
                'alias' => 'site_name',
                'rule' => '众包威客开源建站系统',
                'type' => 'site',
                'title' => '网站名称',
                'desc' => '网站名称',
            ),
            1 => 
            array (
                'id' => 2,
                'alias' => 'site_url',
                'rule' => 'http://dev.kekezu.net',
                'type' => 'site',
                'title' => '网站地址',
                'desc' => '网站地址',
            ),
            2 => 
            array (
                'id' => 3,
                'alias' => 'theme',
                'rule' => 'default',
                'type' => 'basic',
                'title' => '主题',
                'desc' => '主题',
            ),
            3 => 
            array (
                'id' => 5,
                'alias' => 'image_path',
                'rule' => 'http://www.kppw.cn/image/',
                'type' => 'basic',
                'title' => 'Image路径',
                'desc' => 'Image路径',
            ),
            4 => 
            array (
                'id' => 7,
                'alias' => 'record_number',
                'rule' => '11111',
                'type' => 'site',
                'title' => '备案信息',
                'desc' => '备案信息',
            ),
            5 => 
            array (
                'id' => 8,
                'alias' => 'copyright',
                'rule' => 'Copyright 2009 -2020 kekezu. All rights reserved ',
                'type' => 'site',
                'title' => '版权信息',
                'desc' => '版权信息',
            ),
            6 => 
            array (
                'id' => 9,
                'alias' => 'contact_email',
                'rule' => '商务合作：hi@kppw.cn',
                'type' => 'site',
                'title' => '联系方式',
                'desc' => '联系方式',
            ),
            7 => 
            array (
                'id' => 10,
                'alias' => 'statistic_code',
            'rule' => '<script type="text/javascript">var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cscript src=\'" + _bdhmProtocol + "hm.baidu.com/h.js%3F74486090bea68256b0cc4b5e0b4dc596\' type=\'text/javascript\'%3E%3C/script%3E"));</script>
<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id=\'cnzz_stat_icon_1253525889\'%3E%3C/span%3E%3Cscript src=\'" + cnzz_protocol + "s23.cnzz.com/z_stat.php%3Fid%3D1253525889\' type=\'text/javascript\'%3E%3C/script%3E"));</script>
',
                'type' => 'site',
                'title' => '统计代码',
                'desc' => '统计代码',
            ),
            8 => 
            array (
                'id' => 11,
                'alias' => 'site_close',
                'rule' => '1',
                'type' => 'site',
                'title' => '网站关闭',
                'desc' => '网站关闭',
            ),
            9 => 
            array (
                'id' => 12,
                'alias' => 'close_reason',
                'rule' => '网站维护中...',
                'type' => 'site',
                'title' => '关闭原因',
                'desc' => '关闭原因',
            ),
            10 => 
            array (
                'id' => 13,
                'alias' => 'seo_index',
                'rule' => '{"title":"\\u9996\\u9875","keywords":"dgnjdfgndfgj","description":"\\u9996\\u98753dfdf"}',
                'type' => 'seo',
                'title' => '首页seo',
                'desc' => '首页seo',
            ),
            11 => 
            array (
                'id' => 14,
                'alias' => 'seo_article_list',
                'rule' => '{"title":"\\u6587\\u7ae0\\u5217\\u88681","keywords":"\\u6587\\u7ae0\\u5217\\u88682","description":"\\u6587\\u7ae0\\u5217\\u88683"}',
                'type' => 'seo',
                'title' => '文章列表SEO',
                'desc' => '文章列表SEO',
            ),
            12 => 
            array (
                'id' => 15,
                'alias' => 'seo_article_detail',
                'rule' => 'I',
                'type' => 'seo',
                'title' => '文章详细SEO',
                'desc' => '文章详细SEO',
            ),
            13 => 
            array (
                'id' => 16,
                'alias' => 'seo_case_list',
                'rule' => 'I',
                'type' => 'seo',
                'title' => '案例列表SEO',
                'desc' => '案例列表SEO',
            ),
            14 => 
            array (
                'id' => 17,
                'alias' => 'seo_case_detail',
                'rule' => 'I',
                'type' => 'seo',
                'title' => '案例详细SEO',
                'desc' => '案例详细SEO',
            ),
            15 => 
            array (
                'id' => 18,
                'alias' => 'seo_login',
                'rule' => 'I',
                'type' => 'seo',
                'title' => '登录SEO',
                'desc' => '登录SEO',
            ),
            16 => 
            array (
                'id' => 19,
                'alias' => 'seo_register',
                'rule' => 'I',
                'type' => 'seo',
                'title' => '注册SEO',
                'desc' => '注册SEO',
            ),
            17 => 
            array (
                'id' => 20,
                'alias' => 'seo_about',
                'rule' => '{"title":"\\u5173\\u4e8e\\u6211\\u4eec1","keywords":"\\u5173\\u4e8e\\u6211\\u4eec2","description":"\\u5173\\u4e8e\\u6211\\u4eec3"}',
                'type' => 'seo',
                'title' => '关于我们SEO',
                'desc' => '关于我们SEO',
            ),
            18 => 
            array (
                'id' => 21,
                'alias' => 'seo_copyright',
                'rule' => '{"title":" \\u7248\\u6743\\u58f0\\u660e1","keywords":" \\u7248\\u6743\\u58f0\\u660e2","description":" \\u7248\\u6743\\u58f0\\u660e3"}',
                'type' => 'seo',
                'title' => '版权声明SEO',
                'desc' => '版权声明SEO',
            ),
            19 => 
            array (
                'id' => 22,
                'alias' => 'seo_disclaimer',
                'rule' => '{"title":"\\u514d\\u8d23\\u58f0\\u660e1","keywords":"\\u514d\\u8d23\\u58f0\\u660e2","description":"\\u514d\\u8d23\\u58f0\\u660e3"}',
                'type' => 'seo',
                'title' => '免责声明SEO',
                'desc' => '免责声明SEO',
            ),
            20 => 
            array (
                'id' => 23,
                'alias' => 'seo_rule',
                'rule' => '{"title":"\\u670d\\u52a1\\u89c4\\u52191","keywords":"\\u670d\\u52a1\\u89c4\\u52192","description":"\\u670d\\u52a1\\u89c4\\u52193"}',
                'type' => 'seo',
                'title' => '服务规则SEO',
                'desc' => '服务规则SEO',
            ),
            21 => 
            array (
                'id' => 24,
                'alias' => 'seo_agreement',
                'rule' => '{"title":"\\u670d\\u52a1\\u534f\\u8bae1","keywords":"\\u670d\\u52a1\\u534f\\u8bae2","description":"\\u670d\\u52a1\\u534f\\u8bae3"}',
                'type' => 'seo',
                'title' => '服务协议SEO',
                'desc' => '服务协议SEO',
            ),
            22 => 
            array (
                'id' => 25,
                'alias' => 'seo_help',
                'rule' => '{"title":"\\u5e38\\u89c1\\u95ee\\u98981","keywords":"\\u5e38\\u89c1\\u95ee\\u98982","description":"\\u5e38\\u89c1\\u95ee\\u98983"}',
                'type' => 'seo',
                'title' => '常见问题SEO',
                'desc' => '常见问题SEO',
            ),
            23 => 
            array (
                'id' => 26,
                'alias' => 'seo_contact',
                'rule' => '{"title":"\\u8054\\u7cfb\\u6211\\u4eec1","keywords":"\\u8054\\u7cfb\\u6211\\u4eec2","description":"\\u8054\\u7cfb\\u6211\\u4eec3"}',
                'type' => 'seo',
                'title' => '联系我们SEO',
                'desc' => '联系我们SEO',
            ),
            24 => 
            array (
                'id' => 27,
                'alias' => 'cash',
                'rule' => '{"recharge_min":"0.1","withdraw_min":"10","withdraw_max":"10000","per_charge":"2","per_low":"1","per_high":"50"}',
                'type' => 'pay',
                'title' => '支付配置',
                'desc' => '支付配置',
            ),
            25 => 
            array (
                'id' => 28,
                'alias' => 'alipay',
                'rule' => '{"status":"1","sellerEmail":"pay@kekezu.com","partner":"2088301857503158","key":"wzn723ysa5qotelr2jcau4b7edb1livt"}',
                'type' => 'thirdpay',
                'title' => '支付宝',
                'desc' => '支付宝快捷支付',
            ),
            26 => 
            array (
                'id' => 29,
                'alias' => 'wechatpay',
                'rule' => '{"status":"1","appId":"wx6e023b7a4ee45709","appKey":"yb1JrmlcZY31qOnBk2bBZiOBnwl37eBn","mchId":"1271185801"}',
                'type' => 'thirdpay',
                'title' => '微信支付',
                'desc' => '微信扫码支付',
            ),
            27 => 
            array (
                'id' => 30,
                'alias' => 'unionpay',
                'rule' => '{"status":"1","merId":"111111111111","certPassword":"123456"}',
                'type' => 'thirdpay',
                'title' => '银联支付',
                'desc' => '银联快捷支付',
            ),
            28 => 
            array (
                'id' => 31,
                'alias' => 'task_bounty_limit',
                'rule' => '200',
                'type' => 'task',
                'title' => '任务审核金额',
                'desc' => '发布赏金低于该设定金额的任务需要审核，设为0即无限制',
            ),
            29 => 
            array (
                'id' => 32,
                'alias' => 'task_bounty_max_limit',
                'rule' => '100000000',
                'type' => 'task',
                'title' => '任务最大金额',
                'desc' => '设置任务最大金额，为0时不生效',
            ),
            30 => 
            array (
                'id' => 33,
                'alias' => 'task_bounty_min_limit',
                'rule' => '0.1',
                'type' => 'task',
                'title' => '任务最小金额',
                'desc' => '设置任务最小金额',
            ),
            31 => 
            array (
                'id' => 34,
                'alias' => 'task_percentage',
                'rule' => '10',
                'type' => 'task',
                'title' => '任务提成比率',
                'desc' => '站长提取任务佣金的百分比，设置0即无抽佣',
            ),
            32 => 
            array (
                'id' => 35,
                'alias' => 'task_sys_help_switch',
                'rule' => '0',
                'type' => 'task',
                'title' => '系统辅助功能是否开启',
                'desc' => '0表示关闭 1表示开启',
            ),
            33 => 
            array (
                'id' => 36,
                'alias' => 'task_check_time_limit',
                'rule' => '10',
                'type' => 'task',
                'title' => '验收期最大时间限制',
                'desc' => '该功能适用于选稿期结束后有投稿雇主未选稿的时候',
            ),
            34 => 
            array (
                'id' => 37,
                'alias' => 'task_sys_help_rule',
                'rule' => '1',
                'type' => 'task',
                'title' => '系统辅助功能规则',
                'desc' => '1代表最先交稿，2威客好评率，3参与任务数',
            ),
            35 => 
            array (
                'id' => 38,
                'alias' => 'task_delivery_limit_time',
                'rule' => '{"1200":"12","1300":"13","80000":"20","100000":"30"}',
                'type' => 'task',
                'title' => '任务交稿截止时间最大规则',
                'desc' => 'json键值代表钱数，值代表天数',
            ),
            36 => 
            array (
                'id' => 39,
                'alias' => 'task_publicity_day',
                'rule' => '0',
                'type' => 'task',
                'title' => '任务公示天数',
                'desc' => '任务公示天数',
            ),
            37 => 
            array (
                'id' => 40,
                'alias' => 'task_delivery_min',
                'rule' => '8',
                'type' => 'task',
                'title' => '任务交稿截止最小天数',
                'desc' => '任务交稿截止最小天数',
            ),
            38 => 
            array (
                'id' => 41,
                'alias' => 'task_vote_time',
                'rule' => '3',
                'type' => 'task',
                'title' => '任务投票时间限制（小时）',
                'desc' => '大于等于0的整数小时，设置为0即无注册时间限制',
            ),
            39 => 
            array (
                'id' => 42,
                'alias' => 'task_select_work',
                'rule' => '3',
                'type' => 'task',
                'title' => '选稿时间限制',
                'desc' => '大于等于1的整数天',
            ),
            40 => 
            array (
                'id' => 43,
                'alias' => 'task_delivery_max_time',
                'rule' => '3',
                'type' => 'task',
                'title' => '交付期最大时间限制',
                'desc' => '逾期未完成交付，任务直接冻结交由管理员处理',
            ),
            41 => 
            array (
                'id' => 44,
                'alias' => 'qq_api',
                'rule' => '{"status":"1","appId":"101315942","appSecret":"5f9cb97e7e367690c2db5a6446335782"}',
                'type' => 'oauth',
                'title' => 'QQ授权登录',
                'desc' => 'QQ授权登录',
            ),
            42 => 
            array (
                'id' => 45,
                'alias' => 'wechat_api',
                'rule' => '{"status":"1","appId":"wx4ca5d7f3040c8c94","appSecret":"36e4a9e637a9cf6b466c1f24fb4566d6"}',
                'type' => 'oauth',
                'title' => '微信授权登录',
                'desc' => '微信授权登录',
            ),
            43 => 
            array (
                'id' => 46,
                'alias' => 'sina_api',
                'rule' => '{"status":"1","appId":"4121230302","appSecret":"a7203c56e921b344181b1d4227905477"}',
                'type' => 'oauth',
                'title' => '新浪授权登录',
                'desc' => '新浪授权登录',
            ),
            44 => 
            array (
                'id' => 47,
                'alias' => 'task_fail_percentage',
                'rule' => '10',
                'type' => 'task',
                'title' => '任务失败返金抽成比例',
                'desc' => '发布赏金低于该设定金额的任务需要审核，设为0即无限制',
            ),
            45 => 
            array (
                'id' => 48,
                'alias' => 'attachment',
                'rule' => '{"size":"2","extension":"pdf|jpg|jpeg|png|bmp|gif|zar|txt"}',
                'type' => 'attachment',
                'title' => '附件配置',
                'desc' => '附件配置',
            ),
            46 => 
            array (
                'id' => 49,
                'alias' => 'task_comment_time_limit',
                'rule' => '12',
                'type' => 'task',
                'title' => '任务评价最长时间限制',
                'desc' => '如果超过这个时间没有评价，系统将会默认为好评',
            ),
            47 => 
            array (
                'id' => 51,
                'alias' => 'email_config',
                'rule' => '',
                'type' => 'email_config',
                'title' => '邮箱配置',
                'desc' => '邮箱配置',
            ),
            48 => 
            array (
                'id' => 53,
                'alias' => 'seo_task',
                'rule' => '{"title":"\\u4efb\\u52a1\\u5927\\u5385","keywords":"              hfdh","description":"\\u6211\\u9a71\\u52a8\\u5668\\u6211\\u7684"}',
                'type' => 'seo',
                'title' => '任务大厅seo',
                'desc' => '任务大厅seo',
            ),
            49 => 
            array (
                'id' => 54,
                'alias' => 'seo_service',
                'rule' => '{"title":"\\u670d\\u52a1\\u5546","keywords":"hfddf","description":"hfddf"}',
                'type' => 'seo',
                'title' => '服务商seo',
                'desc' => '服务商seo',
            ),
            50 => 
            array (
                'id' => 55,
                'alias' => 'seo_article',
                'rule' => '{"title":"\\u7535\\u89c6\\u5267\\u5cf0\\u4f1a\\u4e0a\\u7684\\u5bb6\\u4f19","keywords":"\\u7535\\u89c6\\u5267\\u5cf0\\u4f1a\\u4e0a\\u7684\\u5bb6\\u4f19\\u7535\\u89c6\\u5267\\u5cf0\\u4f1a\\u4e0a\\u7684\\u5bb6\\u4f19\\u7535\\u89c6\\u5267\\u5cf0\\u4f1a\\u4e0a\\u7684\\u5bb6\\u4f19\\u7535\\u89c6\\u5267\\u5cf0\\u4f1a\\u4e0a\\u7684\\u5bb6\\u4f19","description":"\\u7535\\u89c6\\u5267\\u5cf0\\u4f1a\\u4e0a\\u7684\\u5bb6\\u4f19\\u7535\\u89c6\\u5267\\u5cf0\\u4f1a\\u4e0a\\u7684\\u5bb6\\u4f19\\u7535\\u89c6\\u5267\\u5cf0\\u4f1a\\u4e0a\\u7684\\u5bb6\\u4f19\\u7535\\u89c6\\u5267\\u5cf0\\u4f1a\\u4e0a\\u7684\\u5bb6\\u4f19"}',
                'type' => 'seo',
                'title' => '咨询中心seo',
                'desc' => '咨询中心seo',
            ),
            51 => 
            array (
                'id' => 59,
                'alias' => 'seo_secondary_domain',
                'rule' => '1',
                'type' => 'seo',
                'title' => '是否开启二级域名',
                'desc' => '是否开启二级域名，1是 ，2否',
            ),
            52 => 
            array (
                'id' => 60,
                'alias' => 'seo_pseudo_static',
                'rule' => '1',
                'type' => 'seo',
                'title' => '是否开启伪静态',
                'desc' => '是否开启伪静态 1是 2否',
            ),
            53 => 
            array (
                'id' => 61,
                'alias' => 'site_logo_1',
                'rule' => '',
                'type' => 'site',
                'title' => '首页logo',
                'desc' => NULL,
            ),
            54 => 
            array (
                'id' => 62,
                'alias' => 'site_logo_2',
                'rule' => '',
                'type' => 'site',
                'title' => '其他logo',
                'desc' => NULL,
            ),
            55 => 
            array (
                'id' => 63,
                'alias' => 'phone',
                'rule' => '400-666-999',
                'type' => 'site',
                'title' => '联系电话',
                'desc' => NULL,
            ),
            56 => 
            array (
                'id' => 64,
                'alias' => 'company_name',
                'rule' => '武汉客客',
                'type' => 'site',
                'title' => '公司名称',
                'desc' => NULL,
            ),
            57 => 
            array (
                'id' => 65,
                'alias' => 'company_address',
                'rule' => '湖北省武汉市洪山区华工孵化中心9楼',
                'type' => 'site',
                'title' => '公司地址',
                'desc' => NULL,
            ),
            58 => 
            array (
                'id' => 66,
                'alias' => 'user_forbid_keywords',
                'rule' => '但是感觉都会感觉大幅度',
                'type' => 'basis ',
                'title' => '用户禁止关键字',
                'desc' => NULL,
            ),
            59 => 
            array (
                'id' => 67,
                'alias' => 'content_forbid_keywords',
                'rule' => '三个等级考试机构',
                'type' => 'basis ',
                'title' => '内容禁止关键字',
                'desc' => NULL,
            ),
            60 =>
            array (
                'id' => 68,
                'alias' => 'css_adaptive',
                'rule' => '1',
                'type' => 'basis ',
                'title' => 'css自适应',
                'desc' => 'css自适应 1是 2否',
            ),
            61 => 
            array (
                'id' => 69,
                'alias' => 'open_IM',
                'rule' => '1',
                'type' => 'basis ',
                'title' => '开启IM',
                'desc' => '开启IM 1是 2否',
            ),
            62 => 
            array (
                'id' => 70,
                'alias' => 'new_user_registration_time_limit',
                'rule' => '个的时间赶快死',
                'type' => 'basis ',
                'title' => '新用户注册时间限制',
                'desc' => NULL,
            ),
            63 => 
            array (
                'id' => 71,
                'alias' => 'user_registration_email_activation',
                'rule' => '1',
                'type' => 'basis ',
                'title' => '用户注册邮件激活',
                'desc' => '用户注册邮件激活 1是 2否',
            ),
            64 => 
            array (
                'id' => 81,
                'alias' => 'sina',
                'rule' => '{"sina_url":"http:\\/\\/www.sina.com","sina_switch":"1"}',
                'type' => 'site',
                'title' => '关注链接 新浪微博',
                'desc' => NULL,
            ),
            65 => 
            array (
                'id' => 82,
                'alias' => 'tencent',
                'rule' => '{"tencent_url":"http:\\/\\/www.Tencent.com","tencent_switch":"1"}',
                'type' => 'site',
                'title' => '关注链接  腾讯微博',
                'desc' => NULL,
            ),
            66 => 
            array (
                'id' => 83,
                'alias' => 'wechat',
                'rule' => '{"wechat_pic":"attachment\\\\sys\\\\89d8cf91ae71f7810af6a927db8a559a.jpg","wechat_switch":"1"}',
                'type' => 'site',
                'title' => '关注链接 微信',
                'desc' => NULL,
            ),
            67 => 
            array (
                'id' => 84,
                'alias' => 'skin_color_config',
                'rule' => 'blue',
                'type' => 'site',
                'title' => '多彩换肤',
                'desc' => '代表颜色值',
            ),
            68 => 
            array (
                'id' => 85,
                'alias' => 'qq',
                'rule' => '3423696173',
                'type' => 'basis',
                'title' => '客服qq',
                'desc' => '客服qq',
            ),
            69 =>
            array (
                'id' => 86,
                'alias' => 'IM_config',
                'rule' => '{"IM_ip":"127.0.0.1","IM_port":"9501"}',
                'type' => 'basis',
                'title' => 'IM相关配置',
                'desc' => NULL,
            ),
            70 => 
            array (
                'id' => 87,
                'alias' => 'Email',
                'rule' => '55555@qq.com',
                'type' => 'site',
                'title' => '联系邮箱',
                'desc' => '联系邮箱',
            ),
            71 => 
            array (
                'id' => 88,
                'alias' => 'employ_bounty_min_limit',
                'rule' => '100',
                'type' => 'employ',
                'title' => '雇佣最小金额限定',
                'desc' => '雇佣最小金额限定',
            ),
            72 => 
            array (
                'id' => 89,
                'alias' => 'employ_percentage',
                'rule' => '20',
                'type' => 'employ',
                'title' => '雇佣成功抽成比',
                'desc' => '雇佣成功抽成比',
            ),
            73 => 
            array (
                'id' => 90,
                'alias' => 'employ_except_time',
                'rule' => '10',
                'type' => 'employ',
                'title' => '雇佣受理时间限制',
                'desc' => '雇佣受理时间限制 0表示不限制受理时间（以小时为单位）',
            ),
            74 => 
            array (
                'id' => 91,
                'alias' => 'employee_right_time',
                'rule' => '10',
                'type' => 'employ',
                'title' => '雇佣者交稿之后维权时间限制（单位是小时）',
                'desc' => '威客交稿之后维权时间限制',
            ),
            75 => 
            array (
                'id' => 92,
                'alias' => 'employer_cancel_time',
                'rule' => '10',
                'type' => 'employ',
                'title' => '雇主取消雇佣时间限制',
                'desc' => '雇主取消雇佣时间限制（以小时为单位）',
            ),
            76 => 
            array (
                'id' => 93,
                'alias' => 'employer_delivery_time',
                'rule' => '12',
                'type' => 'employ',
                'title' => '验收最长天数',
                'desc' => '服务完成后，X天雇主未验收，系统自动验收扣款',
            ),
            77 => 
            array (
                'id' => 94,
                'alias' => 'employ_comment_time',
                'rule' => '10',
                'type' => 'employ',
                'title' => '验收好评时间配置',
                'desc' => '未评价系统默认时间x天好评',
            ),
            78 => 
            array (
                'id' => 95,
                'alias' => 'goods_check',
                'rule' => '1',
                'type' => 'shop_config',
                'title' => '商品上架审核',
                'desc' => '店铺配置 商品上架审核 1=>开启 2=>关闭',
            ),
            79 => 
            array (
                'id' => 96,
                'alias' => 'service_check',
                'rule' => '1',
                'type' => 'shop_config',
                'title' => '服务上架审核',
                'desc' => '店铺配置 服务上架审核 1=>开启 2=>关闭',
            ),
            80 => 
            array (
                'id' => 99,
                'alias' => 'recommend_goods_unit',
                'rule' => '0',
                'type' => 'shop_config',
                'title' => '推荐商品单位',
                'desc' => '店铺配置 推荐单位 0=>天 1=>月 2=>三个月 3=>六个月 4=>年',
            ),
            81 => 
            array (
                'id' => 100,
                'alias' => 'min_price',
                'rule' => '1',
                'type' => 'goods_config',
                'title' => '商品最小金额设定',
                'desc' => '流程配置 商品最小金额设定',
            ),
            82 => 
            array (
                'id' => 101,
                'alias' => 'trade_rate',
                'rule' => '1',
                'type' => 'goods_config',
                'title' => '商品交易提成比例',
                'desc' => '流程配置  商品交易提成比例',
            ),
            83 => 
            array (
                'id' => 102,
                'alias' => 'legal_rights',
                'rule' => '48',
                'type' => 'goods_config',
                'title' => '商品维权时间配置',
                'desc' => '流程配置 商品维权时间配置 按小时计算',
            ),
            84 => 
            array (
                'id' => 103,
                'alias' => 'doc_confirm',
                'rule' => '7',
                'type' => 'goods_config',
                'title' => '文件确认配置',
                'desc' => '流程配置 文件确认配置 按天计算',
            ),
            85 => 
            array (
                'id' => 104,
                'alias' => 'comment_days',
                'rule' => '7',
                'type' => 'goods_config',
                'title' => '商品评价天数配置',
                'desc' => '流程配置  商品评价天数配置 按天计算',
            ),
            86 => 
            array (
                'id' => 105,
                'alias' => 'app_android_version',
                'rule' => '1.1',
                'type' => 'app_android',
                'title' => 'app安卓版本号',
                'desc' => 'app安卓最新版本号',
            ),
            87 => 
            array (
                'id' => 106,
                'alias' => 'app_ios_version',
                'rule' => '1.0',
                'type' => 'app_ios',
                'title' => 'appios版本号',
                'desc' => 'appios最新版本号',
            ),
            88 => 
            array (
                'id' => 107,
                'alias' => 'recommend_service_unit',
                'rule' => '2',
                'type' => 'shop_config',
                'title' => '推荐服务单位',
                'desc' => '店铺配置 推荐单位 0=>天 1=>月 2=>三个月 3=>六个月 4=>年',
            ),
            89 => 
            array (
                'id' => 108,
                'alias' => 'question_switch',
                'rule' => '1',
                'type' => 'question',
                'title' => '问答模块是否开启',
                'desc' => '问答模块是否开启 0表示关闭 1表示开启',
            ),
            90 => 
            array (
                'id' => 109,
                'alias' => 'question_verify',
                'rule' => '0',
                'type' => 'question',
                'title' => '问答模块是否审核',
                'desc' => '问答模块是否审核 0表示不审核 1表示审核',
            ),
            91 => 
            array (
                'id' => 110,
                'alias' => 'vip_shop_config',
                'rule' => '{"hot_line":"023-88391094","logo1":"attachment\\/sys\\/827e42fe4327488f98aa60926a1c799d.jpg","logo2":"attachment\\/sys\\/8e86fc6e193b114a428ef183509c8df9.jpg"}',
                'type' => 'vip',
                'title' => 'vip首页配置',
                'desc' => 'hot_line代表签约热线  logo1代表展示图片1 logo2代表展示图片2',
            ),
            92 => 
            array (
                'id' => 111,
                'alias' => 'bid_examine',
                'rule' => '1',
                'type' => 'bid',
                'title' => '招标任务审核设定',
                'desc' => '开启状态 1开启2关闭',
            ),
            93 => 
            array (
                'id' => 112,
                'alias' => 'bid_bounty_limit',
                'rule' => '1',
                'type' => 'bid',
                'title' => '任务最大金额设定',
                'desc' => '发布赏金低于该设定金额的任务需要审核，设为0即无限制',
            ),
            94 => 
            array (
                'id' => 113,
                'alias' => 'bid_bounty_min_limit',
                'rule' => '1',
                'type' => 'bid',
                'title' => '任务最小金额设定',
                'desc' => '设置任务最小金额',
            ),
            95 => 
            array (
                'id' => 114,
                'alias' => 'bid_percentage',
                'rule' => '1',
                'type' => 'bid',
                'title' => '任务提成比例',
                'desc' => '站长提取任务佣金的百分比，设置0即无抽佣',
            ),
            96 => 
            array (
                'id' => 115,
                'alias' => 'bid_fail_percentage',
                'rule' => '1',
                'type' => 'bid',
                'title' => '任务失败返金抽成比例',
                'desc' => '发布赏金低于该设定金额的任务需要审核，设为0即无限制',
            ),
            97 => 
            array (
                'id' => 116,
                'alias' => 'bid_delivery_max',
                'rule' => '5',
                'type' => 'bid',
                'title' => '任务交稿截止最大天数',
                'desc' => '任务交稿截止最大天数',
            ),
            98 => 
            array (
                'id' => 117,
                'alias' => 'bid_new_user_registration_time_limit',
                'rule' => '1',
                'type' => 'bid',
                'title' => '新注册用户投标时间限制',
                'desc' => '新注册用户投标时间 0=>h',
            ),
            99 => 
            array (
                'id' => 118,
                'alias' => 'bid_select_work',
                'rule' => '1',
                'type' => 'bid',
                'title' => '选稿时间设置',
                'desc' => '大于等于1的整数天',
            ),
            100 => 
            array (
                'id' => 119,
                'alias' => 'bid_delivery_max_time',
                'rule' => '1',
                'type' => 'bid',
                'title' => '交付期最大时间限制',
                'desc' => '逾期未完成交付，任务直接冻结交由管理员处理',
            ),
            101 => 
            array (
                'id' => 120,
                'alias' => 'bid_check_time_limit',
                'rule' => '1',
                'type' => 'bid',
                'title' => '验收期最大时间限制',
                'desc' => '该功能适用于选稿期结束后有投稿雇主未选稿的时候',
            ),
        ));
        
        
    }
}
