<?php
class UserForm extends Zend_Form {
	public function init(){
		
		$this->setAction("../index/user");
		$this->setMethod("post");
		
		$nome = $this->createElement("text","nome");
		$nome->setLabel("Usuário");
		$senha = $this->createElement("password","senha");
		$senha->setLabel("Senha");
		$ra = $this->createElement("text","ra");
		$ra->setLabel("RA");
		
		/*
		$sql = new Curso();
		$select = $sql->select()->order("nome asc");
		$row = $sql->fetchAll($select);
		$curso = $this->createElement('select','curso');
		$curso->setLabel('Curso:');
		$curso->addMultiOption('','Escolha'); 
		
		foreach($row as $obj){
        	$curso->addMultiOption($obj->id, $obj->nome);
		}
		*/
		
		$salvar = $this->createElement("submit","salvar");
		$pesquisar = $this->createElement("submit","pesquisar");
		$this->addElements(array($nome, $senha, $ra, $salvar, $pesquisar));
	}
}