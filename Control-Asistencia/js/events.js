$(document).ready(function(){
		
	/*cuando se inicia la recarga de la pagina*/
	$('#campo').load('pages/asistencia.html')
	
	$('#inicio').css('background-color', 'orange');
	
	$('a').click(function(){
		$('a').removeAttr('style');
		$(this).css('background-color', 'orange');
	});	
	$('#inicio').click(function(){
		$('#campo').load('pages/asistencia.html');
	});
	$('#consultas').click(function(){
		$('#campo').load('pages/consultas.html');
	});
	
});