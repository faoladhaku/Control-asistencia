<?php

	require('../../DataBaseConn.php');

	$day = array(
		"Domingo" => 0,
		"Lunes" => 1,
		"Martes" => 2,
		"Miercoles" => 3,
		"Jueves" => 4,
		"Viernes" => 5,
		"Sabado" => 6
		);
	
	$link = @mysql_connect($ser, $u, $pas) or die("No se pudo conectar a la db");
	
	mysql_select_db($db, $link) or die("No se encontro db");
	
	date_default_timezone_set('America/Lima');
	
	$id = $_POST['id'];
	$date = getDate();
	
	$fec = strval($date['year'])."-".strval($date['mon'])."-".strval($date['mday']);
	$s = $date['wday'];
	
	$ni= strtotime ( '-'.strval($s).' day' , strtotime ($fec) ) ;
	$ni = date ( 'Y-m-d' , $ni );
	$nf= strtotime ( '+'.strval(6-$s).' day' , strtotime ($fec) ) ;
	$nf = date ( 'Y-m-d' , $nf );	
	
	$query = "SELECT * FROM horario";
	$query .= " INNER JOIN cc ON horario.cc_id = cc.cc_id";
	$query .= " WHERE horario.docente_id = '$id' and";
	$query .= " (horario.horario_tipo=1 or horario.horario_fecha BETWEEN '$ni' AND '$nf')";
	$query .= " ORDER BY horario.horario_hora_ini";
	
	$result = mysql_query($query) or die(mysql_error());
	
	$data = array();
	$data_hor = array();
	
	header("Content-Type: text/javascript; charset=utf-8");
	
	$data[0] = $ni;
	$data[1] = $nf;
	
	while($row = mysql_fetch_assoc($result)) {
		if($row['horario_tipo']){
			$row['nday'] = $day[$row['horario_dia']];
		}else{
			$row['nday'] = date("w", strtotime($row['horario_fecha']));
		}
		$data_hor[] = $row;
	}
	
	$data[2] = $data_hor;
	echo json_encode($data);
	
	@mysql_close($link);

?>