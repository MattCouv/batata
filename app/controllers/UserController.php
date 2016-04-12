<?php
namespace App\controllers;
use \Core\Auth\DBAuth;
use \App;
/**
*
*/
class UserController extends AppController
{
	protected $template = 'default';
	protected $logged = false;
	function __construct($class)
	{
		parent::__construct();
		$app = App::getInstance();
			$auth = new DBAuth($app->getDb());
			if(!$auth->logged() || $auth->getUserStatut() !== lcfirst(str_replace('App\controllers\\', '', $class))){
				header('Location: /home');
			}
			$this->logged = $auth->logged();
	}
}
 ?>
