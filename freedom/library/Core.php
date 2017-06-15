<?php
namespace library;

class  Core
{
	
	// 运行程序
	final function run()
	{
// 		$included_files = get_included_files();
// 		foreach ($included_files as $filename) {
// 			echo "$filename<br>";
// 		}

		spl_autoload_register(array($this, 'loadClass'));
		$this->setReporting();
		$this->removeMagicQuotes();
		$this->unregisterGlobals();
		$this->route();
	}

	// 路由处理
	final function route()
	{
		$controllerName = 'index';
		$action = 'index';

		$referrer_arr = parse_url( $_SERVER['REQUEST_URI']);
		$urlArray = explode('/',$referrer_arr['path']);
		array_shift($urlArray);
		
		if (!empty($urlArray[0])) {

			// 获取控制器名
			$controllerName = $urlArray[0];

			// 获取动作名
			$action = empty($urlArray[1]) ? 'index' : $urlArray[1];

			//获取URL参数
			$referrer_parameter = null;
			if(!empty($referrer_arr["query"])){
				parse_str($referrer_arr["query"],$referrer_parameter);
			}
			$queryString = empty($referrer_parameter) ? array() : $referrer_parameter;
		}

		// 数据为空的处理
		$queryString  = empty($queryString) ? array() : $queryString;

		// 实例化控制器
		$controller = ucfirst($controllerName) . 'Controller';
		

		// 如果控制器存和动作存在，这调用并传入URL参数
		if ((int)method_exists($controller ,  $action.'Action' )) {
			
			$dispatch = new $controller($controllerName, $action);
			call_user_func_array(array($dispatch ,  $action.'Action' ), $queryString);
			
		} else {
			smarty_display(array() , '404.tpl');
		}
	}

	// 检测开发环境
	final function setReporting()
	{

	}

	// 删除敏感字符
	final function stripSlashesDeep($value)
	{
		$data = '';

		if(is_array($value)){

			$file_keyword = array("insert","update","delete","select","drop","sleep","truncate","union","GROUP BY","substr","concat","length","INFORMATION_SCHEMA");

			foreach($value as $key=>$val)
			{
				$data[$key]=is_array($val)?$val:str_ireplace($file_keyword,'',$val);
			}
		}

		return $data;
	}


	// 检测敏感字符并删除
	public function removeMagicQuotes()
	{

		$_GET = isset($_GET) ? $this->stripSlashesDeep($_GET ) : '';
		$_POST = isset($_POST) ? $this->stripSlashesDeep($_POST ) : '';
		$_REQUEST = isset($_REQUEST) ? $this->stripSlashesDeep($_REQUEST ): '';
		$_COOKIE = isset($_COOKIE) ? $this->stripSlashesDeep($_COOKIE) : '';
		$_SESSION = isset($_SESSION) ? $this->stripSlashesDeep($_SESSION) : '';

	}

	// 检测自定义全局变量（register globals）并移除
	final function unregisterGlobals()
	{
		if (ini_get('register_globals')) {
			$array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
			foreach ($array as $value) {
				foreach ($GLOBALS[$value] as $key => $var) {
					if ($var === $GLOBALS[$key]) {
						unset($GLOBALS[$key]);
					}
				}
			}
		}
	}

	// 自动加载控制器和模型类
	final function loadClass($class)
	{
		$class = explode('\\',str_ireplace('library\\' , '' , $class));
		$class_dir = '';

		foreach($class as $val){
			$class_dir .= '/' . $val;
		}

		$frameworks = FREEDOM_PATH . $class_dir . '.php';
		$controllers = APP_PATH . 'controllers' . $class_dir . '.php';
		$models = APP_PATH . 'models' . $class_dir . '.php';

		if (file_exists($frameworks)) {
			// 加载框架核心类
			include $frameworks;
		} elseif (file_exists($controllers)) {
			// 加载应用控制器类
			include $controllers;
		} elseif (file_exists($models)) {
			//加载应用模型类
			include $models;
		}
	}
}