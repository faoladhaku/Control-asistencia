<?php

	require('../../DataBaseConn.php');
	
	$link = @mysql_connect($ser, $u, $pas) or die("No se pudo conectar a la db");
	
	mysql_select_db($db, $link) or die("No se encontro db");
	
	date_default_timezone_set('America/Lima');
	
	$id = $_POST['id'];
	$tema = $_POST['tema'];
	
	$query = "UPDATE asistencia SET asistencia_tema='$tema' WHERE asistencia_id='$id'";

	$result = mysql_query($query) or die(mysql_error());
	
	$data = array();
	
	header("Content-Type: text/javascript; charset=utf-8");
	$data[0] = true;
	if($result) {
		$data[1] = "Tema ingresado exitosamente";
	}else{
		$data[0] = false;
		$data[1] = "Fallo la asignacion del tema";
	}
	echo json_encode($data);
	
	@mysql_close($link);

?>