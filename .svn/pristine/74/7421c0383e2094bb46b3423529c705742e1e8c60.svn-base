<?php

class EnvClass
{
    /**
     * checkEnv constructor.
     */
    public function __construct()
    {
        error_reporting(0); //屏蔽所有错误信息
        @header("content-Type: text/html; charset=utf-8"); //语言设置
        ob_start();
        date_default_timezone_set('Asia/Shanghai');//时区设置
    }

    public function getEnvInfo()
    {
        $env = array();
        $env['sysInfo'] = $this->getOSInfo();
        $env['hdInfo'] = $this->getHardDiskInfo();
        $env['phpInfo'] = $this->getPHPInfo();
        return $env;
    }

    /**
     * 获取操作系统类型
     */
    public function getOSInfo()
    {

        $sysInfo = array();
        switch (PHP_OS) {
            case "Linux":
                $sysInfo = $this->sysLinux();
                break;
            case "FreeBSD":
                $sysInfo = $this->sysFreebsd();
                break;
            case "WINNT":
                $sysInfo = $this->sysWindows();
                break;
            default:
                break;
        }
        return $sysInfo;

    }

    /**
     * Linux系统信息获取
     *
     * @return bool
     */
    private function sysLinux()
    {

        // CPU
        if (false === ($str = @file("/proc/cpuinfo"))) return false;
        $str = implode("", $str);
        @preg_match_all("/model\s+name\s{0,}\:+\s{0,}([\w\s\)\(\@.-]+)([\r\n]+)/s", $str, $model);
        @preg_match_all("/cpu\s+MHz\s{0,}\:+\s{0,}([\d\.]+)[\r\n]+/", $str, $mhz);
        @preg_match_all("/cache\s+size\s{0,}\:+\s{0,}([\d\.]+\s{0,}[A-Z]+[\r\n]+)/", $str, $cache);
        @preg_match_all("/bogomips\s{0,}\:+\s{0,}([\d\.]+)[\r\n]+/", $str, $bogomips);

        $res = array();
        if (false !== is_array($model[1])) {
            $res['cpu']['num'] = sizeof($model[1]);
            /*

            for($i = 0; $i < $res['cpu']['num']; $i++)
            {

                $res['cpu']['model'][] = $model[1][$i].'&nbsp;('.$mhz[1][$i].')';
                $res['cpu']['mhz'][] = $mhz[1][$i];
                $res['cpu']['cache'][] = $cache[1][$i];
                $res['cpu']['bogomips'][] = $bogomips[1][$i];

            }*/

            if ($res['cpu']['num'] == 1) {
                $x1 = '';
            } else {
                $x1 = ' ×' . $res['cpu']['num'];
                $mhz[1][0] = ' | 频率:' . $mhz[1][0];
                $cache[1][0] = ' | 二级缓存:' . $cache[1][0];
                $bogomips[1][0] = ' | Bogomips:' . $bogomips[1][0];
                $res['cpu']['model'][] = $model[1][0] . $mhz[1][0] . $cache[1][0] . $bogomips[1][0] . $x1;
            }

            if (false !== is_array($res['cpu']['model'])) $res['cpu']['model'] = implode("<br />", $res['cpu']['model']);
            if (false !== is_array($res['cpu']['mhz'])) $res['cpu']['mhz'] = implode("<br />", $res['cpu']['mhz']);
            if (false !== is_array($res['cpu']['cache'])) $res['cpu']['cache'] = implode("<br />", $res['cpu']['cache']);
            if (false !== is_array($res['cpu']['bogomips'])) $res['cpu']['bogomips'] = implode("<br />", $res['cpu']['bogomips']);

        }

        // NETWORK

        // UPTIME
        if (false === ($str = @file("/proc/uptime"))) return false;
        $str = explode(" ", implode("", $str));
        $str = trim($str[0]);
        $min = $str / 60;
        $hours = $min / 60;
        $days = floor($hours / 24);
        $hours = floor($hours - ($days * 24));
        $min = floor($min - ($days * 60 * 24) - ($hours * 60));
        if ($days !== 0) $res['uptime'] = $days . "天";
        if ($hours !== 0) $res['uptime'] .= $hours . "小时";

        $res['uptime'] .= $min . "分钟";


        // MEMORY
        if (false === ($str = @file("/proc/meminfo"))) return false;
        $str = implode("", $str);

        preg_match_all("/MemTotal\s{0,}\:+\s{0,}([\d\.]+).+?MemFree\s{0,}\:+\s{0,}([\d\.]+).+?Cached\s{0,}\:+\s{0,}([\d\.]+).+?SwapTotal\s{0,}\:+\s{0,}([\d\.]+).+?SwapFree\s{0,}\:+\s{0,}([\d\.]+)/s", $str, $buf);
        preg_match_all("/Buffers\s{0,}\:+\s{0,}([\d\.]+)/s", $str, $buffers);

        $res['memTotal'] = round($buf[1][0] / 1024, 2);
        $res['memFree'] = round($buf[2][0] / 1024, 2);
        $res['memBuffers'] = round($buffers[1][0] / 1024, 2);
        $res['memCached'] = round($buf[3][0] / 1024, 2);
        $res['memUsed'] = $res['memTotal'] - $res['memFree'];
        $res['memPercent'] = (floatval($res['memTotal']) != 0) ? round($res['memUsed'] / $res['memTotal'] * 100, 2) : 0;
        $res['memRealUsed'] = $res['memTotal'] - $res['memFree'] - $res['memCached'] - $res['memBuffers']; //真实内存使用
        $res['memRealFree'] = $res['memTotal'] - $res['memRealUsed']; //真实空闲
        $res['memRealPercent'] = (floatval($res['memTotal']) != 0) ? round($res['memRealUsed'] / $res['memTotal'] * 100, 2) : 0; //真实内存使用率

        $res['memCachedPercent'] = (floatval($res['memCached']) != 0) ? round($res['memCached'] / $res['memTotal'] * 100, 2) : 0; //Cached内存使用率

        $res['swapTotal'] = round($buf[4][0] / 1024, 2);
        $res['swapFree'] = round($buf[5][0] / 1024, 2);
        $res['swapUsed'] = round($res['swapTotal'] - $res['swapFree'], 2);
        $res['swapPercent'] = (floatval($res['swapTotal']) != 0) ? round($res['swapUsed'] / $res['swapTotal'] * 100, 2) : 0;

        // LOAD AVG

        if (false === ($str = @file("/proc/loadavg"))) return false;

        $str = explode(" ", implode("", $str));
        $str = array_chunk($str, 4);
        $res['loadAvg'] = implode(" ", $str[0]);
        return $res;
    }


