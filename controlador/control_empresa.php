<?php
	session_start();
	require_once("../clases/clase_empresa.php");
	require_once("../clases/clase_bitacora.php");
    require_once('../libreria/utilidades.php');
	$tipo_articulo=new clsEmpresa;
	$lobjBitacora=new clsBitacora;
	$lobjUtil=new clsUtil;

	$tipo_articulo->idEmpresa=$_POST['idEmpresa'];
	$tipo_articulo->rif=$_POST['rif'];
	$tipo_articulo->nombre=$_POST['nombre'];
	$tipo_articulo->direccion=$_POST['direccion'];
	$tipo_articulo->tlf_uno=$_POST['tlf_uno'];
	$tipo_articulo->tlf_dos=$_POST['tlf_dos'];
	$tipo_articulo->correo=$_POST['correo'];

	$lcReal_ip=$lobjUtil->get_real_ip();
    $ldFecha=date('Y-m-d h:m');
	$operacion=$_POST['operacion'];

	switch ($operacion) 
	{
		case 'registrar_empresa':
			$hecho=$tipo_articulo->registrar_empresa();
			if($hecho)
			{
				$lobjBitacora->set_Datos($_SERVER['HTTP_REFERER'],$ldFecha,$lcReal_ip,'Registrar','Cargar datos','*','tempresa','','',$_SESSION['usuario'],$operacion); //envia los datos a la clase bitacora
   				$lobjBitacora->registrar_bitacora();//registra los datos en la tabla tbitacora.
				$_SESSION['msj']='Se ha registrado exitosamente';
			}
			else
			{	
				$_SESSION['msj']='Error en el registro';
			}
			header('location: ../vista/intranet.php?vista=donacion/empresa');
		break;
		case 'editar_empresa':
			$tipo_articulo->idEmpresa=$_POST['idEmpresa'];

			$hecho=$tipo_articulo->editar_empresa();
			if($hecho)
			{
				$lobjBitacora->set_Datos($_SERVER['HTTP_REFERER'],$ldFecha,$lcReal_ip,'Modificar','Error en los datos',$laCampo[$i],'tempresa',$laValorAnterior[$i],$laValorNuevo[$i],$_SESSION['usuario'],$operacion); //envia los datos a la clase bitacora
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
		break;
		case 'eliminar_empresa':
			$hecho=$tipo_articulo->eliminar_empresa();
			if($hecho)
			{
				$lobjBitacora->set_Datos($_SERVER['HTTP_REFERER'],$ldFecha,$lcReal_ip,'Eliminar','No sé utiliza','estatusmod','tempresa','1','0',$_SESSION['usuario'],$operacion); //envia los datos a la clase bitacora
   				$lobjBitacora->registrar_bitacora();//registra los datos en la tabla tbitacora.
				$_SESSION['msj']='Se ha desactivado exitosamente';
			}
			else
			{	
				$_SESSION['msj']='Error al eliminar ';
			}
		break;
		case 'restaurar_empresa':
			$hecho=$tipo_articulo->restaurar_empresa();
			if($hecho)
			{
				$lobjBitacora->set_Datos($_SERVER['HTTP_REFERER'],$ldFecha,$lcReal_ip,'Restaurar','Necesario','estatusmod','tempresa','0','1',$_SESSION['usuario'],$operacion); //envia los datos a la clase bitacora
   				$lobjBitacora->registrar_bitacora();//registra los datos en la tabla tbitacora.
				$_SESSION['msj']='Se ha restaurado exitosamente';
			}
			else
			{	
				$_SESSION['msj']='No se pudo restaurar el servicio';
			}
		break;
		default:
			header('location: ../vista/intranet.php?vista=donacion/empresa');
		break;
	}

	header('location: ../vista/intranet.php?vista=donacion/empresa');
?>