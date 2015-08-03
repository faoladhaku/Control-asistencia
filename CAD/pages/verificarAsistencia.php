<?php
	
	require('../../DataBaseConn.php');
	
	function diffMin($horaini, $horafin){
		
		$datetime1 = date_create($horaini);
		$datetime2 = date_create($horafin);
		$interval = date_diff($datetime1, $datetime2);
		$sig = $interval->format('%R');
		$h = $interval->format('%h');
		$m = $interval->format('%i');
		$result = array();  
		$result[0] = $sig;
		$result[1] = 60*intval($h) + intval($m);;
		return $result;
		
	}
	
	$day = array(
		"Monday" => "Lunes",
		"Tuesday" => "Martes",
		"Wednesday" => "Miercoles",
		"Thursday" => "Jueves",
		"Friday" => "Viernes",
		"Saturday" => "Sabado",
		"Sunday" => "Domingo"
		);
		
	$msj = array(
		0 => array(false, "El docente no esta registrado."),
		1 => array(true, "Se registro su hora de salida."),
		2 => array(false, "Espere a que se cumpla su hora de salida."),
		3 => array(true, "Se registro su hora de entrada, Ud es puntual."),
		4 => array(true, "Se registro su hora de entrada, Llego un poco tarde."),
		5 => array(false, "No se registro su entrada, excedio el tiempo limite."),
		6 => array(false, "Ud no tiene clases en este momento."),
		7 => array(false, "Ud ya registro su hora de salida.")
		);
	
	$link = @mysql_connect($ser, $u, $pas) or die("No se pudo conectar a la db");
	
	mysql_select_db($db, $link) or die("No se encontro db");
	
	date_default_timezone_set('America/Lima');
	
	$cod = $_POST['cod'];
	$date = getDate();
	
	$data = array();
	$mensaje = 0;
	$last_id = 0;
	
	$query = "SELECT * FROM docente WHERE docente_dni='$cod'";
	$result = mysql_query($query);
	$num = mysql_num_rows($result);
	$data[0] = false;
	if($num){
		
		// Inicializamos el id del docente y el momento exacto en que marco su asistencia 
		$doc = mysql_fetch_assoc($result);
		$doc_id = $doc['docente_id'];
		$today = $day[$date['weekday']];
		$fec = strval($date['year'])."-".strval($date['mon'])."-".strval($date['mday']);
		$hour = strval($date['hours']).":".strval($date['minutes']).":".strval($date['seconds']);
		
		$query = "SELECT * FROM horario WHERE docente_id='$doc_id' and (horario_dia='$today' or horario_fecha='$fec') ORDER BY horario_hora_ini";
		$result = mysql_query($query);
		
		$mensaje = 6;
		while($row = mysql_fetch_assoc($result)) {
			
			$ini = $row['horario_hora_ini'];
			$fin = $row['horario_hora_fin'];
			$hor_id = $row['horario_id'];
			
			$i = diffMin($hour, $ini);
			$f = diffMin($hour, $fin);
			if( ($i[0] == "-" and $f[0] == "+" ) or ($i[0] == "+" and $i[1] <= 15) or ($f[0] == "-" and $f[1] <= 30) ){
			
				$query = "SELECT * FROM asistencia WHERE horario_id='$hor_id' and asistencia_fecha='$fec'";
				$result2 = mysql_query($query);
				$num_row = mysql_num_rows($result2);
				if($num_row){
					$sch = mysql_fetch_assoc($result2);
					$est = $sch['asistencia_estado'];
					if($est != 1){
						if($f[0] == "-"){
							$a_id = $sch['asistencia_id'];
							$query = "UPDATE asistencia SET asistencia_hora_salida='$hour', asistencia_estado=1 WHERE asistencia_id='$a_id'";
							$result2 = mysql_query($query);
							$mensaje = 1;
						}else{
							$mensaje = 2;
						}
						break;
					}else{
						$mensaje = 7;
					}
				}else{
					if($i[1] > 45){
						$mensaje = 5;
					}else{
						if($i[0] == "+"){
							$mensaje = 3;
						}else{
							$mensaje = 4;
						}
						$query = "INSERT INTO asistencia (horario_id, asistencia_fecha, asistencia_hora_ingreso,";
						$query .= " asistencia_dif, asistencia_sig, created_on)";
						$query .= " VALUES('$hor_id', '$fec', '$hour', '$i[1]', '$i[0]', NOW())";
						$result2 = mysql_query($query);
						$last_id = mysql_insert_id();
						$data[0] = true;
						break;
					}
				}
			}
		}
	}
	
	$data[1] = $msj[$mensaje];
	$data[2] = $last_id;
	
	header("Content-Type: text/javascript; charset=utf-8");
	
	echo json_encode($data);
	
	@mysql_close($link);

?>