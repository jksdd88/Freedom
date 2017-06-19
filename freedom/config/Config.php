<?php

//应用配置
$GLOBALS['AppSpace'] = array(
		'app1'	=>	array(
				'domain'	=>	array(
					'develop' => array('freedom.com','www.freedom.com'),
					'test' => array(),
					'production' => array('freedom.sqldo.com','www.sqldo.com'),
				)
		)
);

//Smarty设置
$GLOBALS['Smarty'] = array(
		
		'force_compile' 	=> false,
		'debugging' 		=> false,
		'caching' 			=> false,
		'compile_check' 	=> true,
		'cache_lifetime' 	=> 3600,
		'template_dir' 	=> APP_PATH . 'views',
		'cache_dir' 		=> RUNDATA_PATH . 'smarty/cache',
		'config_dir' 		=> RUNDATA_PATH . 'smarty/configs',
		'plugins_dir' 	=> RUNDATA_PATH . 'smarty/plugins',
		'compile_dir' 	=> RUNDATA_PATH . 'smarty/templates_c',
		'left_delimiter' 	=> '{{',
		'right_delimiter'=> '}}',
		'source_domain' 	=> array(

			'app1' =>	array(
				'develop' => 'http://s.freedom.com',
				'test' => '',
				'production' => 'http://s.sqldo.com',
			),
		)
);

//数据库配置
$GLOBALS['DBConfig'] = array(

	'db1' => array(
		// 服务器地址
		'master_host'		    => '106.15.204.163:3306',
		// 服务器地址
		'slave_host'		    => '106.15.204.163:3306,139.196.46.137:3306',
		// 数据库名
		'database'			=> 'test',
		// 数据库用户名
		'username'		    => 'freedom',
		// 数据库密码
		'password'		    => 'freedom2017'
	)

);

// +----------------------------------------------------------------------
// | 缓存设置
// +----------------------------------------------------------------------

$GLOBALS['cache'] = array(
	// 驱动方式
	'type'   => 'File',
	// 缓存保存目录
	'path'   => RUNDATA_PATH . 'caches/',
	// 缓存前缀
	'prefix' => 'freedom',
	// 缓存有效期 0表示永久缓存
	'expire' => 7200,
);

    // +----------------------------------------------------------------------
    // | 会话设置
    // +----------------------------------------------------------------------

//    'session'                => [
//	'id'             => '',
//	// SESSION_ID的提交变量,解决flash上传跨域
//	'var_session_id' => '',
//	// SESSION 前缀
//	'prefix'         => 'think',
//	// 驱动方式 支持redis memcache memcached
//	'type'           => '',
//	// 是否自动开启 SESSION
//	'auto_start'     => true,
//],

    // +----------------------------------------------------------------------
    // | Cookie设置
    // +----------------------------------------------------------------------
//    'cookie'                 => [
//	// cookie 名称前缀
//	'prefix'    => '',
//	// cookie 保存时间
//	'expire'    => 0,
//	// cookie 保存路径
//	'path'      => '/',
//	// cookie 有效域名
//	'domain'    => '',
//	//  cookie 启用安全传输
//	'secure'    => false,
//	// httponly设置
//	'httponly'  => '',
//	// 是否使用 setcookie
//	'setcookie' => true,
//],
