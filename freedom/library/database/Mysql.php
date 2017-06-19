<?php

namespace database;

class Mysql
{

    static $debug  = false;
    static $report = true;
    //const MASTER_RATE_ON_SELECT = 0.0;	//按1算,在主库上进行select操作的概率

    static public $LinkConfArr=array();
    static public $LinkResArr=array();

    private $conf = array(
        'h' => '',
        'd' => '',
        'u' => '',
        'p' => '',
        's' => array(), // 从库配置
    );

    static private $CacheLinkRes=array();    //主连接对象



    private $currLinkRes=0;    //当前连接对象
    private $currLinkKey=0;

    private $dbHashKey=0;

    //数据模式: select-update/delete-insert
    private $dbMode='s-m-m';



    function __construct($conf = null)
    {
        if(isset($_GET["debug"]))self::$debug=1;
        // 如果未传入配置，则加载默认配置数组
        if (empty($conf))
        {
            $conf =  self::getDefaultConfig();
        }

        if (isset($conf) && is_array($conf))
        {
            $this->setConfig($conf[0]);
        }
    }



    function setCacheLinkRes($slave,$link_res) {
        self::$CacheLinkRes[$this->dbHashKey][$slave]=$link_res;
    }
    function getCacheLinkRes($slave) {
        return	isset(self::$CacheLinkRes[$this->dbHashKey][$slave]) ? self::$CacheLinkRes[$this->dbHashKey][$slave] : null;
    }

    /**
     * 数据库连接与判断函数。
     * 可以支持主从库
     * @return resource
     * @param bool $slave 是否选择从库
     */
    function connect($slave=false)
    {
        //查找检查自己的连接池和是否可用
        $this->currLinkRes = $this->getCacheLinkRes($slave);

//		if (is_resource($this->currLinkRes) && mysqli_ping($this->currLinkRes)){ //测试共享连接池
        if ($this->currLinkRes && mysqli_ping($this->currLinkRes)){
            if (self::$debug) echo "CONNECT: 命中自己的连接池 ".($slave?'slave':'master')."……<br \\>\n";
            return $this->currLinkRes;
        }else{
            $this->currLinkRes = null;
        }

        //设置当前连接参数
        $currlinkCfg=  $this->getConfig($slave) ;
        $currCfg = '';
        //$currCfg['d'] = $currlinkCfg['d'];
        $currCfg .= $currlinkCfg['h'];
        $currCfg .= $currlinkCfg['c']; //charset
        $currCfg .= $currlinkCfg['u'];
        $currCfg .= $currlinkCfg['p'];
        //$currCfg['s'] = $currlinkCfg['s'];
        $currCfg .= (int)$slave;
        unset($currlinkCfg);

        //查找检查共享的连接池和是否可用
        if (!empty(self::$LinkConfArr))
        {
            $key = array_search($currCfg,self::$LinkConfArr);
            if($key!==false){

                $tmpRes =self::$LinkResArr[$key];

                //if (is_resource($tmpRes) && mysqli_ping($tmpRes)){
                if ($tmpRes && mysqli_ping($tmpRes)){

                    $this->currLinkRes = $tmpRes;
                    $this->currLinkKey     = $key;
                    if (self::$debug) echo "CONNECT: 命中共享的连接池 ".($slave?'slave':'master')."……".$currCfg."<br \\>\n";

                }else{
                    unset(self::$LinkConfArr[$key]);
                    unset(self::$LinkResArr[$key]);
                }
                unset($tmpRes);

            }

        }



        //当自己的连接池、共享的连接池都没有时，建立新连接并保存
//		if (!is_resource($this->currLinkRes))
        if (!$this->currLinkRes)
        {
            if ($slave && is_array($this->conf['s']))
            {
                // 连从库
                if (self::$debug)
                {
                    echo "CONNECT: 连接从库 > {$this->conf['s']['h']} {$this->conf['s']['d']} ";
                    echo "mysqli_connect( {$this->conf['s']['h']}, {$this->conf['s']['u']})<br \\>\n";
                }

                $this->currLinkRes = mysqli_connect( $this->conf['s']['h'], $this->conf['s']['u'], $this->conf['s']['p']);
                //mysql_select_db($this->conf['s']['d'], $this->currLinkRes);

            }else{
                // 连主库
                if (self::$debug)
                {
                    echo "CONNECT: 连接主库 > {$this->conf['h']} {$this->conf['d']} ";
                    echo "mysqli_connect( {$this->conf['h']}, {$this->conf['u']}, {$this->conf['p']})<br \\>\n";
                }
                $this->currLinkRes = mysqli_connect( $this->conf['h'], $this->conf['u'], $this->conf['p']);
                //mysql_select_db($this->conf['d'], $this->currLinkRes);
            }

            if($this->conf['d']=="data_center")
            {
                mysqli_query($this->currLinkRes , "SET NAMES gbk");
            }
            else
            {
                //检查设置数据库字符集
                if(isset($this->conf['c']) && !empty($this->conf['c']))
                {
                    mysqli_query($this->currLinkRes , 'SET NAMES '.$this->conf['c']);
                }
            }

            // 连接成功后，将参数与连接号压入连接池
//			if (is_resource($this->currLinkRes))

            if ($this->currLinkRes)
            {
                //存入共享的连接池
                $key = count(self::$LinkResArr);
                self::$LinkConfArr[$key]  = $currCfg;
                self::$LinkResArr[$key] = $this->currLinkRes;
                $this->currLinkKey = $key;

                //存入自己的连接池
                $this->setCacheLinkRes($slave,$this->currLinkRes);

                if (self::$debug)	echo "CONNECT: 新建连接，压入连接池。<br/>\n";
            }
            else
            {
                //$this->halt("connect({$this->conf['h']}, {$this->conf['u']}, \$Password) 失败。<BR><font color='#ff0000'>数据库连接出错！</font><BR>\n请检查：<BR>\n1、数据库系统是否启动<BR>\n2、连接参数是否正确！");
                $this->halt("数据库繁忙请稍后访问。");
                return false;
            }
        }
        return $this->currLinkRes;
    }




