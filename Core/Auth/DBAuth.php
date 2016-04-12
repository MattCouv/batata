<?php
namespace Core\Auth;

use Core\Database\Database;
/**
*class DBAuth
*Permet une gestion des utilisateurs
*/
class DBAuth
{
	/**
	 * $db est une instance de la Database
	 * @var objet
	 */
	private $db;

	/**
	 * [__construct attribution de l'objet Database a la variable $db]
	 * @param Database $db [description]
	 */
	function __construct(Database $db)
	{
		$this->db = $db;
	}

	/**
	 * [getUserStatut permet de retourner le statut des utilisateurs]
	 * @return string statut ou Bool false si pas de satuts
	 */
	public function getUserStatut(){
		if ($this->logged()) {
			return $_SESSION['auth'];
		}
		return false;
	}

	/**
	 * permet de loger les utilisateurs
	 * @param  string $login    identifiant de login
	 * @param  string $password mot de passe
	 * @return Boolean true si connexion false si pas de connexion
	 */
	public function login($login, $password)
	{
		$user = $this->db->prepare('SELECT * FROM batata_users WHERE login = ?', [$login], null, true);
		if ($user) {
			if (password_verify ( $password , $user->password )) {
				$_SESSION['auth'] = $user->statut;
				return true;
			};
		}
		return false;
	}

	/**
	 * fonction qui vérifie si un utilisateur est bien logger
	 * @return Boolean true or false
	 */
	public function logged(){
		return isset($_SESSION['auth']);
	}
}
 ?>
