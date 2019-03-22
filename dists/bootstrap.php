<?php

require __DIR__ . '/vendor/autoload.php';
#require __DIR__ . '/define.php';

session_start();

function h($str, $double_encode = true){
	return htmlspecialchars($str, ENT_QUOTES, 'UTF-8', $double_encode);
}

function require_logined_session(){
	if (!isset($_SESSION['state']) || $_SESSION['state'] !== 'logined') {
		echo "認証開始";
		header('Location: /login.php');
		exit;
	}
}

function require_unlogined_session(){
	if (isset($_SESSION['state']) && $_SESSION['state'] === 'logined') {
		header('Location: /');
		exit;
	}
}

function require_logout_session(){
	unset($_SESSION['state'],$_SESSION['client'],$_SESSION['info']);
	header('Location: /');
	exit;
}
