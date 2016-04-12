<?php
namespace Core\Upload;
/**
 *
 */
class UploadFile
{
  private $directory;
  private $allowedExtentions;
  private $uniqId;
  private $errors;
  public function __construct()
  {
    $this->directory = 'public/images/galery/';
    $this->allowedExtentions = ['image/jpeg','image/png'];
    $this->errors = [];
  }
  private function displayErrors(){
      print_r($this->errors);
      die();
      return $this->errors;
  }
  public function upload($file)
  {
    $this->validate($file);
    if(!empty($this->errors)){
      return $this->errors;
    }
      // print_r($file);
      $this->setFolder($file);
      // print_r($this->directory);
      if(!move_uploaded_file($file["tmp_name"], "$this->directory" . '/' . $file["name"])){
        array_push($this->errors,"Il n'y a pas d'image");
        return false;
      }
      return true;
  }
  public function setAllowedExtentions($type=[])
  {
    $this->allowedExtentions = $type;
  }
  private function uniqId($file)
  {
    $path_parts = pathinfo($this->suppAccent($file["name"]));
    return $this->uniqId = $path_parts['filename'] . uniqId();
  }
  private function suppAccent($chaine)
  {
    $a = array("ä", "â", "à");
    $chaine = str_replace($a, "a", $chaine);

    $e = array("é", "è", "ê", "ë");
    $chaine = str_replace($e, "e", $chaine);

    $c = array("ç");
    $chaine = str_replace($c, "c", $chaine);

    return $chaine;

  }
  public function getId()
  {
    return $this->uniqId;
  }
  public function selectDirectory($path)
  {
    $this->directory = $path;
  }
  private function setFolder($file)
  {
    $this->directory = $this->directory . $this->uniqId($file);
    if (!file_exists($this->directory)) {
      mkdir($this->directory, 0777, true);
    }
  }
  private function validate($file)
  {
    if(empty($file['name']) || empty($file)){
      array_push($this->errors,"Il n'y a pas d'image");
    }
    if(!in_array($file['type'],$this->allowedExtentions)){
      array_push($this->errors,"Le fichier n'est pas une image");
    }
  }
  public function resize($file,$options=[])
  {
    if(!empty($this->errors)){
      return false;
    }
      extract($options);
      if(!isset($options['name'])) $options['name']="thumbnail";
      if(!isset($options['width'])) $options['width']=300;
      var_dump($options);
      $image_source = "$this->directory" . '/' . $file['name'];
      if ($file['type']=='image/jpeg') {
        $resize_image = "$this->directory" . '/' . $options['name'] . '.jpg';
      }else{
        $resize_image = "$this->directory" . '/' . $options['name'] . '.png';
      }
	    /*lister les dimensions de l'image*/
	    list($width, $height) = getimagesize($image_source);
      // définir une nouvelle image avec les dimensions autorisés new_width et new_height
	    $new_width=$options['width'];
	    //new height= 300/(width/height)
	    $new_height=$new_width/($width/$height);
	    //Retourne un identifiant de ressource d'image $dst_image
	    $thumb_image = ImageCreateTrueColor( $new_width, $new_height );
	    /*si l'image est un jpeg ou un pjpeg*/
	    if ($file['type']=='image/jpeg') {
	      // lire l'image d'origine
	      $src_image = imagecreatefromjpeg( $image_source );
	    }else{
	      //si l'image est un png
	      $src_image = imagecreatefrompng( $image_source );
	    }
	    //retaillement de l'image
	    imagecopyresized($thumb_image, $src_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
	    //création d'une image jpeg
	    if ($file['type']=='image/jpeg') {
	      imagejpeg( $thumb_image, $resize_image, 75 );
      }else{
        imagepng( $thumb_image, $resize_image, 75 );
      }
	    // effacer les zones mémoire
	    imagedestroy($src_image);
	    imagedestroy($thumb_image);
  }
}
 ?>
