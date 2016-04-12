<div class="modal__galery">
<nav class="nav">
  <ul class="nav__menu">
    <li><a href="/">Accueil</a></li>
    <li><a href="/about">A propos</a></li>
  </ul>
  <a href="#" class="nav__close">X</a>
</nav>
<ul class="galery">
    <?php foreach ($datas as $value): ?>
    <li class="galery__item card">
      <a href="#" data-id="<?= $value['id'] ?>" class="galery__itemlink">
        <div class="galery__item--imageContainer">
          <img  class="galery__item--image" src="<?= $src = ($value['type']=='video') ? 'http://img.youtube.com/vi/' . $value['lien'] .'/sddefault.jpg' :  '/images/galery/' . $value['lien'] . '/thumbnail.jpg';  ?>" alt="<?= $value['nom'] ?>" >
        </div>
        <div class="galery__itemContent">
          <h2><?= substr($value['nom'], 0, 10) . "..."; ?></h2>
        </div>
      </a>
    </li>
    <?php endforeach; ?>
  </ul>
</div>
<div class="modal__item">
  <div class="modal__popup"></div>
</div>
<ul id="scene" class="scene">
  <li class="layer" data-depth="0.50"><img src="/images/parallax/Allan (Escargot).png"></li>
  <li class="layer" data-depth="0.30"><img src="/images/parallax/Allan (Escargot)1.png"></li>
  <li class="layer" data-depth="0.60"><img src="/images/parallax/Allan (Escargot)2.png"></li>
  <li class="layer" data-depth="0.40"><img src="/images/parallax/Allan (Escargot)3.png"></li>
  <li class="layer" data-depth="0.20"><img src="/images/parallax/Allan (Escargot)4.png"></li>
  <li class="layer" data-depth="0.80"><img src="/images/parallax/Allan (Escargot)5.png"></li>
</ul>
<div class="enter">
  <img src="" alt="" class="enter__logo">
  <a href="" class="enter__btn"><h1>Visiter le site</h1></a>
</div>
</div>
