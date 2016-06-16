<?php
	require_once('../nucleo/ModeloConect.php');
	class clsDonacion extends ModeloConect
	{
		private $idDonacion,$idPersona,$idEmpresa,$fecha_donacion,$estatus,/*PARA EL REPORTE->*/$fecha_fin;
		//DETALLE
		private $idArticulo,$serial_factura,$cantidad;
		function __set($var,$val){
			$this->$var=strtoupper($val);
		}		
		function __get($var){
			return $this->$var;
		}
		

		function consultar_donacion()
		{
			$this->conectar();
			$cont=0;
				$sql="SELECT *,DATE_FORMAT(d.fecha_donacion,'%d-%m-%Y') AS fecha_a,d.estatus AS estatus_d FROM am_tdonacion d INNER JOIN am_tempresa e ON d.idEmpresa=e.idEmpresa INNER JOIN am_tpersona p ON d.idPersona=p.idPersona WHERE d.estatus='1'";
				$pcsql=$this->filtro($sql);
				while($laRow=$this->proximo($pcsql))
				{
					$Fila[$cont][0]=$laRow['idDonacion'];
					$Fila[$cont][1]=$laRow['cedula'];
					$Fila[$cont][2]=$laRow['rif'];
					$Fila[$cont][3]=$laRow['primer_nombre']." ".$laRow['segundo_nombre'];
					$Fila[$cont][4]=$laRow['primer_apellido']." ".$laRow['segundo_apellido'];
					$Fila[$cont][5]=$laRow['fecha_a'];
					$Fila[$cont][6]=$laRow['estatus_d'];
					$Fila[$cont][7]=$laRow['nombre'];
					$cont++;
				}
			
			$this->desconectar();
			return $Fila;
		}

		function consultar_donacion_id()
		{
			$this->conectar();
				$sql="SELECT *,DATE_FORMAT(d.fecha_donacion,'%d-%m-%Y') AS fecha_a,d.estatus AS estatus_d FROM am_tdonacion d WHERE d.idDonacion='$this->idDonacion'";
				$pcsql=$this->filtro($sql);
				if($laRow=$this->proximo($pcsql))
				{
					$Fila[0]=$laRow['idDonacion'];
					$Fila[1]=$laRow['idPersona'];
					$Fila[2]=$laRow['idEmpresa'];
					$Fila[4]=$laRow['fecha_a'];
					$Fila[5]=$laRow['estatus_d'];
				}
			
			$this->desconectar();
			return $Fila;
		}
		function consultar_donacion_detalle_id()
		{
			$this->conectar();
			$cont=0;
				$sql="SELECT *,dd.cantidad AS cantidad_dd FROM am_tddonacion dd INNER JOIN am_tarticulo a ON dd.idArticulo=a.idArticulo WHERE dd.idDonacion='$this->idDonacion' ";
				$pcsql=$this->filtro($sql);
				while($laRow=$this->proximo($pcsql))
				{
					$Fila[$cont][0]=$laRow['idArticulo'];
					$Fila[$cont][1]=$laRow['nombre'];
					$Fila[$cont][2]=$laRow['serial_factura'];
					$Fila[$cont][3]=$laRow['cantidad_dd'];
					$cont++;
				}
			
			$this->desconectar();
			return $Fila;
		}
		function registrar_donacion()
		{
			$this->conectar();
			$query=$this->filtro("SELECT cantidad,idArticulo FROM am_tddonacion WHERE idDonacion='$this->idDonacion'");
			while($a=$this->proximo($query)){
				$this->ejecutar("UPDATE am_tarticulo SET cantidad=cantidad-".$a["cantidad"]." WHERE idArticulo='".$a["idArticulo"]."'; "); 
			}
			$this->ejecutar("DELETE FROM am_tdonacion WHERE idDonacion='$this->idDonacion'");
			$sql="INSERT INTO am_tdonacion (idPersona,idEmpresa,fecha_donacion,estatus) VALUES ('$this->idPersona','$this->idEmpresa',NOW(),'1')";
			$lnHecho=$this->ejecutar($sql);			
			$query=$this->filtro("SELECT MAX(idDonacion) AS id FROM am_tdonacion");
			if($a=$this->proximo($query)){
				$this->idDonacion = $a["id"];
			}

			$this->desconectar();
			return $this->idDonacion;
		}
		function registrar_donacion_detalle()
		{
			$this->conectar();
			$sql="INSERT INTO am_tddonacion (idDonacion,idArticulo,serial_factura,cantidad) VALUES ('$this->idDonacion','$this->idArticulo','$this->serial_factura','$this->cantidad')";
			$lnHecho=$this->ejecutar($sql);
			$this->ejecutar("UPDATE am_tarticulo SET cantidad=cantidad+$this->cantidad WHERE idArticulo='$this->idArticulo' ");			
			$this->desconectar();
			return $lnHecho;
		}
		function eliminar_donacion()
		{
			$this->conectar();
			$sql="UPDATE am_tdonacion SET estatus='0' WHERE idDonacion='$this->idDonacion' ";
			$query=$this->filtro("SELECT cantidad,idArticulo FROM am_tddonacion WHERE idDonacion='$this->idDonacion'");
			while($a=$this->proximo($query)){
				$this->ejecutar("UPDATE am_tarticulo SET cantidad=cantidad-".$a["cantidad"]." WHERE idArticulo='".$a["idArticulo"]."'; "); 
			}
			$lnHecho=$this->ejecutar($sql);			
			$this->desconectar();
			return $lnHecho;
		}

		function restaurar_donacion()
		{
			$this->conectar();
			$sql="UPDATE am_tdonacion SET estatus='1' WHERE idDonacion='$this->idDonacion' ";
			$query=$this->filtro("SELECT cantidad,idArticulo FROM am_tddonacion WHERE idDonacion='$this->idDonacion'");
			while($a=$this->proximo($query)){
				$this->ejecutar("UPDATE am_tarticulo SET cantidad=cantidad+".$a["cantidad"]." WHERE idArticulo='".$a["idArticulo"]."'; "); 
			}
			$lnHecho=$this->ejecutar($sql);			
			$this->desconectar();
			return $lnHecho;
		}
		function consultar_empresa()
		{
			$this->conectar();
				$sql="SELECT * FROM am_tempresa WHERE estatus='1';";
				$pcsql=$this->filtro($sql);
				while($laRow=$this->proximo($pcsql))
				{
					$Fila[]=$laRow;
				}
			
			$this->desconectar();
			return $Fila;
		}
		function consultar_empresa_id()
		{
			$this->conectar();
				$sql="SELECT * FROM am_tempresa WHERE idEmpresa='$this->idEmpresa';";
				$pcsql=$this->filtro($sql);
				while($laRow=$this->proximo($pcsql))
				{
					$Fila[]=$laRow;
				}
			
			$this->desconectar();
			return $Fila;
		}
		function consultar_persona()
		{
			$this->conectar();
				$sql="SELECT * FROM am_tpersona WHERE estatus='1';";
				$pcsql=$this->filtro($sql);
				while($laRow=$this->proximo($pcsql))
				{
					$Fila[]=$laRow;
				}
			
			$this->desconectar();
			return $Fila;
		}
		function consultar_persona_id()
		{
			$this->conectar();
				$sql="SELECT * FROM am_tpersona WHERE idPersona='$this->idPersona';";
				$pcsql=$this->filtro($sql);
				while($laRow=$this->proximo($pcsql))
				{
					$Fila[]=$laRow;
				}
			
			$this->desconectar();
			return $Fila;
		}
		function consultar_articulo()
		{
			$this->conectar();
				$sql="SELECT * FROM am_tarticulo WHERE estatus='1';";
				$pcsql=$this->filtro($sql);
				while($laRow=$this->proximo($pcsql))
				{
					$Fila[]=$laRow;
				}
			
			$this->desconectar();
			return $Fila;
		}
		function consultar_reporte()
		{
			$this->conectar();
				$sql="SELECT *,DATE_FORMAT(d.fecha_donacion,'%d-%m-%Y') AS fecha_a, CASE d.estatus WHEN '1' THEN 'ACTIVO' ELSE 'INACTIVO' END AS estatus_d FROM am_tdonacion d 
				INNER JOIN am_tpersona p ON d.idPersona=p.idPersona
				INNER JOIN am_tempresa e ON d.idEmpresa=e.idEmpresa";
				if($this->idPersona!="0" || $this->idEmpresa!="0"){
					if($this->fecha_donacion!="" && $this->fecha_fin!="" ){
						$sql.=" WHERE d.idPersona='".$this->idPersona."' OR d.idEmpresa='".$this->idEmpresa."' AND d.fecha_donacion BETWEEN '".$this->fecha_donacion."' AND '".$this->fecha_fin."' ";
					}else if($this->fecha_donacion!=""){
						$sql.=" WHERE d.idPersona='".$this->idPersona."' OR d.idEmpresa='".$this->idEmpresa."' AND d.fecha_donacion BETWEEN '".$this->fecha_donacion."' AND '".DATE("Y-m-d")."' ";
					}else{
						$sql.=" WHERE d.idPersona='".$this->idPersona."' OR d.idEmpresa='".$this->idEmpresa."' ";
					}
					
				}else{
					if($this->fecha_donacion!="" && $this->fecha_fin!="" ){
						$sql.=" WHERE d.fecha_donacion BETWEEN '".$this->fecha_donacion."' AND '".$this->fecha_fin."' ";
					}else if($this->fecha_donacion!=""){
						$sql.=" WHERE d.fecha_donacion BETWEEN '".$this->fecha_donacion."' AND '".DATE("Y-m-d")."' ";
					}
				}

				$pcsql=$this->filtro($sql);
				$i=0;
				if($laRow=$this->proximo($pcsql))
				{
					$Fila[$i]["idDonacion"]=$laRow['idDonacion'];
					$Fila[$i]["cedula"]=$laRow['cedula'];
					$Fila[$i]["primer_nombre"]=$laRow['primer_nombre'];
					$Fila[$i]["primer_apellido"]=$laRow['primer_apellido'];
					$Fila[$i]["rif"]=$laRow['rif'];
					$Fila[$i]["nombre"]=$laRow['nombre'];
					$Fila[$i]["fecha_a"]=$laRow['fecha_a'];
					$Fila[$i]["estatus_d"]=$laRow['estatus_d'];
					$i++;
				}
			
			$this->desconectar();
			return $Fila;
		}
		function consultar_reporte_id()
		{
			$this->conectar();
				$sql="SELECT *,DATE_FORMAT(d.fecha_donacion,'%d-%m-%Y') AS fecha_a, CASE d.estatus WHEN '1' THEN 'ACTIVO' ELSE 'INACTIVO' END AS estatus_d FROM am_tdonacion d 
				INNER JOIN am_tpersona p ON d.idPersona=p.idPersona
				INNER JOIN am_tempresa e ON d.idEmpresa=e.idEmpresa WHERE d.idDonacion='$this->idDonacion'";
				$pcsql=$this->filtro($sql);
				if($laRow=$this->proximo($pcsql))
				{
					$Fila["idDonacion"]=$laRow['idDonacion'];
					$Fila["cedula"]=$laRow['cedula'];
					$Fila["primer_nombre"]=$laRow['primer_nombre'];
					$Fila["primer_apellido"]=$laRow['primer_apellido'];
					$Fila["rif"]=$laRow['rif'];
					$Fila["nombre"]=$laRow['nombre'];
					$Fila["fecha_a"]=$laRow['fecha_a'];
					$Fila["estatus_d"]=$laRow['estatus_d'];
				}
			
			$this->desconectar();
			return $Fila;
		}
		function consultar_reporte_detalle_id()
		{
			$this->conectar();
			$cont=0;
				$sql="SELECT *,dd.cantidad AS cantidad_dd FROM am_tddonacion dd INNER JOIN am_tarticulo a ON dd.idArticulo=a.idArticulo WHERE dd.idDonacion='$this->idDonacion' ";
				$pcsql=$this->filtro($sql);
				while($laRow=$this->proximo($pcsql))
				{
					$Fila[$cont][0]=$laRow['idArticulo'];
					$Fila[$cont]["nombre"]=$laRow['nombre'];
					$Fila[$cont]["serial_factura"]=$laRow['serial_factura'];
					$Fila[$cont]["cantidad"]=$laRow['cantidad_dd'];
					$cont++;
				}
			
			$this->desconectar();
			return $Fila;
		}
	}
?>