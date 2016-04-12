<?php

	require('../app/Autoloader.php');
	App\Autoloader::register();

	if (isset($_GET['url'])) {
		$url = $_GET['url'];
	}else{
		$url = 'home';
	}
	ob_start();
	if ($url === 'home') {
		require '../Views/admin/home.php';
	}elseif ($url === 'single') {
		require '../Views/admin/single.php';
	}
	$content = ob_get_clean();
	require '../Views/templates/default.php'
	 ?>

	<!--  RewriteBase /structureMVC/public -->