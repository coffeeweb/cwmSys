<?php

class CadastroController extends \HXPHP\System\Controller
{
	public function cadastrarAction()
	{
		$this->view->setFile('index');

		$post = $this->request->post();

		if (!empty($post)) {
		 $cadastrarUsuario = User::cadastrar($post);

		 if ($cadastrarUsuario->status === false) {
		 	$this->load('Helpers\Alert', array(
		 			'danger',
		 			'Ops! Não foi posivel efetuar o cadastro,Verifique os seguintes erros :',
		 			$cadastrarUsuario->errors
		 		));
		 }
		}		
	}
}