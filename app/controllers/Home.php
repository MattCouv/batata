<?php
namespace App\controllers;
use \App\controllers\AppController;
	/**
	*
	*/
	class Home extends AppController
	{
		public function index()
		{
			$oImages = $this->model('images');
			$datas = $oImages->getAll(['select'=>['id','nom','description','type','lien','annee']]);
			$this->render('home',compact('datas'));
		}
	}
 ?>
