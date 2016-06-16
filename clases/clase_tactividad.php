<?php

	require_once('../nucleo/ModeloConect.php');
	class clstactividad extends ModeloConect
	{
		private $lcIdtactividad;
		private $lcNombre;

		function set_tactividad($pcIdtactividad)
		{
			$this->lcIdtactividad=$pcIdtactividad;
		}

		function set_Nombre($pcNombre)
		{
			$this->lcNombre=$pcNombre;
		}


		function consultar_tactividad_inactivos()
		{
			$this->conectar();
			$cont=0;
				$sql="SELECT idtipoactividad,nombretipoa,estatustipoa FROM t_tipoactividad ";
				$pcsql=$this->filtro($sql);
				while($laRow=$this->proximo($pcsql))
				{
					$Fila[$cont][0]=$laRow['idtipoactividad'];
					$Fila[$cont][1]=$laRow['nombretipoa'];
					$Fila[$cont][2]=$laRow['estatustipoa'];
					$cont++;
				}
			
			$this->desconectar();
			return $Fila;
		}

		function consultar_tactividad()
		{
			$this->conectar();
			$cont=0;
				$sql="SELECT idtipoactividad,nombretipoa,estatustipoa FROM t_tipoactividad  ";
				$pcsql=$this->filtro($sql);
				while($laRow=$this->proximo($pcsql))
				{
					$Fila[$cont][0]=$laRow['idtipoactividad'];
					$Fila[$cont][1]=$laRow['nombretipoa'];
					$Fila[$cont][2]=$laRow['estatustipoa'];
					$cont++;
				}
			
			$this->desconectar();
			return $Fila;
		}

		function consultar_tactividad_id()
		{
			$this->conectar();
			$cont=0;
				$sql="SELECT idtipoactividad,nombretipoa,estatustipoa FROM t_tipoactividad WHERE idtipoactividad='$this->lcIdtactividad' ";
				$pcsql=$this->filtro($sql);
				while($laRow=$this->proximo($pcsql))
				{
					$Fila[0]=$laRow['idtipoactividad'];
					$Fila[1]=$laRow['nombretipoa'];
					$Fila[2]=$laRow['estatustipoa'];
					$cont++;
				}
			
			$this->desconectar();
			return $Fila;
		}

		//function consultar_tactividad()
		//{
			//$this->conectar();
				//$sql="SELECT idtipoactividad,nombretipoa,descripciontipoa FROM t_tipoactividad WHERE idtipoactividad='$this->lcIdtactividad'";
				//$pcsql=$this->filtro($sql);
				//if($laRow=$this->proximo($pcsql))
				//{
					//$Fila[0]=$laRow['idtipoactividad'];
					//$Fila[0]=$laRow['nombretipoa'];
					//$Fila[1]=$laRow['descripciontipoa'];
				//}
			
			//$this->desconectar();
			//return $Fila;
		//}

		//function consultar_dependencia()
		//{
			//$this->conectar();
			//$dependencia=false;			
				//$sql="SELECT * FROM tlocalidad WHERE tmunicipio_municipio='$this->lcIdMunicipio' ";
				//$pcsql=$this->filtro($sql);
				//if($laRow=$this->proximo($pcsql))
				//{
					//$dependencia=true;
				//}
			
			//$this->desconectar();
			//return $dependencia;
		//}

		function registrar_tactividad()
		{
			$this->conectar();
			$sql="INSERT INTO t_tipoactividad (nombretipoa)VALUES(UPPER('$this->lcNombre'))";
			$lnHecho=$this->ejecutar($sql);			
			$this->desconectar();
			return $lnHecho;
		}

		function eliminar_tactividad()
		{
			$this->conectar();
			$sql="UPDATE t_tipoactividad SET estatustipoa='0' WHERE idtipoactividad='$this->lcIdtactividad' ";
			$lnHecho=$this->ejecutar($sql);			
			$this->desconectar();
			return $lnHecho;
		}

		function restaurar_tactividad()
		{
			$this->conectar();
			$sql="UPDATE t_tipoactividad SET estatustipoa='1' WHERE idtipoactividad='$this->lcIdtactividad' ";
			$lnHecho=$this->ejecutar($sql);			
			$this->desconectar();
			return $lnHecho;
		}
		
		function editar_tactividad()
		{
			$this->conectar();
			$sql="UPDATE t_tipoactividad SET nombretipoa=UPPER('$this->lcNombre') WHERE idtipoactividad='$this->lcIdtactividad' ";
			$lnHecho=$this->ejecutar($sql);			
			$this->desconectar();
			return $lnHecho;
		}
	}
?>