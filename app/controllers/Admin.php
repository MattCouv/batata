<?php
namespace App\controllers;
use \Core\HTML\Piform;
use \RecursiveDirectoryIterator;
	/**
	*
	*/
	class Admin extends UserController
	{
		protected $template = 'admin';
		function __construct()
		{
			parent::__construct(__CLASS__);
		}
		public function index()
		{
			$this->showPost();
		}
		public function showPost()
		{
			$oImages = $this->model('images');
			$datas = $oImages->getAll(['select'=>['id','nom','type','annee']]);
			$this->render('tablePost',compact('datas'));
		}
		public function modifier()
		{
			if(!empty($_GET['id']) && $this->logged || !empty($_POST)){
				$oImages = $this->model('images');
				if(empty($_POST)){
					$data = $oImages->get($_GET['id']);
				}else {
					$data = $_POST;
					list($errors,$sdata)=$this->item_validation($data);
					if (empty($errors)) {
						if (isset($sdata['lien']) || isset($_FILES['lien'])) {
							if ($sdata['type']=='video') {
								$sdata['lien'] = $this->get_videoID($sdata['lien']);
							}else{
								$img = $oImages->get($_GET['id']);
								$oldLien = $img['lien'];
								$sdata['lien'] = $this->saveFile($_FILES['lien']);
							}
						}
						if (is_array($sdata['lien'])) {
							foreach ($sdata['lien'] as $key => $value) {
								array_push($errors,$value);
							}
						}
						if (empty($errors)) {
							$oImages->edit($data['id'],$sdata);
							if ($sdata['type']=='image') {
								$src = $oldLien;
								$dir = ROOT . '/public/images/galery/'.$src;
								$this->EmptyDir($dir);
								rmdir($dir);
							}
							header('Location: /admin');
						}
					}
				}
				$form = new Piform($data);
				$this->render('editPost',compact('form','errors','data'));
			}
		}
		public function delete()
		{
			if(!empty($_GET['id']) && $this->logged){
				$oImages = $this->model('images');
				$data = $oImages->get($_GET['id']);
				$oImages->delete($_GET['id']);
				if($data["type"]==='image'){
					$src = $data["lien"];
					$dir = ROOT . '/public/images/galery/'.$src;
					$this->EmptyDir($dir);
					rmdir($dir);
				}
				header('Location: /admin');
			}
		}

		private function EmptyDir($dir) {
			$handle=opendir($dir);
			while (($file = readdir($handle))!==false) {
				echo "$file <br>";
				@unlink($dir.'/'.$file);
			}
			closedir($handle);
		}
		public function addPost()
		{
			if (!empty($_POST) && $this->logged) {
				// var_dump($_POST);
				list($errors,$data)=$this->item_validation($_POST);
				if (empty($errors)) {
					if (isset($data['lien']) || isset($_FILES['lien'])) {
						if ($data['type']=='video') {
							$data['lien'] = $this->get_videoID($data['lien']);
						}else{
							$data['lien'] = $this->saveFile($_FILES['lien']);
						}
					}
					if (is_array($data['lien'])) {
						foreach ($data['lien'] as $key => $value) {
							array_push($errors,$value);
						}
					}
					if (empty($errors)) {
						$oImages = $this->model('images');
						$id = $oImages->add($data);
						header('Location: /admin');
					}
				}
			}
			$form = new Piform($_POST);
			$this->render('addPost',compact('form','errors'));
		}

		public function logout()
		{
			// Unset all of the session variables.
			$_SESSION = array();

			// If it's desired to kill the session, also delete the session cookie.
			// Note: This will destroy the session, and not just the session data!
			if (ini_get("session.use_cookies")) {
			    $params = session_get_cookie_params();
			    setcookie(session_name(), '', time() - 42000,
			        $params["path"], $params["domain"],
			        $params["secure"], $params["httponly"]
			    );
			}

			// Finally, destroy the session.
			session_destroy();
			header('Location: /login');
		}
	}
 ?>
