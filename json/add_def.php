<?php
	include ('../config/db.php');
	if(isset($_POST['valor'])){
			$valor = $_POST['valor'];
			$cuenca = $_POST['cuenca'];
			$ip_usuario = $_POST['ip_usuario'];
			$sql= "INSERT INTO deforestacion(cuenca, ip_usuario, valoracion) 
			VALUES('$cuenca', '$ip_usuario', $valor)";
			$result = $con->query($sql);			
			
			if($result) /* VErificar si se realizo correctamente la insersion de los datos */
			{
				echo 1;
			}else{
				echo 0;
			}
	}
?>