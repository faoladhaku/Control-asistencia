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
					$("#nameUser").text("no user");
				}
			});
		</script>
		
	</head>

	<body>

		<div class="cabeza"><b>Assist Control Admin</b> </div>
		
		<div id="barra">
		
			<li><a href="#" id="iniciar">INICIAR</a></li>
			<li><a href="#" id="registro">REGISTROS</a></li>
			<li id="main"><a href="#" id="horario">HORARIOS</a></li>
			<div id="nameUser"></div>
			
		</div>
		
		<div id="campo">
		
		</div>
				
	</body>
	
</html>