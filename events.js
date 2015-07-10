			$(document).ready(function(){
				/*$('input:radio[name="genero"]').change(function(){
					alert($(this).val());
				});*/
				/*$('#limpiar').click(function(){
					$('.datos').val("");
					$('input:radio[name="genero"]').prop("checked", false);
				});*/
				$('#iniciar').click(function(){
					$('#campo').html("");
					$('#campo').load('login.html');
					
				});
			});