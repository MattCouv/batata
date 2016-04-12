<?php
	'$2y$12$d35TJX8vQQBKVBic3yl5h.LPnonXhlnj8vWem2tEQBzS./EycRDra + MMIlobjois';
	define('ROOT', dirname(__DIR__));
	header ('Content-type: text/html; charset=utf-8');
	require ROOT.'/app/App.php';
	$app = App::getInstance();
	$app::load();
	$app->getRouting();
?>
