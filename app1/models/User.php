<?php

class User extends \library\database\Model
{
	public $_db_config = 'db1';
    public $_name = 'user';
    public $_primarykey = 'id';

 	function prepareData($para)
    {
        $data = array();
        $this->fill_int($para, $data, 'id');                            //自增长主键
        $this->fill_str($para, $data, 'content');                     	//单词内容
        $this->fill_str($para, $data, 'translation');                   //有道翻译
        $this->fill_str($para, $data, 'phonetic');                      //音标
        $this->fill_str($para, $data, 'ukphonetic');                   	//英式发音
        $this->fill_str($para, $data, 'usphonetic');                     //美发音
        $this->fill_str($para, $data, 'explains');                       //说明
        $this->fill_str($para, $data, 'web_value');                      //网络注释
        $this->fill_int($para, $data, 'course_id');                      //外键关联课程表
        $this->fill_str($para, $data, 'uk_audio');                       //英式发音音频
        $this->fill_str($para, $data, 'us_audio');                       //美式发音音频

        return $data;
    }
	
	public function insert_data($data){
		return $this->insert($data);
	}
  	public function update_data($data , $where){
  		
  		return $this->update($data , $where);
  	}
  	
	public function get_data($where , $field = "*"){
		return $this->scalar($where , $field);
  	}
  	
	public function select_list($sql){
		return $this->fetchAll($sql);
  	}


    protected function getDbName()
    {
        // TODO: Implement getDbName() method.
    }
}

