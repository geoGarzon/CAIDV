<?php
session_start();
include_once("../clases/cls_tactividad.php");
//instancion el objeto de la clase
$lobj_tactividad=new cls_tactividad;
//si existe una operacion dentro de lo que viene de la vista
if(array_key_exists(Operacion, $_POST)){
	//Recibo toda la informacion del formulario en una variable
	$laForm=$_POST;
	//Guardo la informacion de la vista en el objeto
	$lobj_tactividad->f_SetsForm($laForm);
}
if($laForm['Operacion']=='buscar'){
	//Ejecuto la Busqueda
	$lb_Enc=$lobj_tactividad->f_Buscar();
	//Pregunto si encontro
	if($lb_Enc){
		//Recibo la informacion de la busqueda
		$laForm=$lobj_tactividad->f_GetsForm();
		//Cambio el Hay a 1 para mostrar que encontro una sola
		$laForm['Hay']='1';
		//Monto la Informacion para llevarlo a la vista
		$_SESSION['Campos']=$laForm;
		//Redirecciono a la Vista
		header('location: ../vistas/vis_tactividad.php');
	}else{
		//le coloco el valor 0 al campo Hay
		$laForm['Hay']='0';
		//Monto la Informacion para llevarlo a la vista
		$_SESSION['Campos']=$laForm;
		//Redirecciono a la Vista
		header('location: ../vistas/vis_tactividad.php');		
	}
}
if($laForm['Operacion']!='buscar'){
	//Ejecuto la funcion Operacion
	$lb_Hecho=$lobj_tactividad->f_Operacion();
	if($lb_Hecho){
		$laForm['Hacer']='Listo';
	}
	//Monto la Informacion para llevarlo a la vista
	$_SESSION['Campos']=$laForm;
	//Redirecciono a la Vista
	header('location: ../vistas/vis_tactividad.php');
}
?>