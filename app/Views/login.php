	<header class="header">
		<h1>Bienvenue sur la zone admin de Batata</h1>
	</header>
	<section class="card login">
		<p id="msg"><?php if($errors){ echo 'Identifiant incorrect';}else{echo '';} ?></p>
		<form class="form-inline" method="post" autocomplete="off" id='login_form'>
			<?= $form->input('login','Utilisateur ou email');?>
			<?= $form->input('password','Mot de passe',['type'=>'password']);?>
			<div>
				<button type="submit"class="btn btn-default" id="submit">Connexion</button>
			</div>
		</form>
	</section>
