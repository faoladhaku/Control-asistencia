<?php

	require('../../DataBaseConn.php');
	
	$link = @mysql_connect($ser, $u, $pas) or die("No se pudo conectar a la db");
	
	mysql_select_db($db, $link) or die("No se encontro db");
	
	date_default_timezone_set('America/Lima');
	
	$cod = $_POST['cod'];
	$ini = date("Y-m-d", strtotime(str_replace('/', '-', $_POST['ini'])));
	$fin = date("Y-m-d", strtotime(str_replace('/', '-', $_POST['fin'])));
	
	$query = "SELECT * FROM docente WHERE docente_dni='$cod'";
	$result = mysql_query($query) or die(mysql_error());
	$num_result = mysql_num_rows($result);
	
	header("Content-Type: text/javascript; charset=utf-8");
	
	$data = array();
	$data_hor = array();
	
	$data[0] = false;
	if($num_result){
		$doc = mysql_fetch_assoc($result);
		$data[1] = "Docente: ".$doc['docente_nombre']." ".$doc['docente_apellido_pat']." ".$doc['docente_apellido_mat'];
		$id = $doc['docente_id'];
		$query = "SELECT * FROM horario";
		$query .= " INNER JOIN cc ON horario.cc_id = cc.cc_id";
		$query .= " INNER JOIN asistencia ON horario.horario_id = asistencia.horario_id";
		$query .= " WHERE horario.docente_id = '$id' AND";
		$query .= " asistencia.asistencia_fecha BETWEEN '$ini' AND '$fin'";
		$query .= " ORDER BY asistencia.asistencia_fecha DESC, asistencia.asistencia_hora_ingreso DESC";
		
		$result = mysql_query($query) or die(mysql_error());
		$num_result = mysql_num_rows($result);
		if($num_result){
			$data[0] = true;
			while($row = mysql_fetch_assoc($result)) {
				$data_hor[] = $row;
			}
		}else{
			$data[1] = "No hay registros de asitencia.";
		}
	}else{
		$data[1] = "El docente no esta registrado.";
	}	
	
	$data[2] = $data_hor;
	echo json_encode($data);
	
	@mysql_close($link);

?>