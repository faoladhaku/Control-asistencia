function clickSignIn() {
    $('#main_form').load('pages/signin.html');	
	changeSubMenu();
}

function clickSignOut() {
    $('#main_form').load('pages/signout.html');	
	changeSubMenu();
}

function clickdocente() {
	if(checkSession()){
		$('#main_form').load('pages/docente.html');
	}
	changeSubMenu();
}

function clickcarrera() {
	if(checkSession()){
		$('#main_form').load('pages/carrera.html');
	}
	changeSubMenu();
}
function clickcurso() {
	if(checkSession()){
		$('#main_form').load('pages/curso.html');
	}
	changeSubMenu();
}

function clickCreateHorario() {
	if(checkSession()){
		$('#main_form').load('pages/createHorario.html');
	}
	changeSubMenu();
}

function clickRecoverHorario() {
	if(checkSession()){
		$('#main_form').load('pages/recoverHorario.html');
	}
	changeSubMenu();
}

function changeSubMenu() {
	$('#barra_lateral li').click(function(){
		$('#barra_lateral li').removeAttr('style');
		$(this).css('background-color', '#0f3e96');
	});
}

function checkSession(){
	if($("#nameUser").text() != "no user"){
		return true;
	}
	$('#main_form').load('pages/msj_nologin.html');
	return false;
}

$(document).ready(function(){
		
	/*cuando se inicia la recarga de la pagina*/
	$('#campo').load('pages/horario.html', function(responseTxt, statusTxt, xhr){
		if(statusTxt == "success")
			clickCreateHorario();
			$('#main_lateral').css('background-color', '#0f3e96');
		if(statusTxt == "error")
			alert("Error: " + xhr.status + ": " + xhr.statusText);
	});
	$('#main').css('background-color', '#0f3e96');
	
	$('li').click(function(){
		$('li').removeAttr('style');
		$(this).css('background-color', '#0f3e96');
	});	
	$('#iniciar').click(function(){
		$('#campo').load('pages/login.html', function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success")
				clickSignIn();
				$('#main_lateral').css('background-color', '#0f3e96');
			if(statusTxt == "error")
				alert("Error: " + xhr.status + ": " + xhr.statusText);
		});
	});
	$('#horario').click(function(){
		$('#campo').load('pages/horario.html', function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success")
				clickCreateHorario();
				$('#main_lateral').css('background-color', '#0f3e96');
			if(statusTxt == "error")
				alert("Error: " + xhr.status + ": " + xhr.statusText);
		});
	});
	$('#registro').click(function(){
		$('#campo').load('pages/registration.html', function(responseTxt, statusTxt, xhr){
			if(statusTxt == "success")
				clickdocente();
				$('#main_lateral').css('background-color', '#0f3e96');
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