<?php

class UserForm extends Zend_Form {
	
	public function init(){
		$this->setAction("../index/index");
		$this->setMethod("post");
		$usuario = $this->createElement("text","usuario");
		$usuario->setLabel("Usuário");
		$this->addElement($usuario);
	}
}