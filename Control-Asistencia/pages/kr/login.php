<?php 
	session_start();

	$link = mysql_connect("localhost", "root", "") or die("No se pudo conectar a la db");
	
	mysql_select_db("trainingcode", $link) or die("No se encontro db");
	
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	
	$query = "SELECT * FROM user WHERE nick='$user' AND pass='$pass'";
	
	$result = mysql_query($query) or die(mysql_error());
	
	$num_row = mysql_num_rows($result);
	
	$row = mysql_fetch_array($result);
	
	if( $num_row >=1 ) { 
		$_SESSION['user'] = $row['nick'];
		echo json_encode($_SESSION['user']);
	}
	else{
		echo json_encode("na-ha-ha, no estas invitado a esta fiesta");
	}
	
?>