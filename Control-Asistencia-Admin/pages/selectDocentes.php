<?php

	$link = @mysql_connect("localhost", "root", "") or die("No se pudo conectar a la db");
	
	mysql_select_db("control", $link) or die("No se encontro db");
	
	$word = $_POST['word'];
	
	$query = "SELECT * FROM docente WHERE docente_nombre LIKE '%$word%'";
	$query .= " or docente_apellido_pat LIKE '%$word%' or docente_dni LIKE '%$word%'";
	
	$result = mysql_query($query) or die(mysql_error());
	
	header("Content-Type: text/javascript; charset=utf-8");
	
	$data = array();
	
	while($row = mysql_fetch_assoc($result)) {
		$data[] = $row;
	}
	
	echo json_encode($data);
	
	@mysql_close($link);

?>