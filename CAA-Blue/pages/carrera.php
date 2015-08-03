<?php

	require('../../DataBaseConn.php');
	
	$link = @mysql_connect($ser, $u, $pas) or die("No se pudo conectar a la db");
	
	mysql_select_db($db, $link) or die("No se encontro db");
	
	$id = $_POST['id'];
	$type = $_POST['type'];
	$carr = $_POST['carrera'];
	
	if($type == "add"){
		$query = "INSERT INTO carrera(carrera_nombre, created_on) VALUES('$carr', NOW())";
	}elseif($type == "edit"){
		$query = "UPDATE carrera SET carrera_nombre='$carr' WHERE carrera_id='$id'";
	}else{
		$query = "DELETE FROM carrera WHERE carrera_id='$id'";
	}
	
	$result = mysql_query($query);
	
	$data = array();
	
	header("Content-Type: text/javascript; charset=utf-8");
	$data[0] = true;
	if($result and $type == "add") {
		$data[1] = "Registro ingresado con exito";
	}elseif($result and $type == "edit"){
		$data[1] = "Registro actualizado con exito";
	}elseif($result and $type == "delete"){
		$data[1] = "Registro eliminado con exito";
	}else{
		$data[0] = false;
		$data[1] = "Imposible, el registro es dependiente";
	}
	echo json_encode($data);
	
	@mysql_close($link);

?>