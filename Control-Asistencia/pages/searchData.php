<?php

	$link = @mysql_connect("localhost", "root", "") or die("No se pudo conectar a la db");
	
	mysql_select_db("control", $link) or die("No se encontro db");
	
	date_default_timezone_set('America/Lima');
	
	$id = $_POST['id'];
	
	$query = "SELECT * FROM asistencia";
	$query .= " INNER JOIN horario ON asistencia.horario_id = horario.horario_id";
	$query .= " INNER JOIN docente ON docente.docente_id = horario.docente_id";
	$query .= " INNER JOIN cc ON cc.cc_id = horario.cc_id";
	$query .= " INNER JOIN curso ON curso.curso_id = cc.curso_id";
	$query .= " WHERE asistencia.asistencia_id = '$id'";
	
	$result = mysql_query($query) or die(mysql_error());
	
	$data = array();
	
	header("Content-Type: text/javascript; charset=utf-8");
	
	while($row = mysql_fetch_assoc($result)) {
		$data[] = $row;
	}
	echo json_encode($data);
	
	@mysql_close($link);

?>