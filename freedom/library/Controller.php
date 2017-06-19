<?php
namespace library;

class  Controller{
	
 	protected $_controller;
    protected $_action;
 
    // 构造函数，初始化属性，并实例化对应模型
    function __construct($controller, $action)
    {

    }

    final function display($data , $tpl_path)
    {
    	smarty_display($data , $tpl_path);
    }
}