<?php
	session_start();
	require_once("../clases/clase_donacion.php");
	require_once("../clases/clase_bitacora.php");
    require_once('../libreria/utilidades.php');
	$donacion=new clsDonacion;
	$lobjBitacora=new clsBitacora;
	$lobjUtil=new clsUtil;

	$donacion->idDonacion=$_POST["idDonacion"];
	$donacion->idPersona=$_POST["idPersona"];
	$donacion->idEmpresa=$_POST["idEmpresa"];
	$donacion->fecha_asignacion=$_POST["fecha_asignacion"];
	$donacion->estatus=$_POST["estatus"];
	
	

	$lcReal_ip=$lobjUtil->get_real_ip();
    $ldFecha=date('Y-m-d h:m');
	$operacion=$_POST['operacion'];

	switch ($operacion) 
	{
		case 'registrar_donacion':
			$id=$donacion->registrar_donacion();
			if($id !="" && $id != null)
			{	
				$donacion->idDonacion=$id;
   				$serial_factura = $_POST["serial_factura"];
   				$cantidad = $_POST["cantidad"];
   				foreach ($_POST["idArticulo"] as $i => $value) {
   					$donacion->idArticulo = $value;
   					$donacion->serial_factura = $serial_factura[$i];
   					$donacion->cantidad = $cantidad[$i];
   					$donacion->registrar_donacion_detalle();
   				}
				$_SESSION['msj']='Se ha registrado exitosamente';
			}
			else
			{	
				$_SESSION['msj']='Error en el registro';
			}
			header('location: ../vista/intranet.php?vista=donacion/donacion');
		break;
		case 'editar_articulo':
			$tipo_articulo->idArticulo=$_POST['idArticulo'];

			$hecho=$tipo_articulo->editar_articulo();
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
		break;
		case 'eliminar_donacion':
			$hecho=$donacion->eliminar_donacion();
			if($hecho)
			{
				$lobjBitacora->set_Datos($_SERVER['HTTP_REFERER'],$ldFecha,$lcReal_ip,'Eliminar','No sé utiliza','estatusmod','tarticulo','1','0',$_SESSION['usuario'],$operacion); //envia los datos a la clase bitacora
   				$lobjBitacora->registrar_bitacora();//registra los datos en la tabla tbitacora.
				$_SESSION['msj']='Se ha desactivado exitosamente';
			}
			else
			{	
				$_SESSION['msj']='Error al eliminar';
			}
		break;
		case 'restaurar_donacion':
			$hecho=$donacion->restaurar_donacion();
			if($hecho)
			{
				$lobjBitacora->set_Datos($_SERVER['HTTP_REFERER'],$ldFecha,$lcReal_ip,'Restaurar','Necesario','estatusmod','tarticulo','0','1',$_SESSION['usuario'],$operacion); //envia los datos a la clase bitacora
   				$lobjBitacora->registrar_bitacora();//registra los datos en la tabla tbitacora.
				$_SESSION['msj']='Se ha restaurado exitosamente';
			}
			else
			{	
				$_SESSION['msj']='No se pudo restaurar el servicio';
			}
		break;
		default:
			header('location: ../vista/intranet.php?vista=donacion/donacion');
		break;
	}

	header('location: ../vista/intranet.php?vista=donacion/donacion');
?>