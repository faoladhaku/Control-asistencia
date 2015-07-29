<?php

	$link = @mysql_connect("localhost", "root", "") or die("No se pudo conectar a la db");
	
	mysql_select_db("control", $link) or die("No se encontro db");
	
	$word = $_POST['word'];
	$tipo = $_POST['tipo'];
	
	$query = "SELECT * FROM docente INNER JOIN horario ON docente.docente_id = horario.docente_id";
	$query .= " INNER JOIN cc ON cc.cc_id = horario.cc_id";
	$query .= " WHERE horario.horario_tipo = '$tipo' and (docente.docente_nombre LIKE '%$word%' or docente.docente_apellido_pat LIKE '%$word%')";
		
	$result = mysql_query($query) or die(mysql_error());
	
	header("Content-Type: text/javascript; charset=utf-8");
	
	$data = array();
	
	while($row = mysql_fetch_assoc($result)) {
		$data[] = $row;
	}
	
	echo json_encode($data);
	
	@mysql_close($link);

?>