<?php
/**
 * Created by PhpStorm.
 * User: jksdd88
 * Date: 2017/9/19
 * Time: 9:46
 */

require '../freedom/library/Freedom.php';
//$a = new User();
//$val = $a -> select_list('select * from user where 1=1');
//s($val);

//创建一个DOMDocument对象
$doc=new DOMDocument();
//加载XML文件
$doc->load("G:/english.xml");

























////获取所有的book标签
//$bookDom=$doc->getElementsByTagName("content");
//foreach($bookDom as $a){
//
//    $contentuid = "";
//    $contentuid = $a->getAttribute('contentuid');
//    $a_mod = new English();
//    $b = $a_mod->get_data(' where contentuid ="'.$contentuid.'" ','content');
////    $b = $a->nodeValue;
//    $data['q'] = $b;
//    $data['from'] = 'EN';
//    $data['to'] = 'zh-CHS';
//    $data['appKey'] = '266d7ae29dc838e1';
//    $data['salt'] = rand(10000000,99999999);
//    $data['sign'] = md5($data['appKey'].$data['q'].$data['salt'].'4lSK1RINUyYwRXQPB6K3bPNQYKz5MPy9');
//    $c = pubsub_curl("http://openapi.youdao.com/api",$data,false);
//    $d = json_decode($c,true);
//
//    $a->nodeValue = $d['translation'][0];
//
////    $a_mod->insert(array('contentuid'=>$contentuid,'content'=>$b,'c_cn'=>$d['translation'][0]));
//    $a_mod->update_data(array('c_cn' => $d['translation'][0]),' where contentuid ="'.$contentuid.'" ');
//    $doc->save('G:/english.xml');
//}

