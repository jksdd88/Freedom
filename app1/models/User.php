<?php

class User extends \database\Model
{
	public $_db_config = 'db1';
    public $_name = 'user';
    public $_primarykey = 'id';

 	function prepareData($para)
    {
        $data = array();
        $this->fill_int($para, $data, 'id');                            //自增长主键
        $this->fill_str($para, $data, 'username');                     	//单词内容

        return $data;
    }
	
	public function insert_data($data){
		return $this->insert($data);
	}
  	public function update_data($data , $where){
  		s($data);
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

