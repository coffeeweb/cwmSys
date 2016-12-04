<?php 

class User extends \HXPHP\System\Model
{

	static $validates_presence_of = array(
      array(
      	'name',
      	'message' => 'O Nome é um campo obrigatório'
      	),
      array(
      	'email',
      	'message' => 'O email é um campo obrigatório'
      	),
      array(
      	'username',
      	'message' => 'O usuario é um campo obrigatório'
      	),
      array(
      	'password',
      	'message' => 'a senha é um campo obrigatório'
      	)

   );

	static $validates_uniqueness_of = array(
		array(
			array('username', 'email'),
			'message' => 'Ja existe um usuario com este e-mail e/ou nome de usuario.'
			)
		);

	public static function cadastrar(array $post){

		$userObj = new \stdClass;
		$userObj->user = null;
		$userObj->status = false;
		$userObj->errors = array();


		$role = Role::find_by_role('user');

		if (is_null($role)) {
			array_push($userObj->errors,'A role user não existe, Contate o administrador');
			return $userObj;
		}

		$post = array_merge($post, array(
			'role_id' => $role->id,
		    'status' => 1
		    ));

		$password = \HXPHP\System\Tools::hashHX($post['password']);

		$post = array_merge($post, $password);

		$cadastrar = self::create($post);

		if ($cadastrar->is_valid()) {
			$userObj->user = $cadastrar;
			$userObj->status = true;
			return $userObj;
		}

		$errors = $cadastrar->errors->get_raw_errors();

		foreach ($errors as $field => $message) {
			array_push($userObj->errors, $message[0]);
		}

		return $userObj;
	}
}