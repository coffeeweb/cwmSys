<?php

class CadastroController extends \HXPHP\System\Controller
{
	public function cadastrarAction()
	{
		$this->view->setFile('index');

		$this->request->post();

		$cadastrarUsuario = User::cadastrar($this->request->post());

	}
}