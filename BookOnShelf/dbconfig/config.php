<?php

define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'bos');
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