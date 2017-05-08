<?php
	require __DIR__ . '/bootstrap.php';
	require_logined_session();

	use mpyw\Cowitter\Client;

	function getblocklist(){
		$blocklist = array();

		foreach($_SESSION['client']->get('blocks/list')->users as $user){
			$i = count($blocklist);
			$blocklist[$i][0] = $user->name;
			$blocklist[$i][1] = $user->screen_name;
		}
		return $blocklist;
	}


#	$record = ORM::for_table('blocklist')->find_many();
?>
