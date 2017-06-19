<?php

$GLOBALS['AppSpace'] = array(
		'app1'	=>	array(
				'domain'	=>	array(
					'develop' => array('freedom.com','www.freedom.com'),
					'test' => array(),
					'production' => array('freedom.sqldo.com','www.sqldo.com'),
				)
		)
);

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

$GLOBALS['Freedom'] = array(
		'APP_DEBUG'		=> true
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
