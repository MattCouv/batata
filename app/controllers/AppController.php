<?php
namespace App\controllers;
use \Core\Controller\Controller;
use \Core\FluentPDO\FluentPDO;
use \App;
use \Core\Validation\Validation;
use \Core\Upload\UploadFile;
/**
*
*/
class AppController extends Controller
{
	protected $template = 'default';
	private $fpdo;
	function __construct()
	{
		$this->fpdo = App::getInstance()->getFpdo();
		$this->viewPath = ROOT . '/app/Views/';
	}

	public function model($model)
	{
		$file = ROOT . '/app/models/' . $model . '.php';
		require_once $file;
		return new $model($this->fpdo);
	}

	public function item_validation($POST)
	{
	  /*** an array of rules ***/
	    $rules_array = array(
	        'nom'=>array('type'=>'string',  'required'=>true, 'min'=>1, 'max'=>250, 'trim'=>true),
	        'description'=>array('type'=>'string',  'required'=>true, 'min'=>1, 'max'=>5000, 'trim'=>true),
	        'annee'=>array('type'=>'string', 'required'=>true, 'min'=>1, 'max'=>10, 'trim'=>true),
	        'type'=>array('type'=>'string',  'required'=>true, 'min'=>1, 'max'=>5, 'trim'=>true),
	        );

	    /*** a new validation instance ***/
	    $val = new Validation;

	    /*** use POST as the source ***/
	    $val->addSource($POST);

	    /*** add a form field rule ***/
	    if($POST['type']=='video'){
				if(isset($POST['lien'])) {
					$val->addRule('lien', 'url', true, 1, 150, true);
				}
	    }

	    /*** add an array of rules ***/
	    $val->addRules($rules_array);

	    /*** run the validation rules ***/
	    $val->run();


	    return array($val->errors,$val->sanitized);

	}
	function get_videoID($url)
	{
		return str_replace('https://www.youtube.com/watch?v=', '', $url);
	}

	function saveFile($file)
	{
		if (!empty($file)) {
			$image = new UploadFile();
			$image->selectDirectory(ROOT . '/public/images/galery/');
		  $errors = $image->upload($file);
			if($errors===true) {
				$image->resize($file);
				$image->resize($file,['name'=>'large','width'=>960]);
				return $image->getId();
			}else {
				return $errors;
			}
		}
	}

}
 ?>
