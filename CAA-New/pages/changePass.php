<?php 

	require('../../DataBaseConn.php');
	
	session_start();
	
	$link = @mysql_connect($ser, $u, $pas) or die("No se pudo conectar a la db");
	
	mysql_select_db($db, $link) or die("No se encontro db");
	
	$user = $_SESSION['user'];
	$pass = $_POST['npass'];
	
	$query = "UPDATE usuario SET usuario_pass='$pass' WHERE usuario_nombre='$user'";
	
	$result = mysql_query($query);
	
	$data = array();
	
	header("Content-Type: text/javascript; charset=utf-8");
	
	if( $result ) { 
		$data[0] = true;
		$data[1] = "Se cambio el password exitosamente";
	}else{
		$data[0] = false;
		$data[1] = "Fallo el cambio de password";
	}
	
	echo json_encode($data);
	
	@mysql_close($link);
	
?>