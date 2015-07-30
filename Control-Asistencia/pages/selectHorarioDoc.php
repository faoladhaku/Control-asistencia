<?php

	$link = @mysql_connect("localhost", "root", "") or die("No se pudo conectar a la db");
	
	mysql_select_db("control", $link) or die("No se encontro db");
	
	date_default_timezone_set('America/Lima');
	
	$id = $_POST['id'];
	
	$query = "SELECT * FROM horario";
	$query .= " INNER JOIN cc ON horario.cc_id = cc.cc_id";
	$query .= " WHERE horario.docente_id = '$id'";
	
	$result = mysql_query($query) or die(mysql_error());
	
	$data = array();
	
	header("Content-Type: text/javascript; charset=utf-8");
	
	while($row = mysql_fetch_assoc($result)) {
		$data[] = $row;
	}
	echo json_encode($data);
	
	@mysql_close($link);

?>