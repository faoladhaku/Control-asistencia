<?php

	$link = @mysql_connect("localhost", "root", "") or die("No se pudo conectar a la db");
	
	mysql_select_db("control", $link) or die("No se encontro db");
	
	$data = array();
	
	$id = $_POST['id'];
	$type = $_POST['type'];
	$doce = $_POST['docente'];
	$cc = $_POST['cc'];
	
	if($type == "add"){
		
		$n = 1;
		while(isset($_POST["dia_$n"])){
			$dia = $_POST["dia_$n"];
			$ini = $_POST["horini_$n"];
			$fin = $_POST["horfin_$n"];
			$query = "INSERT INTO horario (docente_id, cc_id, horario_dia, horario_hora_ini, horario_hora_fin, created_on)";
			$query .= " VALUES('$doce', '$cc', '$dia', '$ini', '$fin', NOW())";
			$result = mysql_query($query);
			$n += 1;
		}
		
	}elseif($type == "edit"){
	
		$dia = $_POST["dia_1"];
		$ini = $_POST["horini_1"];
		$fin = $_POST["horfin_1"];
		
		$query = "UPDATE horario SET docente_id='$doce', cc_id='$cc', horario_dia='$dia', horario_hora_ini='$ini',";
		$query .= " horario_hora_fin='$fin' WHERE horario_id='$id'";
		
		$result = mysql_query($query);
		
	}else{

		$query = "DELETE FROM horario WHERE horario_id='$id'";
		$result = mysql_query($query);
	}
	
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
		$data[1] = "Fallo la accion solicitada";
	}
	echo json_encode($data);
	
	@mysql_close($link);

?>