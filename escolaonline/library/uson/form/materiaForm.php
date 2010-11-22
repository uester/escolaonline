<?php

class MateriaForm extends Zend_Form {
	
	public function init(){
		$this->setAction("../index/materia");
		$this->setMethod("post");
		
		$nome = $this->createElement("text","nome");
		$nome->setLabel("Nome");
		$salvar = $this->createElement("submit","salvar");
		$pesquisar = $this->createElement("submit","pesquisar");
		$this->addElements(array($nome, $salvar, $pesquisar));
	}
}