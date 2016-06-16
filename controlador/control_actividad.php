<?php
	session_start();
	require_once("../clases/clase_actividad.php");
	require_once("../clases/clase_bitacora.php");
    require_once('../libreria/utilidades.php');
	$lobjactividad=new clsactividad;
	$lobjBitacora=new clsBitacora;
	$lobjUtil=new clsUtil;


	$lobjactividad->idActividad=$_POST['codigoActividad'];
	$lobjactividad->nombre=$_POST['nombre'];
	$lobjactividad->idTipoActividad=$_POST['idTipoActividad'];
	$operacion=$_POST['operacion'];
	$lcReal_ip=$lobjUtil->get_real_ip();
    $ldFecha=date('Y-m-d h:m');


	switch ($operacion) 
	{
		case 'registrar_actividad':
			$hecho=$lobjactividad->registrar_actividad();
			if($hecho)
			{
				$lobjBitacora->set_Datos($_SERVER['HTTP_REFERER'],$ldFecha,$lcReal_ip,'Registrar','Cargar datos','*','tactividad','','',$_SESSION['usuario'],$operacion); //envia los datos a la clase bitacora
   				$lobjBitacora->registrar_bitacora();//registra los datos en la tabla tbitacora.
				$_SESSION['msj']='Se ha registrado exitosamente';
			}
			else
			{	
				$_SESSION['msj']='Error en el registro';
			}
			header('location: ../vista/intranet.php?vista=archivo/actividad');
		break;
		case 'editar_actividad':
			//$laValorNuevo=$laValorAnterior=$laCampo=array();

			$lobjactividad->idActividad=$_POST['codigoActividad'];
			//$laactividadAnterior=$lobjactividad->consultar_actividad();

			$hecho=$lobjactividad->editar_actividad();
			if($hecho)
			{
				/*cont=0;
				if($_POST['nombreact']!=$laactividadAnterior[1])
				{
					$laValorNuevo[]=$_POST['nombreact'];
					$laValorAnterior[]=$laactividadAnterior[1];
					$laCampo[]='tipo_actividad';
					$cont++;
				}

				for($i=0;$i<$cont;$i++)
				{*/
					$lobjBitacora->set_Datos($_SERVER['HTTP_REFERER'],$ldFecha,$lcReal_ip,'Modificar','Error en los datos',$laCampo[$i],'tactividad',$laValorAnterior[$i],$laValorNuevo[$i],$_SESSION['usuario'],$operacion); //envia los datos a la clase bitacora
	   				$lnHecho=$lobjBitacora->registrar_bitacora();//registra los datos en la tabla tbitacora.
   					if($lnHecho)
					{
						$_SESSION['msj']='Se ha modificado exitosamente';
					}
   				//}
			}
			else
			{	
				$_SESSION['msj']='No se realizarón cambios';
			}
			header('location: ../vista/intranet.php?vista=archivo/actividad');
		break;
		case 'eliminar_actividad':
			$hecho=$lobjactividad->eliminar_actividad();
			if($hecho)
			{
				$lobjBitacora->set_Datos($_SERVER['HTTP_REFERER'],$ldFecha,$lcReal_ip,'Eliminar','No sé utiliza','estatusact','tactividad','1','0',$_SESSION['usuario'],$operacion); //envia los datos a la clase bitacora
   				$lobjBitacora->registrar_bitacora();//registra los datos en la tabla tbitacora.
				$_SESSION['msj']='Se ha desactivado exitosamente';
			}
			else
			{	
				$_SESSION['msj']='Error al eliminar';
			}
			header('location: ../vista/intranet.php?vista=archivo/actividad');
		break;
		case 'restaurar_actividad':
			$hecho=$lobjactividad->restaurar_actividad();
			if($hecho)
			{
				$lobjBitacora->set_Datos($_SERVER['HTTP_REFERER'],$ldFecha,$lcReal_ip,'Restaurar','No sé utiliza','estatusact','tactividad','0','1',$_SESSION['usuario'],$operacion); //envia los datos a la clase bitacora
   				$lobjBitacora->registrar_bitacora();//registra los datos en la tabla tbitacora.
				$_SESSION['msj']='Se ha restaurado exitosamente';
			}
			else
			{	
				$_SESSION['msj']='No se pudo restaurar la actividad';
			}

			header('location: ../vista/intranet.php?vista=archivo/actividad');
		break;
		default:
			header('location: ../vista/intranet.php');
		break;
	}

?>