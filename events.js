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
					
				});
			});*/
			
			$('#iniciar').click(function(){
				$('#barra li #iniciar' ).css('background', 'green')
					$('#login').animate({
							right: '250px',
					})
						$('#campo').load('login.html');
			
			});
			$('#base').click(function(){});
			
			$('#codigo').keyup(function(e){
				if(e.keyCode == 13)
				{
					var text= prompt("TEMA", "Ingrese el tema");
				}
			});
		});
		
			
			
			
