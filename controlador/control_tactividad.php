<?php
	session_start();
	require_once("../clases/clase_tactividad.php");
	require_once("../clases/clase_bitacora.php");
    require_once('../libreria/utilidades.php');
	$lobjtactividad=new clstactividad;
	$lobjBitacora=new clsBitacora;
	$lobjUtil=new clsUtil;


	$lobjtactividad->set_tactividad($_POST['idtipoactividad']);
	$lobjtactividad->set_Nombre($_POST['nombretipoa']);
	$operacion=$_POST['operacion'];
	$lcReal_ip=$lobjUtil->get_real_ip();
    $ldFecha=date('Y-m-d h:m');


	switch ($operacion) 
	{
		case 'registrar_tactividad':
			$hecho=$lobjtactividad->registrar_tactividad();
			if($hecho)
			{
				$lobjBitacora->set_Datos($_SERVER['HTTP_REFERER'],$ldFecha,$lcReal_ip,'Registrar','Cargar datos','*','t_tipoactividad','','',$_SESSION['usuario'],$operacion); //envia los datos a la clase bitacora
   				$lobjBitacora->registrar_bitacora();//registra los datos en la tabla tbitacora.
				$_SESSION['msj']='Se ha registrado exitosamente';
			}
			else
			{	
				$_SESSION['msj']='Error en el registro';
			}
			header('location: ../vista/intranet.php?vista=archivo/tactividad');
		break;
		case 'editar_tactividad':
			//$laValorNuevo=$laValorAnterior=$laCampo=array();

			$lobjtactividad->set_tactividad($_POST['idtactividad']);
			//$latactividadAnterior=$lobjtactividad->consultar_tactividad();

			$hecho=$lobjtactividad->editar_tactividad();
			if($hecho)
			{
				/*$cont=0;
				if($_POST['nombretipoa']!=$latactividadAnterior[1])
				{
					$laValorNuevo[]=$_POST['nombretipoa'];
					$laValorAnterior[]=$latactividadAnterior[1];
					$cont++;
				}*/

				//for($i=0;$i<$cont;$i++)
				//{
					$lobjBitacora->set_Datos($_SERVER['HTTP_REFERER'],$ldFecha,$lcReal_ip,'Modificar','Error en los datos',$laCampo[$i],'t_tipoactividad',$laValorAnterior[$i],$laValorNuevo[$i],$_SESSION['usuario'],$operacion); //envia los datos a la clase bitacora
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
			header('location: ../vista/intranet.php?vista=archivo/tactividad');
		break;
		case 'eliminar_tactividad':
			$hecho=$lobjtactividad->eliminar_tactividad();
			if($hecho)
			{
				$lobjBitacora->set_Datos($_SERVER['HTTP_REFERER'],$ldFecha,$lcReal_ip,'Eliminar','No sé utiliza','estatustipoa','t_tipoactividad','1','0',$_SESSION['usuario'],$operacion); //envia los datos a la clase bitacora
   				$lobjBitacora->registrar_bitacora();//registra los datos en la tabla tbitacora.
				$_SESSION['msj']='Se ha desactivado exitosamente';
			}
			else
			{	
				$_SESSION['msj']='Error al eliminar';
			}
			header('location: ../vista/intranet.php?vista=archivo/tactividad');
		break;
		case 'restaurar_tactividad':
			$hecho=$lobjtactividad->restaurar_tactividad();
			if($hecho)
			{
				$lobjBitacora->set_Datos($_SERVER['HTTP_REFERER'],$ldFecha,$lcReal_ip,'Restaurar','No sé utiliza','estatustipoa','t_tipoactividad','0','1',$_SESSION['usuario'],$operacion); //envia los datos a la clase bitacora
   				$lobjBitacora->registrar_bitacora();//registra los datos en la tabla tbitacora.
				$_SESSION['msj']='Se ha restaurado exitosamente';
			}
			else
			{	
				$_SESSION['msj']='No se pudo restaurar el tipo de actividad';
			}

			header('location: ../vista/intranet.php?vista=archivo/tactividad');
		break;
		default:
			header('location: ../vista/intranet.php');
		break;
	}

?>