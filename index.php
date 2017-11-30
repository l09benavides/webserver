<?php

//Para Ejecucion en caso de error
//require "control/Controller_principal.php";
require_once "control/controller_principal.php";

$insIndex = Controller_principal::getInstance();


if(isset($_REQUEST['accion'])){
	//aqui estara el dinamismo
	$opt = $_REQUEST['accion'];

	switch ($opt) {
		case 1:
			$insIndex->openHome();
			break;
		case 2:
			$insIndex->openCatalogo();
			break;
		case 3:
			$insIndex->openReporte();
		break;
		default:
			echo "error";
			break;
	}
}else{
	$insIndex->mostrar();
}

?>