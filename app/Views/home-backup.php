<!--Pattern HTML-->
<div id="modale">
      <ul class="modale--scene">
        <li class="layer" data-depth="0.30">
          <header>
            <button class="hamburger">&#9776;</button>
            <button class="croix">&#735;</button>
          </header>
          <a class="retour" href="#"> Retour </a>

            <div class="menu">
              <ul>
                <a href="#"><li>Gallerie</li></a>
                <a href="#"><li>A propos</li></a>
              </ul>
            </div>

          <div id="pattern" class="pattern">
          <div class="popup">
            <div class=""></div>
            <button class="popup--close" > X </button>
          </div>
            <ul class="g">
              <?php foreach ($datas as $value): ?>
                <?php if ($value['type']=='video'){
                  $src = 'http://img.youtube.com/vi/' . $value['lien'] .'/sddefault.jpg';
                }else{
                  $src = '/public/images/galery/' . $value['lien'] . '/thumbnail.jpg';
                }; ?>
                <li><img data-id="<?= $value['id'] ?>" class="pattern--lien" src="<?= $src = ($value['type']=='video') ? 'http://img.youtube.com/vi/' . $value['lien'] .'/0.jpg' :  '/public/images/galery/' . $value['lien'] . '/thumbnail.jpg';  ?>" alt='<?= $value["nom"] ?>' /></li>
              <?php endforeach; ?>

            </ul>
          </div>

        </li>
      </ul>
    </div>


  <div class="accueil">
<h1 class="accueil--titre"> Batata3000 </h1>
    <ul class="accueil--scene">
      <li class="layer" data-depth="0.50"><img src="img/pras.jpg"></li>
    </ul>
      <a class="accueil--btn" href="#modale"> Parcourir... </a>
  </div>
