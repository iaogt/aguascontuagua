$(document).ready(function(){
	$('#enviar1').on('click', function(event){
		//alert(files+data);

		event.preventDefault();	

		console.log("elderzito dio click aquí...");

		var param = {'valor':$('#opcion').val(),'cuenca': window.idCuenca,'ip_usuario': window.IpUsuario};
		$.ajax({
				type: 'post',
				url: 'json/add_def.php',
				data: param,
				dataType: 'json',	
				success: function(response){
					console.log(response);
					//alert('Guardado Exitosamente!');
				},		
				error: function (obj, error, objError){           
			        alert('error 405');
			    }		
			});

		
	});
});