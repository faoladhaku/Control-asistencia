function digiClock (){
    var crTime = new Date ( );
    var crHrs = crTime.getHours ( );
    var crMns = crTime.getMinutes ( );
    var crScs = crTime.getSeconds ( );
    crMns = ( crMns < 10 ? "0" : "" ) + crMns;
    crScs = ( crScs < 10 ? "0" : "" ) + crScs;
	crHrs = ( crHrs < 10 ? "0" : "" ) + crHrs;
    var crTimeString = crHrs + ":" + crMns + ":" + crScs;
 
    $("#clock").html(crTimeString);
 
}

jQuery(function($){
	$.datepicker.regional['es'] = {
		inline: true,
		closeText: 'Cerrar',
		prevText: '&#x3c;Ant',
		nextText: 'Sig&#x3e;',
		currentText: 'Hoy',
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
		'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
		'Jul','Ago','Sep','Oct','Nov','Dic'],
		dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
		dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
		weekHeader: 'Sm',
		dateFormat: 'dd/mm/yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		showOtherMonths: true,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['es']);
});

$(document).ready(function(){
	
	setInterval('digiClock()', 1000);
	
	$('#calendar').datepicker();
	
	/*cuando se inicia la recarga de la pagina*/
	$('#campo').load('pages/asistencia.html')
	
	$('#inicio').css('background-color', '8B0000');
	
	$('a').click(function(){
		$('a').removeAttr('style');
		$(this).css('background-color', '8B0000');
	});	
	$('#inicio').click(function(){
		$('#campo').load('pages/asistencia.html');
	});
	$('#consultas').click(function(){
		$('#campo').load('pages/consultas.html');
	});
	$('#horario').click(function(){
		$('#campo').load('pages/horarioDoc.html');
	});
	
});