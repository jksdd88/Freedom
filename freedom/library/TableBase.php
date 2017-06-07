<?php
namespace library;

abstract class TableBase extends \library\Mysql
{
    protected  $_dbname;
	protected  $_charset;
	protected  $_name;
	protected  $_primarykey = 'id';
	protected  $_op;
	protected $_adapter;
    protected $_is_filter = true;

	function __construct() {
		$this->_dbname = $GLOBALS['DBConfig'][$this->_db_config]['database'];
	}

    final public function getAdapter($dbname='') {
		//读取库名
		if(  !$this->_adapter){
			$character=(isset($this->_charset)?$this->_charset : '');
			//if($this->_name=='wx_user_fans')
			if($this->_dbname=='weixin2014_fans')
			{
				$character='utf8mb4';
			}
			$dbname	=  $this->_dbname;			//EcSysTable=>'shop_admin'
			$conf=self::getDbConfig($dbname,  $character);
			$this->_adapter=new Mysql($conf);  //拿到一个implode(','conf['s]).implode(',',conf)=>这个conf里面不包括conf['s]了
		}
		Return $this->_adapter;
	}


	/**
	 * 根据$where_clause统计总数
	 *
	 * @param unknown_type $where_clause
	 * @return unknown
	 */
	final public function getCount($where_clause) {
		Return $this->scalar('count(1)', $where_clause,1);
	}


	/**
	 * 获取指定 字段 的信息
	 *
	 * @param unknown_type $select_fields
	 * @param unknown_type $where_clause
	 * @param unknown_type $is_count 是否是取数量
	 * @return 单值、数组
	 */
	final public function scalar($select_fields, $where_clause,$is_count=0) {
		try{

			$db=$this->getAdapter();
			$sql='';
			if($is_count)//取数量
			{
				$sql='select  '.$select_fields.' from '.$this->_name.' '. $where_clause ;	//. $orderby_clause	." limit ".($currpage-1)*$page_size.','.$page_size;
			}
			else
			{
				$sql='select  '.$select_fields.' from '.$this->_name.' '. $where_clause .' limit 1 ';	//. $orderby_clause	." limit ".($currpage-1)*$page_size.','.$page_size;
			}
			$re =$db->scalar($sql);
            return !is_array($re) ? $re : $this->filterBadWord($re);
 
		} catch(Exception $e) { 
			$frontController=Zend_Controller_Front::getInstance();
			if($frontController->throwExceptions()){
			  var_dump($e,$sql);
			}
		}
	}



	/**
	 * 查询获得记录集
	 *
	 * @param $select_fields
	 * @param unknown_type $where_clause
	 * @param unknown_type $orderby_clause
	 * @param unknown_type $currpage
	 * @param unknown_type $page_size
	 * @return 记录集对象
	 */
	final public function query( $select_fields,$where_clause='',$orderby_clause='',$currpage='',$page_size='' ) {
		try{

			$db=$this->getAdapter();

			$sql='select  '.$select_fields.' from '.$this->_name.' '. $where_clause .' '. $orderby_clause	;

			if(!empty($currpage) && !empty($page_size) ){
				$sql .= ' limit '.($currpage-1)*$page_size.','.$page_size;
			}
            $re=  $db->query($sql);
            return !is_array($re) ? $re : $this->filterBadWord($re);
		} catch(Exception $e) {
			$frontController=Zend_Controller_Front::getInstance();
			if($frontController->throwExceptions()){
			  var_dump($e,$sql);
			}
		}

	}

	/**
	*	获取query后的单行记录
	*/
	final public function  fetch($query)
	{
		if($query){
			$db=$this->getAdapter();
            $re = $db->fetch($query);
            return !is_array($re) ? $re : $this->filterBadWord($re);

		}else{
			Return null;
		}
	}



	/**
	*	获取query后的记录数
	*/
	final public function  numRows($query){
		if($query){
			$db=$this->getAdapter();
			return $db->numRows($query);
		}else{
			Return false;
		}
	}


	/**
	 * 查询数据库键名、键值两字段，返回一个构造的数组
	 *
	 * @param unknown_type $key_field
	 * @param unknown_type $value_field
	 * @param unknown_type $where_clause
	 * @param unknown_type $orderby_clause
	 * @param unknown_type $limit
	 * @return unknown
	 */
	final public function  fetchHash($key_field,$value_field,$where_clause,$orderby_clause='',$limit=null)
	{
		$db=$this->getAdapter();
		$sql="select $key_field as f1 , $value_field as f2  from ".$this->_name." ". $where_clause . $orderby_clause	. ( is_int($limit) ? " limit ".$limit :'');

		$rs=$db->query($sql);

		while($row=$db->fetch($rs)) {
			$arr[$row['f1']]=$row['f2'];
		}

		return $arr;

	}



	/**
	*	存在跨库问题，不推荐使用
	*/
	final public function  fetchAll($sql)
	{
		$db=$this->getAdapter();
		if(is_resource($sql) || is_object($sql)){
			$rs = $sql;
		}else{
			$rs=$db->query($sql);
		}
        $re =  $db->fetchAll($rs);
        return !is_array($re) ? $re : $this->filterBadWord($re);

	}





	final public function debug() {
		$db=$this->getAdapter();
		$db->setDebug();
	}


    /**
     * 关闭db
     *
     * @param unknown_type $freeLinks
     */
	final public function close() {
		$db=$this->getAdapter();
		$db->close();
		unset($this->_myhs);
	}


	/**
	*	读取sina主从数据库的配置
	*/
	final static public function getDbConfig($database,$charset='')
	{
		return Mysql::getDefaultConfig($database,$charset);
	}


	/**
	*	高级开发人员使用
	*	它可以更改所有 model（继承至同一抽象类,如FyTable,FyView等） 连接的数据库,要十分小心使用
	*/
	final public function switchDB($database,$charset=''){
		$conf=self::getDbConfig($database,$charset);
		$this->_adapter=new Mysql($conf);
		//s($dbName);
	}

	/**
	*	高级开发人员使用
	*	要注意当前连接的数据库,小心使用
	*/
	final public function execute($sql) {
		$db=$this->getAdapter();
		Return $db->query($sql);
	}


	/**
	*	高级开发人员使用
	*	数据模式: select-update/delete-insert
	*/
	final public function setModes($mode) {
		$db=$this->getAdapter();
		Return $db->setMode($mode);
	}
	/**
	*	高级开发人员使用：切换到读写主库
	*	数据模式: select-update/delete-insert
	*/
	final public function selectMaster() {
		$db=$this->getAdapter();
		Return $db->setMode('m-m-m');
	}

	/**
	*	高级开发人员使用：切换到读写主从分离模式
	*	数据模式: select-update/delete-insert
	*/
	final public function selectSlaver() {
		$db=$this->getAdapter();
		Return $db->setMode('s-m-m');
	}

    public function filterBadWord($data)
    {
        return $this->_is_filter ? PubFun::filter_badword_array($data) : $data;
    }

    public function isFilter($is)
    {
        $this->_is_filter = $is;
    }
}




