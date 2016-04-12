<?php
namespace App\controllers;
use \Core\Auth\DBAuth;
use \Core\HTML\Piform;
use \App;
	/**
	*
	*/
	class Login extends AppController
	{
		public function index()
		{
			$errors = false;

			if (!empty($_POST)) {
				$auth = new DBAuth(App::getInstance()->getDb());
				if($auth->login($_POST['login'],$_POST['password'])){
					header('Location: /' . $auth->getUserStatut());
				}else{
					$errors = true;
				}
			}
			$form = new Piform($_POST);
			$this->render('login',compact('form','errors'));

		}
	}
 ?>
