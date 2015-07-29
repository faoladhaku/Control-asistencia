<?php

	$link = @mysql_connect("localhost", "root", "") or die("No se pudo conectar a la db");
	
	mysql_select_db("control", $link) or die("No se encontro db");
	
	$cond = $_POST['cond'];
	
	$query = "SELECT DISTINCT cc.cc_id, cc.cc_codigo, curso.curso_nombre";
	$query .= " FROM docente INNER JOIN horario ON docente.docente_id = horario.docente_id";
	$query .= " INNER JOIN cc ON cc.cc_id = horario.cc_id";
	$query .= " INNER JOIN curso ON curso.curso_id = cc.curso_id";
	$query .= " WHERE horario.docente_id = '$cond' ORDER BY curso.curso_nombre";
	
	$result = mysql_query($query) or die(mysql_error());
	
	header("Content-Type: text/javascript; charset=utf-8");
	
	$data = array();
	
	while($row = mysql_fetch_assoc($result)) {
		$data[] = $row;
	}
	
	echo json_encode($data);
	
	@mysql_close($link);

?>