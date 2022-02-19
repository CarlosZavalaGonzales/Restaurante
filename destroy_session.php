<?php

	session_cache_limiter('nocache,private');
	session_name('covigym');
	session_start();

	/*
		$file23 = realpath(dirname(__FILE__)."/DA/ClsUsuario.php");
		require_once($file23);
		$objDatos =  new ClsUsuario();

		$resultado1 = $objDatos->Set_cerrar_sesion_usuario($_SESSION['codUsu']);
	*/
	//echo $resultado1;
	//session_cache_limiter('nocache,private');
	//session_name('covigym');
	//session_start();

	session_destroy();
	session_commit();

	//header('Refresh: '.'1');
	header('Location: index.php');

?>