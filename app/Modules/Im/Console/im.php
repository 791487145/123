<?php


class WebsocketServ
{
    
    public $server;
    
    public $ip = '';
    
    public $port = '';

    public $host = '';

    public $database = '';

    public $username = '';

    public $password = '';

    public $tablePre = 'kppw_';

    private $map;

    public $memory_table;


    public function __construct()
    {

        
        $this->memory_table = new swoole_table(1024);
        $this->memory_table->column('fd', swoole_table::TYPE_INT, 11);       
        $this->memory_table->column('uid', swoole_table::TYPE_INT, 11);       
        $this->memory_table->create();


        
        $nowPath = dirname(__FILE__);
        $rootPath = substr($nowPath,0,-23);
        $path = $rootPath. DIRECTORY_SEPARATOR . '.env';
        $str = file_get_contents($path);
        $arr = explode("\n",$str);
        if(!empty($arr)){
            foreach($arr as $key =>$value){
                if(!empty($value)){
                    if(strstr($value,'DB_HOST')){
                        $this->host = substr($value,strpos($value,'=')+1);
                    }
                    if(strstr($value,'DB_DATABASE')){
                        $this->database = substr($value,strpos($value,'=')+1);
                    }
                    if(strstr($value,'DB_USERNAME')){
                        $this->username = substr($value,strpos($value,'=')+1);
                    }
                    if(strstr($value,'DB_PASSWORD')){
                        $this->password = substr($value,strpos($value,'=')+1);
                    }
                }
            }
        }

        
        $conn = $this->connectDB();
        $sql = "SELECT * FROM " . $this->tablePre . "config WHERE alias = 'IM_config' AND type = 'basis'";
        $status = mysqli_query($conn, $sql);
        $imConfig = mysqli_fetch_array($status);
        $imRule = json_decode($imConfig['rule'], true);
        $this->ip = $imRule['IM_ip'];
        $this->port = $imRule['IM_port'];
        mysqli_close($conn);
        $this->server = new swoole_websocket_server($this->ip, $this->port);
        $this->server->set(['work_num' => 100]);
        $this->server->on('open', array($this, 'open'));
        $this->server->on('message', array($this, 'message'));
        $this->server->on('close', array($this, 'close'));
        $this->server->start();
    }

    
    public function open(swoole_websocket_server $server, $request)
    {
        $param = $request->get;
        $fd = $request->fd;
        
        $this->map[$fd] = $param['fromUid'];
        $this->memory_table->set($fd, array('fd' => $fd, 'uid' => $param['fromUid']));

        foreach($this->memory_table as $fd => $item)
        {
            $map[$fd] = $item['uid'];
        }
        $conn = $this->connectDB();
        $sql = sprintf("SELECT `friend_uid` FROM kppw_im_attention WHERE uid = '" . $param['fromUid'] . "'");
        $result = mysqli_query($conn, $sql);
        $friendArr = array();
        while($item = $result->fetch_assoc()){
            $friendArr[] = $item['friend_uid'];
        }
        $friend['online'] = array();
        foreach ($friendArr as $v){
            if (in_array($v, $this->map)){
                $friend['online'][] = $v;
			}
		}
        $server->push(array_flip($map)[$param['fromUid']], json_encode($friend['online']));
    }

    
    public function message(swoole_websocket_server $server, $frame)
    {
        
        $data = json_decode($frame->data);

        
        date_default_timezone_set("Asia/Shanghai");
        $conn = $this->connectDB();
        $query = "select name from kppw_users where id=".$data->fromUid;
        $status = mysqli_query($conn,$query);
        $from_username = mysqli_fetch_array($status);
        $msg = [
            'fromUid' => $data->fromUid,
            'toUid' => isset($data->toUid) ? $data->toUid : '',
            'content' => isset($data->content) ? $data->content : '',
            'created_at' => date('Y/m/d H:i:s'),
            'status' => 1,
            'from_username'=>$from_username['name'],
        ];
        
        if (!empty($msg['toUid']) && !empty($msg['content'])) {

            foreach($this->memory_table as $fd => $item)
            {
                $map[$fd] = $item['uid'];
            }

            
            foreach ($map as $k => $v) {
                if ($msg['fromUid'] == $v || $msg['toUid'] == $v) {
                    $list[] = $k;
                }
                if ($msg['toUid'] == $v){
                    $msg['status'] = 2;
                }
            }


            $msg['content'] = htmlspecialchars($msg['content']);
            $sql = sprintf(
                "INSERT INTO kppw_im_message (`from_uid`, `to_uid`, `content`, `created_at`, `status`) VALUES ('%d', '%d', '%s', '%s', '%d')",
                $msg['fromUid'], $msg['toUid'], $msg['content'], $msg['created_at'], $msg['status']);
            $status = mysqli_query($conn, $sql);
            $id = mysqli_insert_id($conn);

            if ($status){
                $msg = array_merge(array('id'=>$id),$msg);
                foreach ($list as $fd) {
                    $server->push($fd,json_encode($msg));
                }
            }
            mysqli_close($conn);
        }

    }

    
    public function close($ser, $fd)
    {
        
        $this->memory_table->del($fd);

    }

    
    public function connectDB()
    {
        $conn = mysqli_connect($this->host, $this->username, $this->password);
        if (!$conn) {
            die('Could not connect:' . mysql_error());
        }
        $db = mysqli_select_db($conn,$this->database);
        if (!$db) {
            die("sql error:" . mysql_error());
        }
        return $conn;
    }
}


$websocket = new WebsocketServ();

