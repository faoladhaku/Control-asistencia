<?php

	require('../../DataBaseConn.php');
	
	$link = @mysql_connect($ser, $u, $pas) or die("No se pudo conectar a la db");
	
	mysql_select_db($db, $link) or die("No se encontro db");
	
	$table = $_POST['table'];
	$campo = $_POST['campo'];
	
	$query = "SELECT * FROM $table ORDER BY $campo" ;
	
	$result = mysql_query($query) or die(mysql_error());
	
	header("Content-Type: text/javascript; charset=utf-8");
	
	$data = array();
	
	while($row = mysql_fetch_assoc($result)) {
		$data[] = $row;
	}
	
	echo json_encode($data);
	
	@mysql_close($link);

?>