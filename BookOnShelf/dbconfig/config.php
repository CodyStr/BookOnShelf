<?php

define('HOST', '95.170.86.104');
define('USER', 'codymax_root');
define('PASSWORD', 'Qwerty6');
define('DATABASE', 'codymax_bos');
$conn = DB();
function DB()
{
	try {
		$db = new PDO('mysql:host='.HOST.';dbname='.DATABASE.'',USER, PASSWORD);
		return $db;
	} catch (PDOException $e){
		return "Error!: " . $e->getMessage();
		die();
	}
}

/*var_dump(DB());*/

?>