    /**
     * FreeBSD系统探测
     *
     * @return bool
     */
    private function sysFreeBSD()
    {

        //CPU
        if (false === ($res['cpu']['num'] = $this->getFreeBSDKey("hw.ncpu"))) return false;
        $res['cpu']['model'] = $this->getFreeBSDKey("hw.model");

        //LOAD AVG
        if (false === ($res['loadAvg'] = $this->getFreeBSDKey("vm.loadavg"))) return false;

        //UPTIME
        if (false === ($buf = $this->getFreeBSDKey("kern.boottime"))) return false;

        $buf = explode(' ', $buf);
        $sys_ticks = time() - intval($buf[3]);
        $min = $sys_ticks / 60;
        $hours = $min / 60;
        $days = floor($hours / 24);
        $hours = floor($hours - ($days * 24));
        $min = floor($min - ($days * 60 * 24) - ($hours * 60));

        if ($days !== 0) $res['uptime'] = $days."天";
        if ($hours !== 0) $res['uptime'] .= $hours."小时";
        $res['uptime'] .= $min."分钟";

        //MEMORY

        if (false === ($buf = $this->getFreeBSDKey("hw.physmem"))) return false;
        $res['memTotal'] = round($buf/1024/1024, 2);


        $str = $this->getFreeBSDKey("vm.vmtotal");
        preg_match_all("/\nVirtual Memory[\:\s]*\(Total[\:\s]*([\d]+)K[\,\s]*Active[\:\s]*([\d]+)K\)\n/i", $str, $buff, PREG_SET_ORDER);
        preg_match_all("/\nReal Memory[\:\s]*\(Total[\:\s]*([\d]+)K[\,\s]*Active[\:\s]*([\d]+)K\)\n/i", $str, $buf, PREG_SET_ORDER);


        $res['memRealUsed'] = round($buf[0][2]/1024, 2);
        $res['memCached'] = round($buff[0][2]/1024, 2);
        $res['memUsed'] = round($buf[0][1]/1024, 2) + $res['memCached'];
        $res['memFree'] = $res['memTotal'] - $res['memUsed'];
        $res['memPercent'] = (floatval($res['memTotal'])!=0)?round($res['memUsed']/$res['memTotal']*100,2):0;
        $res['memRealPercent'] = (floatval($res['memTotal'])!=0)?round($res['memRealUsed']/$res['memTotal']*100,2):0;
        return $res;

    }

