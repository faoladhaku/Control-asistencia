<?php

	require('../../DataBaseConn.php');
	
	$link = @mysql_connect($ser, $u, $pas) or die("No se pudo conectar a la db");
	
	mysql_select_db($db, $link) or die("No se encontro db");
	
	$cond = $_POST['cond'];
	
	$query = "SELECT DISTINCT cc.cc_id, cc.cc_codigo, curso.curso_nombre";
	$query .= " FROM curso INNER JOIN cc ON curso.curso_id = cc.curso_id";
	$query .= " INNER JOIN carrera ON cc.carrera_id = carrera.carrera_id";
	$query .= " WHERE cc.carrera_id = '$cond' ORDER BY curso.curso_nombre";
	
	$result = mysql_query($query) or die(mysql_error());
	
	header("Content-Type: text/javascript; charset=utf-8");
	
	$data = array();
	
	while($row = mysql_fetch_assoc($result)) {
		$data[] = $row;
	}
	
	echo json_encode($data);
	
	@mysql_close($link);

?>