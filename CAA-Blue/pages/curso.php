<?php

	require('../../DataBaseConn.php');
	
	$link = @mysql_connect($ser, $u, $pas) or die("No se pudo conectar a la db");
	
	mysql_select_db($db, $link) or die("No se encontro db");
	
	$id = $_POST['id'];
	$type = $_POST['type'];
	$curso = $_POST['curso'];
	$carr = $_POST['carrera'];	
	$ini = date("Y-m-d", strtotime(str_replace('/', '-', $_POST['fecha_ini'])));
	$fin = date("Y-m-d", strtotime(str_replace('/', '-', $_POST['fecha_fin'])));
	$hor = $_POST['horas'];
	$cod = strtoupper(substr($curso, 0, 3)) . strtoupper(substr($_POST['carr'], 0, 3)) .  strval(date("y")) . strval(date("m"));
	
	$last_id = 0;
	if($type == "add"){
	
		$query = "SELECT * FROM curso WHERE curso_nombre='$curso'";
		$result = mysql_query($query);
		$num_result = mysql_num_rows($result);
		if($num_result == 0){
			$query = "INSERT INTO curso (curso_nombre, created_on) VALUES('$curso', NOW())";
			$result = mysql_query($query);
			$last_id = mysql_insert_id();
		}else{
			$row = mysql_fetch_assoc($result);
			$last_id = $row['curso_id'];
		}
		$query = "INSERT INTO cc (carrera_id, curso_id, cc_codigo, cc_fecha_ini, cc_fecha_fin, cc_horas_sem, created_on)";
		$query .= " VALUES('$carr', '$last_id', '$cod', '$ini', '$fin', '$hor', NOW())";
		
	}elseif($type == "edit"){
	
		$query = "UPDATE cc SET carrera_id='$carr', cc_codigo='$cod', cc_fecha_ini='$ini', cc_fecha_fin='$fin',";
		$query .= " cc_horas_sem='$hor' WHERE cc_id='$id'";
		
	}else{
	
		$query = "SELECT * FROM cc WHERE curso_id = (SELECT MAX(curso_id) FROM cc WHERE cc_id = '$id')";
		$result = mysql_query($query);
		$row = mysql_fetch_assoc($result);
		$last_id = $row['curso_id'];
		$num_result = mysql_num_rows($result);
		$query = "DELETE FROM cc WHERE cc_id='$id'";
		if($num_result == 1){
			$result = mysql_query($query);
			$query = "DELETE FROM curso WHERE curso_id='$last_id'";
		}
		
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