    function setConfig($cfg = null)
    {
        if (!is_array($cfg))
        {
            $this->halt("connect 连接参数不是数组。");
            return false;
        }
        $this->conf = $cfg + $this->conf;

        $this->dbHashKey =self::makeDbHashKey($this->conf);

        return true;
    }

    static function makeDbHashKey($cfg) {
        $s= implode(',',$cfg['s']);
        unset($cfg['s']);
        $s .= implode(',',$cfg);
        //s($s);
        //s(md5($s),1);
        Return md5($s);
    }


    function fetch($query, $result_type = MYSQLI_ASSOC) {

//		if(is_resource($query)){
        if($query->num_rows){
            return mysqli_fetch_array($query, $result_type);
        }else{
            Return array();
        }
    }

    function numRows($query) {

//		if(is_resource($query)){
        if($query->num_rows){
            if(is_resource($query)) {
                return mysql_num_rows($query);
            }else{
                Return false;
            }
        }else{
            Return false;
        }
    }

    function fetchAll($query, $result_type = MYSQLI_ASSOC)
    {
        $rs=array();
        while ($row=$this->fetch($query, $result_type))
        {
            $rs[] = $row;
        }
        return $rs;
    }

    //查询丛库
    function scalar($sql){

        $result = $this->query($sql);
        //查询成功
        if($result!==false)
        {
            $arr=$this->fetch($result);

            if($arr && is_array($arr) )
            {
                return count($arr)>1 ?  $arr : array_shift($arr);;
            }else
            {
                return null; //无值
            }
        }else
        {
            //查询失败
            return $result;
        }
    }


    function update( $array, $condition, $tablename='' )
    {

        if (!is_array($array))
        {
            $this->halt(" update_table( \$array, $condition, $tablename) 错误：第一个参数不是数组！");
        }

        $tem='';
        foreach ($array as $k=>$v)
        {
            $tem .= " `{$k}`='" . addslashes($v) . "',";
        }
        $tem = rtrim($tem, ',');
        $sql = "UPDATE `{$tablename}` SET {$tem} WHERE {$condition}";
        if ( self::$debug)
        {
            echo "更新数组语句：".$sql."<br>\n";
        }

        $result=$this->query($sql);
        if($result){
            return $this->affectedRows();
        }else {
            return false;
        }
    }

