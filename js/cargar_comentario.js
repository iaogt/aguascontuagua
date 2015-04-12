	var idCuenca = "CuencaNo1";
	var idRio = "rio2";
	var IpUsuario = "111.111.111.111";

$(document).ready(function(){

	$.getJSON('json/getip.php', function(data){
		window.IpUsuario = data.ip;
	});

	$('#princiReport').on('click', function(event){
		$('.aporte').fadeOut("slow", function(){
					$('.aporte').remove();
				});
		
		event.preventDefault();
		var param = {'cuenca': window.idCuenca};
		var row = $('#panel_comentario');
		$.ajax({
			type: 'post',
			url: 'json/obtener_comentario.php',
			data: param,
			dataType: 'json',
			beforeSend: function(){
				
			},						
			success: function(response){
				if(response[0].state=1){
					$.each(response, function(i, item){
						if(i>0){
							var im = item;
							var dv = '<div class="row aporte">';
					    		dv += '<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">';
					    		dv += item.comentario;
					    		dv += '</div>';
					    		dv += '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">';
					    		dv += '<img src="'+ item.imagen +'" height="100px" class="fotoCom">';
					    		dv += '</div>';
					    		dv += '</div>';
							row.append(dv);
						}
					});
				}
			},		
			error: function (obj, error, objError){           
		    	alert('error 405');
		    }				
		}); //Fin AjaX		
	});
});