<?php
	
	session_start();
	unset($_SESSION["user"]);
	session_destroy();
	
	header("Content-Type: text/javascript; charset=utf-8");
	
	echo json_encode("no user");
	
?>