    function affectedRows() {
        return	mysqli_affected_rows($this->currLinkRes);
    }


    function insert($array, $tablename )
    {
        if (!is_array( $array))
        {
            $this->halt( "方法 insert() 第1个参数不是数组错误， 表名为 {$stablename} ");
            return false;
        }
        $cols = $values = '';
        foreach($array as $key=>$val)
        {
            $values .= "'" . addslashes($val) . "',";
            $cols .= "`" . trim($key) . "`,";
        }

        $cols   = rtrim( $cols, ',');
        $values = rtrim( $values, ',');
        $sql    = "INSERT INTO `{$tablename}` ({$cols}) VALUES ({$values})";
        if ( self::$debug)
        {
            echo "插入数组语句：".$sql."\n";
        }
        $result= $this->query($sql);

        if($result){
            return $this->insert_id();
        }else{
            return false;
        }
    }


    //查询主从数据库
    function query($sql)
    {
        if (empty($sql))    return 0;

        //如果是select查询，则查从库
        if (strtolower(substr(ltrim($sql), 0, 6))=='select' ){	 	    //|| strtolower(substr(ltrim($sql), 0, 4))=='show'
            //$slave= true;
            switch($this->dbMode){
                case 's-m-m':
                    //按照概率均衡主从库的select操作
                    //$slave= (  ceil(10*self::MASTER_RATE_ON_SELECT) >= rand(1,10) ) ? false  : true ;
                    $slave = true;
                    break;
                case 'm-m-m':
                    $slave = false;
                    break;
            }
            //var_dump($slave);
        }else{
            $slave=false;
        }

        $currlinkCfg=$this->getConfig($slave);

        // 连库并设置、激活 $this->currLinkRes
        if (!$this->connect($slave))    return false;

        if ( self::$debug )		echo ("Debug: connect ".($slave?'slave':'master')." [".$currlinkCfg['d']."][{$currlinkCfg['c']}] <br \\>\n");

        if (!empty($currlinkCfg['d']) && !mysqli_select_db($this->currLinkRes , $currlinkCfg['d']))
        {
            $this->halt("<font color='#ff0000'>无法选择数据库:{$this->conf['d']}</font><BR>\n请检查：<BR>\n1、数据库是否存在<BR>\n2、您是否有相关操作的权限！");
        }
        if ( self::$debug){
            echo ("Debug: query = {$sql}<br>\n");
            $startTime = microtime(true);
        }


        $result  = mysqli_query($this->currLinkRes , $sql);

        if ( self::$debug){
            $startTime = microtime(true) - $startTime;
            $color = $startTime > 1 ? 'red': '';
            echo ("Time: <font color='$color'> {$startTime}</font><hr><br>\n");
        }

        if (!$result)
        {
            $this->halt( "错误的SQL语句:[{$this->conf['d']}] " . $sql);
            return false;
        }

        // Will return nada if it fails. That's fine.
        return $result;
    }

    function getConfig($slave){
        return $slave ? $this->conf['s']  : $this->conf;
    }

    function insert_id()
    {
        // 因插入的是主库
        //$id = mysql_insert_id($this->currLinkRes);
        //if ($id < 0)
        //	{
        $this->dbMode = 'm-m-m';
        $id = $this->scalar('SELECT last_insert_id()');
        $this->dbMode = 's-m-m';
        //	}
        return $id;
    }






