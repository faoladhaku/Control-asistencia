<?php
	
	require('../../DataBaseConn.php');
	
	$link = @mysql_connect($ser, $u, $pas) or die("No se pudo conectar a la db");
	
	mysql_select_db($db, $link) or die("No se encontro db");
	
	date_default_timezone_set('America/Lima');
	
	$cod = $_POST['cod'];
	
	$data = array();
	
	$query = "SELECT * FROM docente WHERE docente_dni='$cod'";
	$result = mysql_query($query);
	$num = mysql_num_rows($result);
	$data[0] = false;
	if($num){
		$doc = mysql_fetch_assoc($result);
		$data[0] = true;
		$data[1] = $doc['docente_id'];
		$data[2] = "Docente: ".$doc['docente_nombre']." ".$doc['docente_apellido_pat']." ".$doc['docente_apellido_mat'];
	}else{
		$data[1] = "El docente no esta registrado";
	}
	
	header("Content-Type: text/javascript; charset=utf-8");
	
	echo json_encode($data);
	
	@mysql_close($link);

?>