<?php
	ini_set("memory_limit","64M");
	
	$arrimagenes= array ();
	
	if(isset($_FILES["myfile"]))
	{
		if(!is_array($_FILES["myfile"]["name"])) //single file
		{
			putenv('GDFONTPATH=' . realpath('.'));
			$arrFecha = getdate();
			$masterDir = __DIR__."/";
			$uploaddir = $masterDir."fotografias/";
			$uploaddirOri = $masterDir."fotografias/originales/";
			$uploadfileOri = $uploaddirOri.basename($_FILES['myfile']['name']);
			$uploadfileWM = $uploaddir.$arrFecha[0].".png";
			$tipo = $_FILES['myfile']['type'];
			$im=null;
			switch($tipo){
				case "image/jpeg":
					$im = imagecreatefromjpeg($_FILES['myfile']['tmp_name']);
					break;
				case "image/png":
					$im = imagecreatefrompng($_FILES['myfile']['tmp_name']);
					break;
				case "image/gif":
					$im = imagecreatefromgif($_FILES['myfile']['tmp_name']);
					break;
				default:
					$im = imagecreatefromjpeg($_FILES['myfile']['tmp_name']);
					break;
			}
			
			if(move_uploaded_file($_FILES['myfile']['tmp_name'], $uploadfileOri)){
				echo $uploadfileOri;
			}else{
				echo "no se pudo cargar archivo";
			}
			}
	    }
		
?>