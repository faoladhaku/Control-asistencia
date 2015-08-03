<?php

	require('../../DataBaseConn.php');
	
	session_start();
	
	$link = @mysql_connect($ser, $u, $pas) or die("No se pudo conectar a la db");
	
	mysql_select_db($db, $link) or die("No se encontro db");
	
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	
	$query = "SELECT * FROM usuario WHERE usuario_nombre='$user' AND usuario_pass='$pass'";
	
	$result = mysql_query($query) or die(mysql_error());
	
	$num_row = mysql_num_rows($result);
	
	$row = mysql_fetch_array($result);
	
	$data = array();
	
	header("Content-Type: text/javascript; charset=utf-8");
	
	if( $num_row >=1 ) { 
		$_SESSION['user'] = $row['usuario_nombre'];
		$data[0] = true;
		$data[1] = $_SESSION['user'];
	}else{
		$data[0] = false;
		$data[1] = "Usuario o password incorrecto";
	}
	echo json_encode($data);
	
	@mysql_close($link);
	
?>