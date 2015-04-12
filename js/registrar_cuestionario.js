$(document).ready(function(){
	$('#button1').on('click', function(event){
		//alert(files+data);

		event.preventDefault();	
		console.log('Valor btn1:' + $('input[name="options1"]:checked').val());

		var op1 = document.querySelector('input[name="options1"]:checked').value;
		var op2 = document.querySelector('input[name="options2"]:checked').value;
		var op3 = document.querySelector('input[name="options3"]:checked').value;
		var op4 = document.querySelector('input[name="options4"]:checked').value;
		var op5 = document.querySelector('input[name="options5"]:checked').value;

		$.ajax({
				type: 'post',
				url: 'json/add_cont.php',
				data: {'idrio': window.idRio, 'ip_usuario': window.IpUsuario, 'options1': op1, 'options2': op2, 'options3': op3, 'options4': op4, 'options5': op5 },
				dataType: 'json',	
				success: function(response){
					console.log('Guardado Exitosamente!');
				},		
				error: function (obj, error, objError){           
			        console.log('error 405');
			    }		
			});

		
	});
});