    /**
     * 获取FreeBSD系统信息参数
     *
     * @param $key
     * @return mixed
     */
    private function getFreeBSDKey($key)
    {
        return $this->runFreeBSDCommand('sysctl', "-n $key");
    }



    /**
     * 确定FreeBSD执行文件路径
     *
     * @param $commandName
     * @return bool|string
     */
    private function findFreeBSDCommand($commandName)
    {
        $path = array('/bin', '/sbin', '/usr/bin', '/usr/sbin', '/usr/local/bin', '/usr/local/sbin');
        foreach($path as $p)
        {
            if (@is_executable("$p/$commandName")) return "$p/$commandName";
        }
        return false;
    }

    /**
     * 运行FreeBSD命令
     *
     * @param $commandName
     * @param $args
     * @return bool|string
     */
    private function runFreeBSDCommand($commandName, $args)
    {
        $buffer = "";

        if (false === ($command = $this->findFreeBSDCommand($commandName))) return false;
        if ($fp = @popen("$command $args", 'r'))
        {
            while (!@feof($fp))
            {
                $buffer .= @fgets($fp, 4096);
            }
            return trim($buffer);
        }
        return false;
    }



    /**
     * Windows系统探测
     *
     * @return mixed
     */

    function sysWindows()
    {

        if (PHP_VERSION >= 5)
        {
            $objLocator = new COM("WbemScripting.SWbemLocator");
            $wmi = $objLocator->ConnectServer();
            $prop = $wmi->get("Win32_PnPEntity");
        }
        else
        {
            return false;
        }

        //CPU
        $cpuinfo = $this->getWMI($wmi,"Win32_Processor", array("Name","L2CacheSize","NumberOfCores"));
        $res['cpu']['num'] = $cpuinfo[0]['NumberOfCores'];
        if (null == $res['cpu']['num'])
        {
            $res['cpu']['num'] = 1;
        }

        /*
        for ($i=0;$i<$res['cpu']['num'];$i++)
        {
            $res['cpu']['model'] .= $cpuinfo[0]['Name']."<br />";
            $res['cpu']['cache'] .= $cpuinfo[0]['L2CacheSize']."<br />";
        }*/

        $cpuinfo[0]['L2CacheSize'] = ' ('.$cpuinfo[0]['L2CacheSize'].')';
        if ($res['cpu']['num']==1) {
            $x1 = '';
        } else {
            $x1 = ' ×'.$res['cpu']['num'];
        }
        $res['cpu']['model'] = $cpuinfo[0]['Name'].$cpuinfo[0]['L2CacheSize'].$x1;

        // SYSINFO

        $sysinfo = $this->getWMI($wmi,"Win32_OperatingSystem", array('LastBootUpTime','TotalVisibleMemorySize','FreePhysicalMemory','Caption','CSDVersion','SerialNumber','InstallDate'));
        $sysinfo[0]['Caption']=iconv('GBK', 'UTF-8',$sysinfo[0]['Caption']);
        $sysinfo[0]['CSDVersion']=iconv('GBK', 'UTF-8',$sysinfo[0]['CSDVersion']);
        $res['win_n'] = $sysinfo[0]['Caption']." ".$sysinfo[0]['CSDVersion']." 序列号:{$sysinfo[0]['SerialNumber']} 于".date('Y年m月d日H:i:s',strtotime(substr($sysinfo[0]['InstallDate'],0,14)))."安装";
        //UPTIME
        $res['uptime'] = $sysinfo[0]['LastBootUpTime'];
        $sys_ticks = 3600*8 + time() - strtotime(substr($res['uptime'],0,14));
        $min = $sys_ticks / 60;
        $hours = $min / 60;
        $days = floor($hours / 24);
        $hours = floor($hours - ($days * 24));
        $min = floor($min - ($days * 60 * 24) - ($hours * 60));

        if ($days !== 0) $res['uptime'] = $days."天";
        if ($hours !== 0) $res['uptime'] .= $hours."小时";
        $res['uptime'] .= $min."分钟";

        //MEMORY
        $res['memTotal'] = round($sysinfo[0]['TotalVisibleMemorySize']/1024,2);
        $res['memFree'] = round($sysinfo[0]['FreePhysicalMemory']/1024,2);
        $res['memUsed'] = $res['memTotal']-$res['memFree'];	//上面两行已经除以1024,这行不用再除了
        $res['memPercent'] = round($res['memUsed'] / $res['memTotal']*100,2);
        $swapinfo = $this->getWMI($wmi,"Win32_PageFileUsage", array('AllocatedBaseSize','CurrentUsage'));

        // LoadPercentage
        $loadinfo = $this->getWMI($wmi,"Win32_Processor", array("LoadPercentage"));
        $res['loadAvg'] = $loadinfo[0]['LoadPercentage'];
        return $res;

    }

