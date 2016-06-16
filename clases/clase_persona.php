<?php
	require_once('../nucleo/ModeloConect.php');
	class clsPersona extends ModeloConect
	{
		private $idPersona,$cedula,$primer_nombre,$segundo_nombre,$primer_apellido,$segundo_apellido,$sexo,$direccion,$tlf_uno,$tlf_dos,$correo,$estatus;
		function __set($var,$val){
			$this->$var=strtoupper($val);
		}		
		function __get($var){
			return $this->$var;
		}
		

		function consultar_persona()
		{
			$this->conectar();
			$cont=0;
				$sql="SELECT * FROM am_tpersona ";
				$pcsql=$this->filtro($sql);
				while($laRow=$this->proximo($pcsql))
				{
					$Fila[$cont][0]=$laRow['idPersona'];
					$Fila[$cont][1]=$laRow['cedula'];
					$Fila[$cont][2]=$laRow['primer_nombre'];
					$Fila[$cont][3]=$laRow['segundo_nombre'];
					$Fila[$cont][4]=$laRow['primer_apellido'];
					$Fila[$cont][5]=$laRow['segundo_apellido'];
					$Fila[$cont][6]=$laRow['sexo'];
					$Fila[$cont][7]=$laRow['direccion'];
					$Fila[$cont][8]=$laRow['tlf_uno'];
					$Fila[$cont][9]=$laRow['tlf_dos'];
					$Fila[$cont][10]=$laRow['correo'];
					$Fila[$cont][11]=$laRow['estatus'];
					$cont++;
				}
			
			$this->desconectar();
			return $Fila;
		}

		function consultar_persona_id()
		{
			$this->conectar();
				$sql="SELECT * FROM am_tpersona WHERE idPersona='$this->idPersona'";
				$pcsql=$this->filtro($sql);
				if($laRow=$this->proximo($pcsql))
				{
					$Fila[0]=$laRow['idPersona'];
					$Fila[1]=$laRow['cedula'];
					$Fila[2]=$laRow['primer_nombre'];
					$Fila[3]=$laRow['segundo_nombre'];
					$Fila[4]=$laRow['primer_apellido'];
					$Fila[5]=$laRow['segundo_apellido'];
					$Fila[6]=$laRow['sexo'];
					$Fila[7]=$laRow['direccion'];
					$Fila[8]=$laRow['tlf_uno'];
					$Fila[9]=$laRow['tlf_dos'];
					$Fila[10]=$laRow['correo'];
					$Fila[11]=$laRow['estatus'];
				}
			
			$this->desconectar();
			return $Fila;
		}

		function registrar_persona()
		{
			$this->conectar();
			$sql="INSERT INTO am_tpersona (cedula,primer_nombre,segundo_nombre,primer_apellido,segundo_apellido,sexo,direccion,tlf_uno,tlf_dos,correo,estatus) VALUES ('$this->cedula','$this->primer_nombre','$this->segundo_nombre','$this->primer_apellido','$this->segundo_apellido','$this->sexo','$this->direccion','$this->tlf_uno','$this->tlf_dos','$this->correo','1')";
			$lnHecho=$this->ejecutar($sql);			
			$this->desconectar();
			return $lnHecho;
		}

		function eliminar_persona()
		{
			$this->conectar();
			$sql="UPDATE am_tpersona SET estatus='0' WHERE idPersona='$this->idPersona' ";
			$lnHecho=$this->ejecutar($sql);			
			$this->desconectar();
			return $lnHecho;
		}

		function restaurar_persona()
		{
			$this->conectar();
			$sql="UPDATE am_tpersona SET estatus='1' WHERE idPersona='$this->idPersona' ";
			$lnHecho=$this->ejecutar($sql);			
			$this->desconectar();
			return $lnHecho;
		}

		function editar_persona()
		{
			$this->conectar();
			$sql="UPDATE am_tpersona SET cedula='$this->cedula',primer_nombre='$this->primer_nombre',segundo_nombre='$this->segundo_nombre',primer_apellido='$this->primer_apellido',segundo_apellido='$this->segundo_apellido',sexo='$this->sexo',direccion='$this->direccion',tlf_uno='$this->tlf_uno',tlf_dos='$this->tlf_dos',correo='$this->correo' WHERE idPersona='$this->idPersona' ";
			$lnHecho=$this->ejecutar($sql);			
			$this->desconectar();
			return $lnHecho;
		}
	}
?>