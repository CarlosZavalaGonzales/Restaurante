<?php
	$file = realpath(dirname(__FILE__)."/../config/Conexion.php");
	require_once($file); 

	class ClsParametro extends ClsConexion
	{
		
		function Get_parametro($codClase, $parCodigo = 0) // ok
		{
			$this->query = "call cu_Get_parametro($codClase,$parCodigo)";
			$this->execute_query();
			$data = $this->rows;
			return $data;
			//return $this->query;
		}

		function Get_parametro_Especifico($codClase, $parCodigo = 0) // ok
		{
			$this->query = "call cu_Get_parametro_Especifico($codClase,$parCodigo)";
			$this->execute_query();
			$data = $this->rows;
			return $data;
			//return $this->query;
		}

		function Set_Orden_Mesa($nMesa, $nSubCategoria) 
		{
			$this->query = "call cu_Set_Orden_Mesa($nMesa, $nSubCategoria)";
			$this->execute_query();
			$data = $this->rows;
			return $data;
			//return $this->query;
		}



	}
