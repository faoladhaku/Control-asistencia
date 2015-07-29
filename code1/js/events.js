function clickSignIn() {
    $('#main_form').load('pages/signin.html');	
	changeSubMenu();
}

function clickdocente() {
    $('#main_form').load('pages/docente.html');
	changeSubMenu();
}

function clickSignOut() {
    $('#main_form').load('pages/signout.html');	
	changeSubMenu();
}

function clickcarrera() {
	$('#main_form').load('pages/carrera.html');
	changeSubMenu();
}
function clickcurso() {
	$('#main_form').load('pages/curso.html');
	changeSubMenu();
}

function clickSearchSolutions() {
	$('#main_form').load('pages/buscar.html');
	changeSubMenu();
}

function changeSubMenu() {
	$('#barra_lateral a').click(function(){
		$('#barra_lateral a').removeAttr('style');
		$(this).css('background-color', 'orange');
	});
}

$(document).ready(function(){
		/*$('input:radio[name="genero"]').change(function(){
			alert($(this).val());
		});*/
		/*$('#limpiar').click(function(){
			$('.datos').val("");
			$('input:radio[name="genero"]').prop("checked", false);
		});*/
		/*$('#iniciar').click(function(){
			$('#barra').click(function(){
				$('#barra li').css("background-color", 'red')
			});
			$('#campo').html("");
			$('#campo').load('login.html');
			$
			
		});*/
		
	/*cuando se inicia la recarga de la pagina*/
	$('#campo').load('pages/search.html', function(responseTxt, statusTxt, xhr){
		if(statusTxt == "success")
			clickSearchSolutions();
			$('#main_lateral').css('background-color', '#13551f');
		if(statusTxt == "error")
			alert("Error: " + xhr.status + ": " + xhr.statusText);
	});
	$('#main').css('background-color', '#13551f');
	
	$('a').click(function(){
		$('a').removeAttr('style');
		$(this).css('background-color', 'orange');
	});	
	$('#iniciar').click(function(){
		$('#campo').load('pages/login.html', function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success")
				clickSignIn();
				$('#main_lateral').css('background-color', '#13551f');
			if(statusTxt == "error")
				alert("Error: " + xhr.status + ": " + xhr.statusText);
		});
	});
	$('#asistencia').click(function(){
		$('#campo').load('pages/asistencia.html', function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success")
				clickSolutions();
				$('#main_lateral').css('background-color', '#13551f');
			if(statusTxt == "error")
				alert("Error: " + xhr.status + ": " + xhr.statusText);
		});
	});
	$('#registro').click(function(){
		$('#campo').load('pages/registration.html', function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success")
				clickSolutions();
				$('#main_lateral').css('background-color', '#13551f');
			if(statusTxt == "error")
				alert("Error: " + xhr.status + ": " + xhr.statusText);
		});
	});
	/*$('#codigo').keyup(function(e){
		if(e.keyCode == 13)
		{
			var text= prompt("TEMA", "Ingrese el tema");
		}
	});*/
	
});