<h1>Ajouter une réalisation</h1>
  <?php if (!empty($errors)): ?>
    <div class="alert alert-danger" role="alert">
    <?php foreach ($errors as $error): ?>
      <?php echo $error ?>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
<form method="post" class="form" enctype="multipart/form-data">
  <?= $form->input('nom','Nom');?>
  <?= $form->textarea('description','Description');?>
  <?= $form->input('annee','Année',array('type'=>'date'));?>
  <?= $form->select('type','Selectionner le type de fichier',array('image','video'));?>
  <div id="option">
    <label for="lien">Ajouter une image</label><input type="file" name="lien" id="lien" value="" class="form-control">
  </div>
  <button class="btn btn-default" type="submit">post</button>
  <a href="/admin" class="btn btn-default">Annuler</a>
</form>
