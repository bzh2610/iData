<?php
session_start();

	setcookie('token', 'VOID', time() + 30*24*3600, '/', null, false, true);
	setcookie('accountid', 'VOID', time() + 30*24*3600, '/', null, false, true);
$_SESSION = array();
session_destroy();
header("location: index.php"); 

?>