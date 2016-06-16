<?php
	require_once('../nucleo/ModeloConect.php');
	class clsTipo_articulo extends ModeloConect
	{
		private $idTipo_articulo,$nombre,$estatus;
		function __set($var,$val){
			$this->$var=strtoupper($val);
		}		
		function __get($var){
			return $this->$var;
		}
		

		function consultar_tipo_articulo()
		{
			$this->conectar();
			$cont=0;
				$sql="SELECT idTipo_articulo,nombre,estatus FROM am_ttipo_articulo ";
				$pcsql=$this->filtro($sql);
				while($laRow=$this->proximo($pcsql))
				{
					$Fila[$cont][0]=$laRow['idTipo_articulo'];
					$Fila[$cont][1]=$laRow['nombre'];
					$Fila[$cont][2]=$laRow['estatus'];
					$cont++;
				}
			
			$this->desconectar();
			return $Fila;
		}

		function consultar_dependencia()
		{
			$this->conectar();
			$dependencia=false;			
				$sql="SELECT * FROM am_tarticulo WHERE idTipo_articulo='$this->idTipo_articulo';";
				$pcsql=$this->filtro($sql);
				if($laRow=$this->proximo($pcsql))
				{
					$dependencia=true;
				}
			
			$this->desconectar();
			return $dependencia;
		}

		function consultar_tipo_articulo_id()
		{
			$this->conectar();
				$sql="SELECT idTipo_articulo,nombre FROM am_ttipo_articulo WHERE idTipo_articulo='$this->idTipo_articulo'";
				$pcsql=$this->filtro($sql);
				if($laRow=$this->proximo($pcsql))
				{
					$Fila[0]=$laRow['idTipo_articulo'];
					$Fila[1]=$laRow['nombre'];
				}
			
			$this->desconectar();
			return $Fila;
		}

		function registrar_tipo_articulo()
		{
			$this->conectar();
			$sql="INSERT INTO am_ttipo_articulo (nombre,estatus) VALUES ('$this->nombre','1')";
			$lnHecho=$this->ejecutar($sql);			
			$this->desconectar();
			return $lnHecho;
		}

		function eliminar_tipo_articulo()
		{
			$this->conectar();
			$sql="UPDATE am_ttipo_articulo SET estatus='0' WHERE idTipo_articulo='$this->idTipo_articulo' ";
			$lnHecho=$this->ejecutar($sql);			
			$this->desconectar();
			return $lnHecho;
		}

		function restaurar_tipo_articulo()
		{
			$this->conectar();
			$sql="UPDATE am_ttipo_articulo SET estatus='1' WHERE idTipo_articulo='$this->idTipo_articulo' ";
			$lnHecho=$this->ejecutar($sql);			
			$this->desconectar();
			return $lnHecho;
		}

		function editar_tipo_articulo()
		{
			$this->conectar();
			$sql="UPDATE am_ttipo_articulo SET nombre='$this->nombre' WHERE idTipo_articulo='$this->idTipo_articulo' ";
			$lnHecho=$this->ejecutar($sql);			
			$this->desconectar();
			return $lnHecho;
		}
	}
?>