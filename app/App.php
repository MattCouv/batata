<?php
/**
*
*/
class App{

	public $title = " Mon site ";
	private $db_instance;
	private $fpdo_instance;
	private $router_instance;
	private static $_instance;

	public static function getInstance(){
		if (is_null(self::$_instance)) {
			self::$_instance = new App();
		}
		return self::$_instance;
	}

	public function getDb(){
		$config = \Core\Config::getInstance(ROOT . '/Config/config.php');
		if (is_null($this->db_instance)) {
			$this->db_instance = new \Core\Database\Database($config->get('db_name'),$config->get('db_user'),$config->get('db_pass'),$config->get('db_host'));
		}
		return $this->db_instance;
	}

	public function getFpdo(){
		if (is_null($this->fpdo_instance)) {
			$this->fpdo_instance = $this->getDb()->getFPDO();
		}
		return $this->fpdo_instance;
	}


	public function getRouting(){
		if (is_null($this->router_instance)) {
			$this->router_instance = new \Core\Routing\Router();
		}
		return $this->router_instance;
	}


	public static function load()
	{
		session_start();
		require ROOT . '/app/Autoloader.php';
		App\Autoloader::register();
		require ROOT . '/Core/Autoloader.php';
		Core\Autoloader::register();
	}


}
