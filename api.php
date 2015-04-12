<?php
	require_once('jsmin.php');
	$m = $_GET['data'];
	switch($m){
		case "rios":
			$x = $_GET['x'];
			$y = $_GET['y'];
			$posicion = $y."%2C".$x;
			ini_set('display_errors',1);
			// Crear un nuevo recurso cURL
			$ch = curl_init();
			// Establecer URL y otras opciones apropiadas
			curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/fusiontables/v2/query?sql=SELECT%20geometry%2Cdescription%20FROM%201i0pK3KGblo-txpxq6i0wVvPNTuKdkKJEAQLKgtI2%20WHERE%20description%20like%20%27%25MICROBASIN%25%27&key=AIzaSyBMHGwC8zappz9qonjN3EeCZaLPpt6zcFs");
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			// Capturar la URL y pasarla al navegador
			$a = curl_exec($ch);
			echo $a;     
			//echo JSMin::minify($a);
			// Cerrar el recurso cURL y liberar recursos del sistema
			curl_close($ch);
			break;
		case "cuencas":
			$x = $_GET['x'];
			$y = $_GET['y'];
			$posicion = $y."%2C".$x;
			ini_set('display_errors',1);
			// Crear un nuevo recurso cURL
			$ch = curl_init();
			// Establecer URL y otras opciones apropiadas
			curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/fusiontables/v2/query?sql=SELECT%20description%2Cgeometry%20FROM%201FwLZbnuOZVBzh6UDI0ftYKF6lYfpZfkxTzVZCE7p%20WHERE%20ST_INTERSECTS(posicion%2CCIRCLE(LATLNG(".$posicion.")%2C10000))&key=AIzaSyBMHGwC8zappz9qonjN3EeCZaLPpt6zcFs");
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			// Capturar la URL y pasarla al navegador
			$a = curl_exec($ch);
			echo $a;
			// Cerrar el recurso cURL y liberar recursos del sistema
			curl_close($ch);
			break;
	}
?>