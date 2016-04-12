<?php
namespace Core\Database;
use \PDO;
use \Core\FluentPDO\FluentPDO;
/**
*class Database
*Connexion à une BD
*/
class Database
{
	/**
	 * [$db_name nom de la base de donnée]
	 * @var [string]
	 */
	private $db_name;
	/**
	 * [$db_user identifiant de la bd]
	 * @var [string]
	 */
	private $db_user;
	/**
	 * [$db_pass mot de passe de la bd]
	 * @var [string]
	 */
	private $db_pass;
	/**
	 * [$db_host hébergement de la bd]
	 * @var [string]
	 */
	private $db_host;
	/**
	 * [$pdo objet PDO]
	 * @var [objet]
	 */
	private $pdo;
	/**
	 * [$pdo objet PDO]
	 * @var [objet]
	 */
  private $fpdo;

	/**
	 * [__construct attribution des variables]
	 * @param string $db_name [description]
	 * @param string $db_user [description]
	 * @param string $db_pass [description]
	 * @param string $db_host [description]
	 */
	function __construct($db_name,$db_user = 'root', $db_pass = '', $db_host = 'localhost')
	{
		$this->db_name = $db_name;
		$this->db_user = $db_user;
		$this->db_pass = $db_pass;
		$this->db_host = $db_host;
	}

	/**
	 * [getPDO return une instance de la class PDO et l'attribut a la variable $PDO]
	 * @return [objet] [PDO]
	 */
	private function getPDO()
	{
		if ($this->pdo === null) {
			$pdo = new PDO('mysql:host=' . $this->db_host . ';dbname=' . $this->db_name, $this->db_user, $this->db_pass);
			$pdo->exec('SET NAMES utf8');
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->pdo = $pdo;
		}
		return $this->pdo;
	}

	/**
	 * function qui réalise de requete non préparer
	 * @param  string  $statement  la requete SQL
	 * @param  string  $class_name le nom du modele a utiliser
	 * @param  boolean $one        récuperer une ou plusieur ligne
	 * @return array              tableau de valeur avec les résultats
	 */
	public function query($statement, $class_name = null, $one = false){
		$req = $this->getPDO()->query($statement);
		if ($class_name === null) {
			$req->setFetchMode(PDO::FETCH_OBJ);
		}else{
			$req->setFetchMode(PDO::FETCH_OBJ, $class_name);
		}
		if($one){
			$data = $req->fetch();
		}else{
			$data = $req->fetchAll();
		}
		return $data;
	}
	/**
	 * function qui réalise de requete préparer
	 * @param  string  $statement  la requete SQL
	 * @param  string  $class_name le nom du modele a utiliser
	 * @param  boolean $one        récuperer une ou plusieur ligne
	 * @return array              tableau de valeur avec les résultats
	 */
	public function prepare($statement, $attributes, $class_name = null, $one = false){
		$req = $this->getPDO()->prepare($statement);
		$req->execute($attributes);
		if ($class_name === null) {
			$req->setFetchMode(PDO::FETCH_OBJ);
		}else{
			$req->setFetchMode(PDO::FETCH_OBJ, $class_name);
		}
		if($one){
			$data = $req->fetch();
		}else{
			$data = $req->fetchAll();
		}
		return $data;
	}


  public function getFPDO(){
		if ($this->fpdo === null) {
			$pdo = $this->getPDO();
			$this->fpdo = new FluentPDO($pdo);
		}
		return $this->fpdo;
	}


}
 ?>