    /**
     * 返回服务器的默认数据库配置
     *
     * @return array 配置数组
     */
    static function getDefaultConfig($db='',$charset='utf8')
    {
        if(!$charset)
        {
            $charset='utf8';
        }
        //主库配置
        $master_host = $GLOBALS['DBConfig'][$db]['master_host'];

        //获取一个从库IP地址 随机
        $slave_hosts = explode(',',$GLOBALS['DBConfig'][$db]['slave_host']);
        $slave_host = $slave_hosts[array_rand($slave_hosts)];

        $conf = array(
            array(
                'c' =>  $charset,
                'h' =>  $master_host,
                'd' =>  $GLOBALS['DBConfig'][$db]['database'],
                'u' =>  $GLOBALS['DBConfig'][$db]['username'],
                'p' =>  $GLOBALS['DBConfig'][$db]['password'],
                's' => array(
                    'c' => $charset,//utf8   utf8mb4
                    'h' => $slave_host,
                    'd' =>  $GLOBALS['DBConfig'][$db]['database'],
                    'u' =>  $GLOBALS['DBConfig'][$db]['username'],
                    'p' =>  $GLOBALS['DBConfig'][$db]['password'],
                ),
            ),
        );
        if(strpos($conf[0]['h'],':')===false)		$conf[0]['h'] .= ":".$_SERVER['SINASRV_DB_PORT'] ;
        if(strpos($conf[0]['s']['h'],':')===false)		$conf[0]['s']['h'] .= ":".$_SERVER['SINASRV_DB_PORT_R'] ;
        return $conf;
    }

    static function isUnique2SplitDB($db){
        return in_array($db,array('memory_ec'));
    }


    /**
     * 设置debug模式
     *
     * @param unknown_type $debug
     */
    function setDebug($debug=true){
        self::$debug=$debug;
    }


    /**
     * 显示提示信息
     *
     * @param string $msg 提示信息
     */
    function halt($msg)
    {
        if (self::$report)	$this->haltmsg($msg);
        // 写入日志
        $msg=date('[Y-m-d H:i:s] ') . "\t{$_SERVER["REQUEST_URI"]}\t{$this->errno}\t{$this->error}\t{$_SERVER["QUERY_STRING"]}\t{$msg}\n";
        $log_name='mysql';
        if(defined('SYS_MODULE'))
        {
            $log_name=SYS_MODULE.'_'.$log_name;
        }
        save_log($msg,$log_name);
        //}
    }

    function haltmsg($msg)
    {
        $this->error = @mysqli_error($this->currLinkRes);
        $this->errno = @mysqli_errno($this->currLinkRes);

        if(SYS_RELEASE!='2'){
            echo "<b>Database error:</b> {$msg}<br>\n";
            echo "<b>MySQL error</b>: {$this->errno} ({$this->error})<br><hr/>\n";
        }

    }


    function close()
    {


//		if (is_resource($this->getCacheLinkRes(false)))
        if ($this->getCacheLinkRes(false))
        {

            mysqli_close($this->getCacheLinkRes(false));
            unset(self::$CacheLinkRes[$this->dbHashKey][false]);
        }

//		if (is_resource($this->getCacheLinkRes(true)))
        if ($this->getCacheLinkRes(true))
        {
            //mysqli_close($this->getCacheLinkRes(true));
            unset(self::$CacheLinkRes[$this->dbHashKey][true]);

        }

        unset($this->conf);

        self::$LinkConfArr=null;
        self::$LinkResArr=null;

        return true;

    }
    /*
    static function isUnique2SplitDB($db){
        return in_array($db,array('db_fangyou'));
    }
    */


    /**
     *	高级开发人员使用
     *	数据模式: select-update/delete-insert
    s-m-m: 默认的主从模式（从库略有延时）	实现
    m-m-m: 全部都在主库上操作(实时)			实现
    s-ms-m: 主从手动同步模式(insert有延时)  未实现
     */
    final public function setMode($mode) {
        $arr=array('s-m-m','m-m-m');
        if(in_array($mode,$arr)){
            $this->dbMode=$mode;
            Return true;
        }else{
            Return false;
        }
    }

}

register_shutdown_function(function()
{
    // 如果未指定参数，关闭所有连接
    if(!is_array(Mysql::$LinkConfArr))
    {
        return 0;
    }

    foreach(Mysql::$LinkResArr as $link)
    {
        if ($link)
        {
            mysqli_close($link);
        }
    }

    Mysql::$LinkConfArr=null;
    Mysql::$LinkResArr=null;

    return true;
});


