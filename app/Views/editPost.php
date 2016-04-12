<h1>Editer la réalisation</h1>
  <?php if (!empty($errors)): ?>
    <div class="alert alert-danger" role="alert">
    <?php foreach ($errors as $error): ?>
      <?php echo $error ?>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
<form method="post" class="form" enctype="multipart/form-data">
  <?= $form->input('id','',['type'=>'hidden']);?>
  <?= $form->input('nom','Nom');?>
  <?= $form->textarea('description','Description');?>
  <?= $form->input('annee','Année',array('type'=>'date'));?>
  <?= $form->select('type','Selectionner le type de fichier',array('image','video'));?>
  <p><button type="button" id="cancel" class="btn btn-danger">Ne pas modifier l'image </button></p>
  <div id="option">
    <?php if ($data['type']=='video' && isset($data['lien'])){
      echo  '<label for="lien">Lien de la vidéo</label><input type="text" name="lien" id="lien" class="form-control" value="https://www.youtube.com/watch?v='.$data['lien'].'">';
    }else if ($data['type']=='image' && isset($data['lien'])) {
      echo '<label for="lien">Ajouter une image</label><input type="file" name="lien"id="lien" value="" class="form-control">';
    }?>
  </div>
  <img src="<?= $src = ($data['type']=='video') ? 'http://img.youtube.com/vi/' . $data['lien'] .'/0.jpg' :  '/public/images/galery/' . $data['lien'] . '/thumbnail.jpg';  ?>" alt='<?= $data["nom"] ?>' />
  <button class="btn btn-default" type="submit">post</button>
  <a href="/admin" class="btn btn-default">Annuler</a>
</form>
