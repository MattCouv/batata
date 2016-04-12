<?php
namespace Core\models;
/*
classe : apps / models /  base.class.php

Les identifiants de tables doivent être nommés id.
L'objet $fpdo d'accés à la base doit être instancié.
La classe expose 6 méthodes publiques :
  - add($datas))
  - get($id)
  - getAll()
  - delete($id)
  - deleteAll()
  - edit($id, $datas)

classe générique CRUD.
développée le 26/03/2015
*/

class Base {

  public $fpdo = null;
  // table associée
  public $table = '';

  /**
   * Le constructeur.
   *
   * @param array $datas   les données à ajouter
   * @return integer  identifiant ajouté.
   */
  public function  __construct( $fpdo ) {
    $this->fpdo = $fpdo;
  }

  /**
   * Ajouter.
   *
   * @param array $datas   les données à ajouter
   * @return integer  identifiant ajouté.
   */
  public function add( $datas ) {

    return $this->fpdo->insertInto( $this->table )->values( $datas )->execute();
  }

  /**
   * Retourne les informations sur un élément ou sur tous les éléments.
   * On vérifie que l'identifiant est bien numérique.
   * @param integer $id     identifiant
   * @return array
   */
  public function get( $id = null) {

    if ( !is_null( $id ) && is_numeric( $id ) ) {
      return $this->fpdo->from( $this->table )->where( 'id', $id )->fetch();
    }
  }

  /**
   * Retourner tous les éléments.
   * @param array   $params paramètres complémentaires (optionnels)
   *                  - valeurs possibles
   *                      o order
   *                      o where
   */
  public function getAll( $params = array() ) {

    $where = isset($params['where']) ? $params['where'] : '';
    $select = isset($params['select']) ? $params['select'] : '';
    if ( isset( $params['order'] ) && strlen( $params['order'] ) > 0 ) {
      return $this->fpdo->from( $this->table )->select(NULL)->select($select)->orderBy( $params['order'] )->where( $where );
    } else {
      return $this->fpdo->from( $this->table )->select(NULL)->select($select)->where( $where );
    }
  }

  public function selectAll(){
    return $this->fpdo->from( $this->table )->select('mcouvreur_fande_questions.TextQ')->fetch();
  }

  /**
   * Effacer un élément.
   * @param integer $id  identifiant à effacer.
   */
  public function delete( $id = null ) {

    $this->fpdo->deleteFrom( $this->table )->where( 'id', $id )->execute();

  }

  /**
   * Effacer TOUS les éléments.
   */
  static public function deleteAll() {

    $this->fpdo->deleteFrom( $this->table )->execute();
  }

  /**
   * Éditer un élément.
   *
   * @param integer $id     identifiant de l'enregistrement à éditer.
   * @param array   $datas  valeurs à modifier
   */
  public function edit( $id, $datas ) {

    $this->fpdo->update( $this->table )->set( $datas )->where( 'id', $id )->execute();
  }

}
?>
