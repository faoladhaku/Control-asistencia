<!doctype html5>
<html> 

	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/jquery-ui.css"> 
		<script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
		<script src="js/events.js" type="text/javascript"></script>
		
		<script language="javascript">
			$(document).ready(function(){
				<?php 
					session_start(); $user = "";
					if(isset($_SESSION['user'])){ $user = $_SESSION['user']; }
				?>
				var $_user = '<?php echo $user; ?>';
				if($_user != ""){
					$("#nameUser").text($_user);
				}else{
					$("#nameUser").text("usuario no logueado");
				}
			});
		</script>
		
	</head>

	<body>

		<header><b>Control de Asistencia  Administrador</b> </header>
		
		<nav id="barra">
		
			<a class="main" href="#" id="iniciar">INICIAR</a>
			<a href="#" id="registro">REGISTROS</a>
			<a href="#" id="horario">HORARIOS</a>
			<div id="nameUser"></div>
			<div id="marca"></div>
			
		</nav>
		
		<section id="campo">
		
		</section>
				
	</body>
	
</html>