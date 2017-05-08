<?php

require __DIR__ . '/bootstrap.php';

require_unlogined_session();

use mpyw\Cowitter\Client;

try {
	if (!isset($_SESSION['state'])) {
		$_SESSION['client'] = new Client([CK,CS]);
		$_SESSION['client'] = $_SESSION['client']->oauthForRequestToken('http://127.0.0.1:8118/login.php');
		$_SESSION['state'] = 'pending';
		echo "認証中";
		header("Location: {$_SESSION['client']->getAuthorizeUrl()}");
		exit;
	} else {
		$_SESSION['client'] = $_SESSION['client']->oauthForAccessToken(filter_input(INPUT_GET, 'oauth_verifier'));
		$_SESSION['state'] = 'logined';
		$_SESSION['info'] = $_SESSION['client']->get('account/verify_credentials');
		echo "認証完了";
		header('Location: /');
		exit;
	}
} catch (\RuntimeException $e) {
	session_destroy();
	header('Content-Type: text/plain; charset=UTF-8', true, 500);
	exit($e->getMessage());
}