    function getWMI($wmi,$strClass, $strValue = array())
    {

        $arrData = array();
        $objWEBM = $wmi->Get($strClass);
        $arrProp = $objWEBM->Properties_;
        $arrWEBMCol = $objWEBM->Instances_();

        foreach($arrWEBMCol as $objItem)
        {
            @reset($arrProp);
            $arrInstance = array();
            foreach($arrProp as $propItem)
            {
                eval("\$value = \$objItem->" . $propItem->Name . ";");
                if (empty($strValue))
                {
                    $arrInstance[$propItem->Name] = trim($value);
                }
                else
                {
                    if (in_array($propItem->Name, $strValue))
                    {
                        $arrInstance[$propItem->Name] = trim($value);
                    }
                }
            }
            $arrData[] = $arrInstance;
        }
        return $arrData;

    }


    /**
     * 获取磁盘信息
     */
    private function getHardDiskInfo()
    {
        //硬盘
        $hd_info = array();
        $hd_info['total'] = round(@disk_total_space(".") / (1024 * 1024 * 1024), 3); //磁盘总共大小
        $hd_info['free'] = round(@disk_free_space(".") / (1024 * 1024 * 1024), 3); //磁盘可用空间
        $hd_info['used'] = $hd_info['total'] - $hd_info['free']; //磁盘已用
        $hd_info['used_percent'] = (floatval($hd_info['total']) != 0) ? round($hd_info['used'] / $hd_info['total'] * 100, 2) : 0;
        return $hd_info;
    }

    /**
     * 获取PHP相关信息
     *
     * @return array
     */
    private function getPHPInfo(){
        $php_info = array();
        $php_info['php_version'] = PHP_VERSION; //php 版本
        $php_info['run_type'] = strtoupper(php_sapi_name()); //php 运行方式(CGI | FAST-CGI)
        $php_info['dis_funs'] = get_cfg_var("disable_functions"); //禁用函数
        $php_info['extensions'] = get_loaded_extensions(); //安装的扩展
        $php_info['cookie'] = isset($_COOKIE)? 1: 0; //是否支持cookie
        $php_info['session'] = function_exists('session_start')? 1: 0; //是否支持session
        $php_info['socket'] = function_exists('socket_accept')? 1: 0; //是否支持socket请求
        $php_info['curl'] = function_exists('curl_init')? 1: 0; //是否支持curl请求
        $php_info['zlib'] = function_exists('gzclose')? 1: 0; //是否支持zlib压缩
        $php_info['mcrypt'] = function_exists('mcrypt_cbc')? 1: 0; //是否支持mcrypt加密
        $php_info['max_filesize'] = ini_get("upload_max_filesize"); //获取最大上传文件
        $php_info['allow_url_fopen'] = ini_get("allow_url_fopen"); //打开远程文件
        $php_info['smtp'] = get_cfg_var("SMTP"); //SMTP支持

        // 是否支持GD库以及版本
        if (function_exists(gd_info)) {
            $gd_info = @gd_info();
            $php_info['gd_version'] = $gd_info['GD Version'];
        }

        return $php_info;

    }

    private function getWebInfo(){
        $current_user = @get_current_user();
        $server_name = $_SERVER['SERVER_NAME'];
        $server_ip = @$_SERVER['REMOTE_ADDR'];
    }

    private function getDBInfo(){
        $stat = function_exists('mysql_close') ? '√': 'X';
        echo $stat;
    }

    /**
     * 检查目录是否可写
     *
     * @param $dir
     * @return int
     */
    static function dir_writeable($dir)
    {
        $writeable = 0;
        if(!is_dir($dir)) {
            @mkdir($dir, 0777);
        }
        if(is_dir($dir)) {
            if($fp = @fopen("$dir/test.txt", 'w')) {
                @fclose($fp);
                @unlink("$dir/test.txt");
                $writeable = 1;
            } else {
                $writeable = 0;
            }
        }

        return $writeable;
    }
}