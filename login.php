<?php 

	$file22 = realpath(dirname(__FILE__)."/DA/ClsUsuario.php");
	require_once($file22);
	$objDatos =  new ClsUsuario();

	$validar = 0;
	$usuario = '';
	$contra = '';
	
	if ($_POST['usuario']) {
		$usuario =str_replace(' ', '', trim($_POST['usuario']) ); 
	}else{
		$validar++;
	}

	if ($_POST['contra']) {
		$contra =$_POST['contra'];
	}else{
		$validar++;
	}

	if ($validar == 0) {
		$resultado1 = $objDatos->Get_validar_usuario($usuario,md5($contra));

		if (count($resultado1) > 0) {

			if ($resultado1[0]['estado'] == 'ok') {
				session_cache_limiter('nocache,private');
				session_name('covigym');
				session_start();

				$_SESSION['codUsu'] = $resultado1[0]['cPerCodigo'];
				$_SESSION['nomUsu'] = ucwords($resultado1[0]['nombre']);
				$_SESSION['perfil'] = -1;

				echo json_encode("legueo");
			}else{
				echo json_encode("error");
			}

		} else {
			echo json_encode("error");
		}
	}else{
		echo json_encode("error");
	}

	

?>