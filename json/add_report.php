<?php
	include ('../config/db.php');
	if(isset($_POST['comentario'])){
		if(isset($_POST['img'])){
			$img = $_POST['img'];
			$coment = $_POST['comentario'];
			$cuenca = $_POST['cuenca'];
			$sql= "INSERT INTO reporte(cuenca, comentario, ruta_imagen) 
			VALUES('$cuenca', '$coment', '$img')";
			$result = $con->query($sql);			
			
			if($result) /* VErificar si se realizo correctamente la insersion de los datos */
			{
				echo 1;
			}else{
				echo 0;
			}
		}
	}
?>