<?php
class IndexController extends Zend_Controller_Action {
	public function indexAction() {
		
	}
	
	public function materiacursoAction() {
		
		$form = new MateriaCursoForm();
		$this->view->form = $form;
		
		$materia_id = "";
		$curso_id = "";
		$salvar = "";
		$pesquisar = "";
		
		if (isset($_POST ["materia_id"]))
			$materia_id=$_POST["materia_id"];
			
		if (isset($_POST["curso_id"]))
			$curso_id=$_POST["curso_id"];
			
		if (isset($_POST ["salvar"]))
			$salvar=$_POST["salvar"];
			
		if (isset($_POST ["pesquisar"]))
			$pesquisar=$_POST["pesquisar"];
		
		if($salvar=="salvar" && $materia_id!="" && $curso_id != ""){	
			try {
				$user = new Materiacurso();
				$array = array('materia_id'=>$materia_id,'curso_id' => $curso_id);
				$user->insert($array);
				$this->view->mensagem="Salva com sucesso!";
			}
			catch (Exception $e){
				$this->view->mensagem="Erro ao salvar!" . $e->getMessage();
			}
		}
			
		if ($pesquisar=="pesquisar")
		{
			$materiacurso = new Materiacurso();
			$select = $materiacurso->select()->order(array("curso_id asc","curso_id asc"));
			$row = $materiacurso->fetchAll($select);
			$this->view->dado = $row;
		}
	}
	
	public function userAction() {
		
		$form = new UserForm();
		$this->view->form = $form;
		
		$ra = "";
		$nome = "";
		$senha = "";
		$salvar = "";
		$pesquisar = "";
		
		if (isset($_POST["nome"]))
			$nome=$_POST["nome"];
			
		if (isset($_POST["senha"]))
			$senha=$_POST["senha"];
			
		if (isset($_POST["ra"]))
			$ra=$_POST["ra"];
			
		if (isset($_POST["salvar"]))
			$salvar=$_POST["salvar"];
			
		if (isset($_POST["pesquisar"]))
			$pesquisar=$_POST["pesquisar"];
			
		if($salvar=="salvar" && $nome!="" && $senha != "" &&  $ra != "")
		{
			try {
				$user = new User();
				$array = array('ra'=>$ra,'nome' => $nome, 'senha' => $senha);
				$user->insert($array);
				$this->view->mensagem="Salva com sucesso!";
			}
			catch (Exception $e){
				$this->view->mensagem="Erro ao salvar!" . $e->getMessage();
			}
		}
		
		if ($pesquisar=="pesquisar")
		{
			$user = new User();
			$select = $user->select()->order("nome asc");
			$row = $user->fetchAll($select);
			$this->view->dado = $row;
		}
	}
	
	public function cursoAction() {
		
		$form = new cursoForm();
		$this->view->form = $form;
		
		$nome="";
		$salvar="";
		$pesquisar="";
		
		if (isset($_POST["nome"]))
			$nome=$_POST["nome"];
			
		if (isset($_POST["salvar"]))
			$salvar=$_POST["salvar"];
			
		if (isset($_POST["pesquisar"]))
			$pesquisar=$_POST["pesquisar"];
			
		if($salvar=="salvar" && $nome!="")
		{
			try {
				$curso = new Curso();
				$array = array('nome'=>$nome);
				$curso->insert($array);
				$this->view->mensagem="Salva com sucesso!";
			}
			catch (Exception $e){
				$this->view->mensagem="Erro ao salvar!" . $e->getMessage();
			}
		}
		
		if ($pesquisar=="pesquisar")
		{
			$curso = new Curso();
			$select = $curso->select()->order("nome asc");
			$row = $curso->fetchAll($select);
			$this->view->dado = $row;
		}
	}
	
	public function materiaAction() {
		
		$form = new MateriaForm();
		$this->view->form = $form;
		
		$nome="";
		$salvar="";
		$pesquisar="";
		
		if (isset($_POST["nome"]))
			$nome=$_POST["nome"];
			
		if (isset($_POST["salvar"]))
			$salvar=$_POST["salvar"];
			
		if (isset($_POST["pesquisar"]))
			$pesquisar=$_POST["pesquisar"];
		
		
		if($salvar=="salvar" && $nome!=""){
			try {
				$materia = new Materia();
				$array = array('nome'=>$nome);
				$materia->insert($array);
				$this->view->mensagem="Salva com sucesso!";
			}
			catch (Exception $e){
				$this->view->mensagem="Erro ao salvar!" . $e->getMessage();
			}
		}
		
		if ($pesquisar=="pesquisar")
		{
			$materia = new Materia();
			$select = $materia->select()->order("nome asc");
			$row = $materia->fetchAll($select);
			$this->view->dado = $row;
		}	
	}
}