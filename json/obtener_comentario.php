<?php
	include ('../config/db.php');
	if(isset($_POST['cuenca'])){
		$cuenca = $_POST['cuenca'];
		$sql= "SELECT id, comentario, ruta_imagen FROM reporte WHERE cuenca='$cuenca'";
		$result=$con->query($sql);
		$res[] = array('state'=>1);
		if($result){
			while($row = mysqli_fetch_object($result)){
				$img = $row->ruta_imagen;
				$img = str_replace("/var/www/html/", "http://webymovil.com/", $img);

				$res[] = array('id'=>($row->id),
					'comentario'=>($row->comentario),
					'imagen'=>($img));
			}
		}
		else {
			$res[] = array('state'=>'0');
		}
	}
	mysqli_close($con);
	echo json_encode($res);
?>