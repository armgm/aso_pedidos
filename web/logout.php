<?php
	session_start();
	session_unset();	
	session_destroy();
	$url_relativa = "index.php";	
	header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/" .$url_relativa);

?>
