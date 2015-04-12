<?php
    $Servidor = "heiferconsult.cpj8nez9bcwf.us-west-2.rds.amazonaws.com";
    $Usuario = "spaceapps";
    $Pass = "spaceapps";
    $Bd="spaceapps";
	
	
	$con = mysqli_connect($Servidor,$Usuario,$Pass, $Bd) or die(mysql_error());
		
	if(mysqli_connect_errno()) return;

?>