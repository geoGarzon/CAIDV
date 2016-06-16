<?php
	require_once('../nucleo/ModeloConect.php');
	class clsPreinscripcion extends ModeloConect
	{
		private $idparticipante,$nacionalidadpar,$cedulapar,$nombreunopar;
		private $nombredospar,$apellidounopar,$apellidodospar,$sexopar;
		private $telefonopar,$correopar,$direccionpar,$fechanacimientopar;
		private $numhijopar,$medioviviendapar,$tipoconstruccionpar;
		private $braillepar,$etniapar,$tdiagnostico_iddiagnostico;
		private $tlocalidad_idlocalidad,$tinstitucion_idinstitucion;
		private $estatuspar,$numerohermanospar,$tlocalidad_idlugarnacimiento;

		/*usuario*/
		private $idusuario,$nombreusu,$emailusu,$estatususu,$ultima_actividadusu,$trol_idrol,$cedula,$intentos_fallidos;
		private $idclave,$clavecla,$fechainicicla,$fechafincla,$estatuscla,$tusuario_idusuario;
		private $idpregunta,$pregunta,$respuesta,$tusuario_idusuario2;

		/*FECHAS PARA LOS REPORTES*/
		private $fecha_preinscripcion,$fecha_fin;

		function __set($var,$val){
			$this->$var=strtoupper($val);
		}		
		function __get($var){
			return $this->$var;
		}
		
		/*
			$sql="INSERT INTO `tusuario`(`idusuario`, `nombreusu`, `emailusu`, `estatususu`, `trol_idrol`, `cedula`)
			 VALUES ('$this->lcUsuario',UPPER('$this->lcNombre'),UPPER('$this->lcEmail'),'1','$this->lnIdRol','$this->lnIdPersona')";
			
			$sql=" INSERT INTO `tclave`(`clavecla`, `fechainiciocla`, `fechafincla`, `estatuscla`, `tusuario_idusuario`) 
			VALUES (sha1((SELECT clavepredeterminada FROM tsistema)),now(), ADDDATE(NOW(), (SELECT tiempocaducida FROM tsistema)),'1','$this->lcUsuario');";


		*/
		function registrar_preinscripcion()
		{
			$this->conectar();
			/*agregar participante*/
			$sql="INSERT INTO `tparticipante`
			(nacionalidadpar, etniapar, `cedulapar`, `nombreunopar`, `nombredospar`, `apellidounopar`, `apellidodospar`, `sexopar`
				, `telefonopar`, `direccionpar`, `fechanacimientopar`, `numhijopar`, `medioviviendapar`
				, `viviendapar`, `tipoconstruccionpar`, `braillepar`, `tdiagnostico_iddiagnostico`
				, `tinstitucion_idinstitucion`,tlocalidad_idlocalidad,numerohermanospar,correopar,tlocalidad_idlugarnacimiento,preinscrito,fecha_preinscripcion) VALUES
				 ('$this->nacionalidadpar', '$this->etniapar',	'$this->cedulapar',UPPER('$this->nombreunopar'),UPPER('$this->nombredospar')
				 	,UPPER('$this->apellidounopar'),UPPER('$this->apellidodospar'),UPPER('$this->sexopar')
				 	,'$this->telefonopar',UPPER('$this->direccionpar'),'$this->fechanacimientopar'
				 	,'$this->numhijopar','$this->medioviviendapar',UPPER('$this->viviendapar')
				 	,'$this->tipoconstruccionpar','$this->braillepar','$this->tdiagnostico_iddiagnostico'
				 	,'$this->tinstitucion_idinstitucion','$this->tlocalidad_idlocalidad','$this->numerohermanospar','$this->correopar','$this->tlocalidad_idlugarnacimiento','1',NOW()); ";
			$lnHecho=$this->ejecutar($sql);			
			/*agregar usuario*/

			$sql=" INSERT INTO `tusuario` (`idusuario`, `nombreusu`, `emailusu`, `estatususu`, `trol_idrol`, `cedula`)
			 VALUES ('$this->idusuario',UPPER('$this->nombreusu'),UPPER('$this->emailusu'),'1','6','$this->cedula'); ";
			 $lnHecho=$this->ejecutar($sql);			
			/*agregar clave al usuario*/
			$sql=" INSERT INTO `tclave` (`clavecla`, `fechainiciocla`, `fechafincla`, `estatuscla`, `tusuario_idusuario`) 
			VALUES (sha1((SELECT clavepredeterminada FROM tsistema)),now(), ADDDATE(NOW(), (SELECT tiempocaducida FROM tsistema)),'1','$this->idusuario'); ";
			$lnHecho=$this->ejecutar($sql);	

			$this->desconectar();
			return $lnHecho;
		}

		function consultar_participante($cedula)
		{
			$this->conectar();
			$cont=0;
				$sql="SELECT */*,date_format(fechanacimientopar,'%d-%m-%Y')as fechanacimientopar */
				FROM `tparticipante` WHERE cedulapar='$cedula'";
				$pcsql=$this->filtro($sql);
				while($laRow=$this->proximo($pcsql))
				{
					$Fila['idparticipante']=$laRow['idparticipante'];
					$Fila['cedulapar']=$laRow['cedulapar'];
					$Fila['nombreunopar']=$laRow['nombreunopar'];
					$Fila['nombredospar']=$laRow['nombredospar'];
					$Fila['apellidounopar']=$laRow['apellidounopar'];
					$Fila['apellidodospar']=$laRow['apellidodospar'];
					$Fila['sexopar']=$laRow['sexopar'];
					$Fila['telefonopar']=$laRow['telefonopar'];
					$Fila['direccionpar']=$laRow['direccionpar'];
					$Fila['fechanacimientopar']=$laRow['fechanacimientopar'];
					$Fila['numhijopar']=$laRow['numhijopar'];
					$Fila['medioviviendapar']=$laRow['medioviviendapar'];
					$Fila['viviendapar']=$laRow['viviendapar'];
					$Fila['tipoconstruccionpar']=$laRow['tipoconstruccionpar'];
					$Fila['braillepar']=$laRow['braillepar'];
					$Fila['tdiagnostico_iddiagnostico']=$laRow['tdiagnostico_iddiagnostico'];
					$Fila['tinstitucion_idinstitucion']=$laRow['tinstitucion_idinstitucion'];
					$Fila['estatuspar']=$laRow['estatuspar'];
					$Fila['tlocalidad_idlocalidad']=$laRow['tlocalidad_idlocalidad'];
					$Fila['etniapar']=$laRow['etniapar'];
					$Fila['nacionalidadpar']=$laRow['nacionalidadpar'];
					$Fila['correopar']=$laRow['correopar'];
					$Fila['tlocalidad_idlugarnacimiento']=$laRow['tlocalidad_idlugarnacimiento'];
					$Fila['numerohermanospar']=$laRow['numerohermanospar'];
					$cont++;
				}
			
			$this->desconectar();
			return $Fila;
		}
		function editar_preinscrito()
		{
			$this->conectar();
			$sql="UPDATE `tparticipante` 
				SET nacionalidadpar='$this->nacionalidadpar'
				,numerohermanospar='$this->numerohermanospar'
				,correopar='$this->correopar'
				,tlocalidad_idlugarnacimiento='$this->tlocalidad_idlugarnacimiento'
				, etniapar='$this->etniapar'
				,`nombreunopar`=UPPER('$this->nombreunopar')
				,`nombredospar`=UPPER('$this->nombredospar')
				,`apellidounopar`=UPPER('$this->apellidounopar')
				,`apellidodospar`=UPPER('$this->apellidodospar')
				,`sexopar`='$this->sexopar'
				,`telefonopar`='$this->telefonopar'
				,`direccionpar`=UPPER('$this->direccionpar')
				,`fechanacimientopar`='$this->fechanacimientopar'
				,`numhijopar`='$this->numhijopar'
				,`medioviviendapar`='$this->medioviviendapar'
				,`viviendapar`='$this->viviendapar'
				,`tipoconstruccionpar`='$this->tipoconstruccionpar'
				,`braillepar`='$this->braillepar'
				,`tdiagnostico_iddiagnostico`='$this->tdiagnostico_iddiagnostico'
				,`tinstitucion_idinstitucion`='$this->tinstitucion_idinstitucion'
				,tlocalidad_idlocalidad='$this->tlocalidad_idlocalidad' 
				WHERE idparticipante='$this->idparticipante'";
			$lnHecho=$this->ejecutar($sql);			
			$this->desconectar();
			return $lnHecho;
		}	
		function consultar_reporte()
		{
			$this->conectar();
				$sql="SELECT *,DATE_FORMAT(fecha_preinscripcion,'%d-%m-%Y') AS fecha_p,DATE_FORMAT(fechanacimientopar,'%d-%m-%Y') AS fecha_m FROM tparticipante d ";
				
				if($this->fecha_preinscripcion!="" && $this->fecha_fin!="" ){
					$sql.=" WHERE d.fecha_preinscripcion BETWEEN '".$this->fecha_preinscripcion."' AND '".$this->fecha_fin."' AND d.fecha_preinscripcion!='0000-00-00'";
				}else if($this->fecha_preinscripcion!=""){
					$sql.=" WHERE d.fecha_preinscripcion BETWEEN '".$this->fecha_preinscripcion."' AND '".DATE("Y-m-d")."' AND d.fecha_preinscripcion!='0000-00-00'";
				}else{
					$sql.=" WHERE d.fecha_preinscripcion!='0000-00-00' ";
				}
				

				$pcsql=$this->filtro($sql);
				$i=0;
				if($laRow=$this->proximo($pcsql))
				{
					$Fila[$i]["idparticipante"]=$laRow['idparticipante'];
					$Fila[$i]["cedula"]=$laRow['nacionalidadpar'].$laRow['cedulapar'];
					$Fila[$i]["primer_nombre"]=$laRow['nombreunopar'];
					$Fila[$i]["primer_apellido"]=$laRow['apellidounopar'];
					$Fila[$i]["sexo"]=$laRow['sexopar'];
					$Fila[$i]["telefono"]=$laRow['telefonopar'];
					$Fila[$i]["fecha_m"]=$laRow['fecha_m'];
					$Fila[$i]["fecha_p"]=$laRow['fecha_p'];
					$i++;
				}
			
			$this->desconectar();
			return $Fila;
		}
	}
?>