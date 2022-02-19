<?php 

	session_cache_limiter('nocache,private');
	session_name('covigym');
	session_start();

	require "../DA/ClsParametro.php";
	$objDatos =  new ClsParametro();


	if ($_POST['tipoConsulta'] == "listarParametro") { 

		$resultado1 = $objDatos->Get_parametro($_POST['codClase'],$_POST['codPar']);
		echo json_encode($resultado1, JSON_FORCE_OBJECT);
	}	
	if ($_POST['tipoConsulta'] == "registrarOrden") { 

		$resultado1 = $objDatos->Set_Orden_Mesa($_POST['nMesa'],$_POST['nSubCategoria']);
		echo json_encode($resultado1, JSON_FORCE_OBJECT);
	}

	if ($_POST['tipoConsulta'] == "listarParametroEspecifico") { 

		$resultado1 = $objDatos->Get_parametro_Especifico($_POST['codClase'],$_POST['codPar']);
		echo json_encode($resultado1, JSON_FORCE_OBJECT);
	}

	
 ?>