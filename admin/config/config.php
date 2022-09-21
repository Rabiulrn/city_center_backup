<?php
	$whitelist = array(
	    '127.0.0.1',
	    '::1'
	);
	date_default_timezone_set("Asia/Dhaka");
	define("DB_NAME", "xl_software3"); //utf-8 die kora
	define("HOST", "localhost");
	define("USER", "webdev");

	if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
	    define("PASS", "");
	} else {
		define("PASS", "webdev@2022");
	}

	
?>
