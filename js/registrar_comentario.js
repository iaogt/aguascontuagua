$(document).ready(function(){
			$('#enviar').on('click', function(event){
					//alert(files+data);
					event.preventDefault();
				    var param = {'comentario':$('#comentario').val(),'img':window.dataimg, 'cuenca': window.idCuenca};
				    var row = $('#panel_comentario');

					$.ajax({
						type: 'post',
						url: 'json/add_report.php',
						data: param,
						dataType: 'json',						
						success: function(response){

							window.dataimg  =  window.dataimg.replace("/var/www/html/", "http://webymovil.com/");

							var dv = '<div class="row aporte">';
					    		dv += '<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">';
					    		dv += $('#comentario').val();
					    		dv += '</div>';
					    		dv += '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">';
					    		dv += '<img src="'+ window.dataimg +'" height="100px" class="fotoCom">';
					    		dv += '</div>';
					    		dv += '</div>';
							row.append(dv);

						},		
						error: function (obj, error, objError){           
		        				alert('error 405');
		        		}				
					}); //Fin AjaX		

			});
});