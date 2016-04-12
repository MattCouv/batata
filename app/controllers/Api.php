<?php
namespace App\controllers;

/**
 *
 */
class Api extends AppController
{
  function getPosts($id)
  {
    if ( !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' && $_SERVER['REQUEST_METHOD'] === 'GET' && $id !== null && is_numeric($id))
    {
      $oImages = $this->model('images');
			$datas = $oImages->get($id);
      echo json_encode($datas);
    }
  }
}

 ?>
