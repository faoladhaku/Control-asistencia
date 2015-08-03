<?php

	require('../../DataBaseConn.php');
	
	$link = @mysql_connect($ser, $u, $pas) or die("No se pudo conectar a la db");
	
	mysql_select_db($db, $link) or die("No se encontro db");
	
	$id = $_POST['id'];
	$type = $_POST['type'];
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	
	$data = array();
	$data[0] = true;
	if($type == "add"){
		$query = "SELECT * FROM usuario WHERE usuario_nombre='$user'";
		$result = mysql_query($query);
		$num_row = mysql_num_rows($result);
		if($num_row == 0){
			$query = "INSERT INTO usuario(usuario_nombre, usuario_pass, created_on) VALUES('$user', '$pass', NOW())";
		}else{
			$data[0] = false;
			$data[1] = "El usuario ya existe";
		}
	}else{
		$query = "DELETE FROM usuario WHERE usuario_id='$id'";
	}
	
	header("Content-Type: text/javascript; charset=utf-8");
	
	if($data[0]){
		$result = mysql_query($query);
		
		if($result and $type == "add") {
			$data[1] = "Registro ingresado con exito";
		}elseif($result and $type == "delete"){
			$data[1] = "Registro eliminado con exito";
		}else{
			$data[0] = false;
			$data[1] = "Imposible, el registro es dependiente";
		}
	}
	echo json_encode($data);
	
	@mysql_close($link);

?>