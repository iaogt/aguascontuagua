<?php
	include ('../config/db.php');
	if(isset($_POST['idrio'])){
			$rio = $_POST['idrio'];
			/*$cuenca = $_POST['cuenca'];*/
			$ip_usuario = $_POST['ip_usuario'];
				$pregunta1 = $_POST['options1'];
				$pregunta2 = $_POST['options2'];
				$pregunta3 = $_POST['options3'];
				$pregunta4 = $_POST['options4'];
				$pregunta5 = $_POST['options5'];

			$sql= "INSERT INTO contaminacion(rio, ip_usuario, resp1, resp2, resp3, resp4, resp5)
					VALUES('$rio', '$ip_usuario', $pregunta1, $pregunta2, $pregunta3, $pregunta4, $pregunta5)";
			
			$result = $con->query($sql);		
			
			
			if($result) /* VErificar si se realizo correctamente la insersion de los datos */
			{				
				echo 1;
			}
			else {
				echo 0;
			}
	}
?>