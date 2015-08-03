<?php

	require('../../DataBaseConn.php');
	
	$link = @mysql_connect($ser, $u, $pas) or die("No se pudo conectar a la db");
	
	mysql_select_db($db, $link) or die("No se encontro db");
	
	$word = $_POST['word'];
	
	$query = "SELECT * FROM curso INNER JOIN cc ON curso.curso_id = cc.curso_id";
	$query .= " INNER JOIN carrera ON cc.carrera_id = carrera.carrera_id";
	$query .= " WHERE curso.curso_nombre LIKE '%$word%' or cc.cc_codigo LIKE '%$word%'";
		
	$result = mysql_query($query) or die(mysql_error());
	
	header("Content-Type: text/javascript; charset=utf-8");
	
	$data = array();
	
	while($row = mysql_fetch_assoc($result)) {
		$data[] = $row;
	}
	
	echo json_encode($data);
	
	@mysql_close($link);

?>