<?php

	require_once('../nucleo/ModeloConect.php');
	class clsactividad extends ModeloConect
	{
		private $idActividad;
		private $nombre;
		private $idTipoActividad;

		function __set($var,$val){
			$this->$var=$val;
		}
		function __get($var){
			return $this->$var;
		}

		function consultar_actividad_inactivos()
		{
			$this->conectar();
			$cont=0;
				$sql="SELECT * FROM tactividad a INNER JOIN t_tipoactividad tp ON a.tipo_actividad=tp.idtipoactividad";
				$pcsql=$this->filtro($sql);
				while($laRow=$this->proximo($pcsql))
				{
					$Fila[$cont][0]=$laRow['codigoActividad'];
					$Fila[$cont][1]=$laRow['nombreact'];
					$Fila[$cont][2]=$laRow['nombretipoa'];
					$Fila[$cont][3]=$laRow['estatusact'];
					$cont++;
				}
			
			$this->desconectar();
			return $Fila;
		}

		function consultar_actividad()
		{
			$this->conectar();
			$cont=0;
				$sql="SELECT codigoActividad,nombreact,tipo_actividad,estatusact FROM tactividad WHERE estatusact='1' ";
				$pcsql=$this->filtro($sql);
				while($laRow=$this->proximo($pcsql))
				{
					$Fila[$cont][0]=$laRow['codigoActividad'];
					$Fila[$cont][1]=$laRow['nombreact'];
					$Fila[$cont][2]=$laRow['tipo_actividad'];
					$Fila[$cont][3]=$laRow['estatusact'];
					$cont++;
				}
			
			$this->desconectar();
			return $Fila;
		}
		function consultar_actividad_id()
		{
			$this->conectar();
				$sql="SELECT * FROM tactividad WHERE codigoActividad='$this->idActividad' ";
				$pcsql=$this->filtro($sql);
				while($laRow=$this->proximo($pcsql))
				{
					$Fila[0]=$laRow['codigoActividad'];
					$Fila[1]=$laRow['nombreact'];
					$Fila[2]=$laRow['tipo_actividad'];
					$Fila[3]=$laRow['estatusact'];
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

		function registrar_actividad()
		{
			$this->conectar();
			$sql="INSERT INTO tactividad (nombreact,tipo_actividad) VALUES (UPPER('".$this->nombre."'),'".$this->idTipoActividad."')";
			$lnHecho=$this->ejecutar($sql);			
			$this->desconectar();
			return $lnHecho;
		}

		function eliminar_actividad()
		{
			$this->conectar();
			$sql="UPDATE tactividad SET estatusact='0' WHERE codigoActividad='$this->idActividad' ";
			$lnHecho=$this->ejecutar($sql);			
			$this->desconectar();
			return $lnHecho;
		}

		function restaurar_actividad()
		{
			$this->conectar();
			$sql="UPDATE tactividad SET estatusact='1' WHERE codigoActividad='$this->idActividad' ";
			$lnHecho=$this->ejecutar($sql);			
			$this->desconectar();
			return $lnHecho;
		}
		
		function editar_actividad()
		{
			$this->conectar();
			$sql="UPDATE tactividad SET nombreact=UPPER('$this->nombre'),tipo_actividad='$this->idTipoActividad' WHERE codigoActividad='$this->idActividad' ";
			$lnHecho=$this->ejecutar($sql);			
			$this->desconectar();
			return $lnHecho;
			//arreglar la dependencia con la tabla tipodeactividad igualmente con las anteriores.
		}
		function listar_tipo_actividad()
		{
			$this->conectar();
				$sql="SELECT * FROM t_tipoactividad WHERE estatustipoa='1' ";
				$pcsql=$this->filtro($sql);
				while($laRow=$this->proximo($pcsql))
				{
					$Fila[]=$laRow;
				}
			
			$this->desconectar();
			return $Fila;
		}
	}
?>
