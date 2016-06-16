<?php
	session_start();
	require_once("../clases/clase_preinscripcion.php");
	require_once("../clases/clase_bitacora.php");
    require_once('../libreria/utilidades.php');
	$pre=new clsPreinscripcion;
	$lobjBitacora=new clsBitacora;
	$lobjUtil=new clsUtil;

	$pre->nacionalidadpar=$_POST["nacionalidadpar"];
	$pre->cedulapar=$_POST["cedulapar"];
	$pre->nombreunopar=$_POST["nombreunopar"];
	$pre->nombredospar=$_POST["nombredospar"];
	$pre->apellidounopar=$_POST["apellidounopar"];
	$pre->apellidodospar=$_POST["apellidodospar"];
	$pre->sexopar=$_POST["sexopar"];
	$pre->telefonopar=$_POST["telefonopar"];
	$pre->correopar=$_POST["correopar"];
	$pre->fechanacimientopar=$_POST['fechanacimientopar'];
	$pre->tlocalidad_idlugarnacimiento=$_POST["tlocalidad_idlugarnacimiento"];
	$pre->direccionpar=$_POST["direccionpar"];
	$pre->tlocalidad_idlocalidad=$_POST["tlocalidad_idlocalidad"];
	$pre->viviendapar=$_POST["viviendapar"];
	$pre->medioviviendapar=$_POST["medioviviendapar"];
	$pre->tipoconstruccionpar=$_POST["tipoconstruccionpar"];
	$pre->numerohermanospar=$_POST["numerohermanospar"];
	$pre->numhijopar=$_POST["numhijopar"];
	$pre->tdiagnostico_iddiagnostico=$_POST["tdiagnostico_iddiagnostico"];
	$pre->tinstitucion_idinstitucion=$_POST["tinstitucion_idinstitucion"];
	$pre->braillepar=$_POST["braillepar"];
	$pre->etniapar=$_POST["etniapar"];

	/*USUARIO*/
	$pre->idusuario=$_POST["cedulapar"];
	$pre->nombreusu=$_POST["nombreunopar"]." ".$_POST["apellidounopar"];
	$pre->emailusu=$_POST["correopar"];
	$pre->cedula=$_POST["cedulapar"];


	$operacion=$_POST['operacion'];

	switch ($operacion) 
	{
		case 'registrar_preinscripcion':
			$hecho=$pre->registrar_preinscripcion();
			if($hecho)
			{
				$lobjBitacora->set_Datos($_SERVER['HTTP_REFERER'],$ldFecha,$lcReal_ip,'Registrar','Cargar datos','*','tarticulo','','',$_SESSION['usuario'],$operacion); //envia los datos a la clase bitacora
   				$lobjBitacora->registrar_bitacora();//registra los datos en la tabla tbitacora.
				$_SESSION['msj']='Se ha Preinscripto exitosamente su usuario es: '.$_POST["cedulapar"].' y su clave es: 12345678';
			}
			else
			{	
				$_SESSION['msj']='Error en el registro';
			}
			header('location: ../vista/index.php?vista=acceso_intranet');
		break;
		case 'editar_preinscripcion':
			$pre->idparticipante=$_POST["idparticipante"];
			$hecho=$pre->editar_preinscrito();
			if($hecho)
			{
				$lobjBitacora->set_Datos($_SERVER['HTTP_REFERER'],$ldFecha,$lcReal_ip,'Modificar','Error en los datos',$laCampo[$i],'tarticulo',$laValorAnterior[$i],$laValorNuevo[$i],$_SESSION['usuario'],$operacion); //envia los datos a la clase bitacora
	   			$lnHecho=$lobjBitacora->registrar_bitacora();//registra los datos en la tabla tbitacora.
   				if($lnHecho)
				{
					$_SESSION['msj']='Se ha modificado exitosamente';
				}
				
			}
			else
			{	
				$_SESSION['msj']='No se realizarón cambios';
			}
			header('location: ../vista/intranet.php?vista=preinscripcion/consultar_preinscrito');
		break;
	}

	//header('location: ../vista/intranet.php?vista=acceso_intranet');
?>