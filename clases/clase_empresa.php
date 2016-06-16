<?php
	require_once('../nucleo/ModeloConect.php');
	class clsEmpresa extends ModeloConect
	{
		private $idEmpresa,$rif,$nombre,$direccion,$tlf_uno,$tlf_dos,$correo,$estatus;
		function __set($var,$val){
			$this->$var=strtoupper($val);
		}		
		function __get($var){
			return $this->$var;
		}
		

		function consultar_empresa()
		{
			$this->conectar();
			$cont=0;
				$sql="SELECT * FROM am_tempresa WHERE idEmpresa>1";
				$pcsql=$this->filtro($sql);
				while($laRow=$this->proximo($pcsql))
				{
					$Fila[$cont][0]=$laRow['idEmpresa'];
					$Fila[$cont][1]=$laRow['rif'];
					$Fila[$cont][2]=$laRow['nombre'];
					$Fila[$cont][3]=$laRow['direccion'];
					$Fila[$cont][4]=$laRow['tlf_uno'];
					$Fila[$cont][5]=$laRow['tlf_dos'];
					$Fila[$cont][6]=$laRow['correo'];
					$Fila[$cont][7]=$laRow['estatus'];
					$cont++;
				}
			
			$this->desconectar();
			return $Fila;
		}

		function consultar_empresa_id()
		{
			$this->conectar();
				$sql="SELECT * FROM am_tempresa WHERE idEmpresa='$this->idEmpresa' AND idEmpresa>1";
				$pcsql=$this->filtro($sql);
				if($laRow=$this->proximo($pcsql))
				{
					$Fila[0]=$laRow['idEmpresa'];
					$Fila[1]=$laRow['rif'];
					$Fila[2]=$laRow['nombre'];
					$Fila[3]=$laRow['direccion'];
					$Fila[4]=$laRow['tlf_uno'];
					$Fila[5]=$laRow['tlf_dos'];
					$Fila[6]=$laRow['correo'];
				}
			
			$this->desconectar();
			return $Fila;
		}

		function registrar_empresa()
		{
			$this->conectar();
			$sql="INSERT INTO am_tempresa (rif,nombre,direccion,tlf_uno,tlf_dos,correo,estatus) VALUES ('$this->rif','$this->nombre','$this->direccion','$this->tlf_uno','$this->tlf_dos','$this->correo','1')";
			$lnHecho=$this->ejecutar($sql);			
			$this->desconectar();
			return $lnHecho;
		}

		function eliminar_empresa()
		{
			$this->conectar();
			$sql="UPDATE am_tempresa SET estatus='0' WHERE idEmpresa='$this->idEmpresa' ";
			$lnHecho=$this->ejecutar($sql);			
			$this->desconectar();
			return $lnHecho;
		}

		function restaurar_empresa()
		{
			$this->conectar();
			$sql="UPDATE am_tempresa SET estatus='1' WHERE idEmpresa='$this->idEmpresa' ";
			$lnHecho=$this->ejecutar($sql);			
			$this->desconectar();
			return $lnHecho;
		}

		function editar_empresa()
		{
			$this->conectar();
			$sql="UPDATE am_tempresa SET rif='$this->rif',nombre='$this->nombre',direccion='$this->direccion',tlf_uno='$this->tlf_uno',tlf_dos='$this->tlf_dos',correo='$this->correo' WHERE idEmpresa='$this->idEmpresa' ";
			$lnHecho=$this->ejecutar($sql);			
			$this->desconectar();
			return $lnHecho;
		}
	}
?>