<?php
	require_once('../nucleo/ModeloConect.php');
	class clsArticulo extends ModeloConect
	{
		private $idArticulo,$nombre,$idTipo_articulo,$estatus;
		function __set($var,$val){
			$this->$var=strtoupper($val);
		}		
		function __get($var){
			return $this->$var;
		}
		

		function consultar_articulo()
		{
			$this->conectar();
			$cont=0;
				$sql="SELECT *,a.nombre AS nombre_a,ta.nombre AS nombre_ta,a.estatus AS estatus_a FROM am_tarticulo a INNER JOIN am_ttipo_articulo ta ON a.idTipo_articulo=ta.idTipo_articulo";
				$pcsql=$this->filtro($sql);
				while($laRow=$this->proximo($pcsql))
				{
					$Fila[$cont][0]=$laRow['idArticulo'];
					$Fila[$cont][1]=$laRow['nombre_a'];
					$Fila[$cont][2]=$laRow['nombre_ta'];
					$Fila[$cont][3]=$laRow['cantidad'];
					$Fila[$cont][4]=$laRow['estatus_a'];
					$cont++;
				}
			
			$this->desconectar();
			return $Fila;
		}

		function consultar_articulo_id()
		{
			$this->conectar();
				$sql="SELECT * FROM am_tarticulo WHERE idArticulo='$this->idArticulo'";
				$pcsql=$this->filtro($sql);
				if($laRow=$this->proximo($pcsql))
				{
					$Fila[0]=$laRow['idArticulo'];
					$Fila[1]=$laRow['nombre'];
					$Fila[2]=$laRow['idTipo_articulo'];
					$Fila[3]=$laRow['cantidad'];
					$Fila[4]=$laRow['estatus'];
				}
			
			$this->desconectar();
			return $Fila;
		}

		function registrar_articulo()
		{
			$this->conectar();
			$sql="INSERT INTO am_tarticulo (nombre,idTipo_articulo,cantidad,estatus) VALUES ('$this->nombre','$this->idTipo_articulo','0','1')";
			$lnHecho=$this->ejecutar($sql);			
			$this->desconectar();
			return $lnHecho;
		}

		function eliminar_articulo()
		{
			$this->conectar();
			$sql="UPDATE am_tarticulo SET estatus='0' WHERE idArticulo='$this->idArticulo' ";
			$lnHecho=$this->ejecutar($sql);			
			$this->desconectar();
			return $lnHecho;
		}

		function restaurar_articulo()
		{
			$this->conectar();
			$sql="UPDATE am_tarticulo SET estatus='1' WHERE idArticulo='$this->idArticulo' ";
			$lnHecho=$this->ejecutar($sql);			
			$this->desconectar();
			return $lnHecho;
		}

		function editar_articulo()
		{
			$this->conectar();
			$sql="UPDATE am_tarticulo SET nombre='$this->nombre',idTipo_articulo='$this->idTipo_articulo',cantidad='$this->cantidad' WHERE idArticulo='$this->idArticulo' ";
			$lnHecho=$this->ejecutar($sql);			
			$this->desconectar();
			return $lnHecho;
		}
		function consultar_tipo_articulo()
		{
			$this->conectar();
				$sql="SELECT * FROM am_ttipo_articulo WHERE estatus='1';";
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