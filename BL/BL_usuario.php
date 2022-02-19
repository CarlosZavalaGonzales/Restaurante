<?php 

	session_cache_limiter('nocache,private');
	session_name('covigym');
	session_start();

	require "../DA/ClsUsuario.php";
	$objDatos =  new ClsUsuario();


	if ($_POST['tipoConsulta'] == "verificarPersonaDni") { 

		$resultado1 = $objDatos->Get_verificar_persona_dni($_POST['dni']); 
		echo json_encode($resultado1, JSON_FORCE_OBJECT);
	}

	if ($_POST['tipoConsulta'] == "actMenus") { 
		$_SESSION['perfil'] = $_POST['perfil'];
		echo "ok";
	}

	
 ?>