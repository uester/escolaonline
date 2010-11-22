<?php
class MateriaCursoForm extends Zend_Form {
	public function init(){
		
		$this->setAction("../index/materiacurso");
		$this->setMethod("post");
		
		$sql = new Materia();
		$select = $sql->select()->order("nome asc");
		$row = $sql->fetchAll($select);
		$materia = $this->createElement('select','materia_id');
		$materia->setLabel('Materia:');
		$materia->addMultiOption('','Escolha');
		
		foreach($row as $obj){
        	$materia->addMultiOption($obj->id, $obj->nome);
		}
		
		$sql = new Curso();
		$select = $sql->select()->order("nome asc");
		$row = $sql->fetchAll($select);
		$curso = $this->createElement('select','curso_id');
		$curso->setLabel('Curso:');
		$curso->addMultiOption('','Escolha'); 
		
		foreach($row as $obj){
        	$curso->addMultiOption($obj->id, $obj->nome);
		}
		
		$salvar = $this->createElement("submit","salvar");
		$pesquisar = $this->createElement("submit","pesquisar");
		$this->addElements(array($materia, $curso, $salvar, $pesquisar));
	}
}