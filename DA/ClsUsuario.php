<?php

	$file = realpath(dirname(__FILE__)."/../config/Conexion.php");
	require_once($file); 

	class ClsUsuario extends ClsConexion
	{
		
		
		function Get_validar_usuario($usu,$con)
		{
			$this->query = "call cu_Get_validar_usuario('$usu','$con')";
			$this->execute_query();
			$data = $this->rows;
			return $data;
			//return $this->query;
		}

		function Get_listado_permisos_usuario($codUsu)
		{
			$this->query = "call cu_Get_permisos_usuario('$codUsu')";
			$this->execute_query();
			$data = $this->rows;
			return $data;
			//return $this->query;
		}

	}