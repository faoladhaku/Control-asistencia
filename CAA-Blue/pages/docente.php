<?php

	require('../../DataBaseConn.php');
	
	$link = @mysql_connect($ser, $u, $pas) or die("No se pudo conectar a la db");
	
	mysql_select_db($db, $link) or die("No se encontro db");
	
	$id = $_POST['id'];
	$type = $_POST['type'];
	$name = $_POST['name'];
	$a_pat = $_POST['a_pat'];
	$a_mat = $_POST['a_mat'];
	$email = $_POST['email'];
	$dir = $_POST['dir'];
	$telf = $_POST['telf'];
	$dni = $_POST['dni'];
	
	if($type == "add"){
		$query = "INSERT INTO docente(docente_dni, docente_nombre, docente_apellido_pat, docente_apellido_mat,";
		$query .= " docente_email, docente_direccion, docente_telefono, created_on)";
		$query .= " VALUES('$dni', '$name', '$a_pat', '$a_mat', '$email', '$dir', '$telf', NOW())";
	}elseif($type == "edit"){
		$query = "UPDATE docente SET docente_dni='$dni', docente_nombre='$name', docente_apellido_pat='$a_pat',";
		$query .= " docente_apellido_mat='$a_mat', docente_email='$email', docente_direccion='$dir',";
		$query .= " docente_telefono='$telf' WHERE docente_id='$id'";
	}else{
		$query = "DELETE FROM docente WHERE docente_id='$id'";
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