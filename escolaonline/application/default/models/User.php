<?php
class User extends Zend_Db_Table_Abstract{
	protected  $name = 'user';
	
	public function insert(array $data){
		if(!isset($data['senha']))
			$data['senha'] = 123456;
			
		$data['senha'] = sha1($data['senha']);
		
		return parent::insert($data);
	}
}