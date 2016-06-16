<?php
include_once('cls_Datos.php');
class cls_tactividad extends cls_Datos{
	//Argumentos de la Clase
	private $aaForm;

	//Funciones de la Clase
		//Funciones SET
		function f_SetsForm($paForm){
			$this->aaForm=$paForm;
		}
		//Function GET
		function f_GetsForm(){
			return $this->aaForm;
		}
		//Funcion Buscar
		function f_Buscar(){
			$lb_Enc=false;
			$ls_Sql="SELECT * FROM t_tipoactividad WHERE idtipoactividad='".$this->aaForm['idTipoActividad']."'";
			//PASO 1 conecto
			$this->f_Con();
			//PASO 2 busco
			$lrTablaBusqueda=$this->f_Filtro($ls_Sql);
			//PASO 3 organizo
			if($la_Tupla=$this->f_Arreglo($lrTablaBusqueda)){
				$this->aaForm["idTipoActividad"]=$la_Tupla["idtipoactividad"];
				$this->aaForm["Nombre"]=$la_Tupla["nombretipoa"];
				$this->aaForm["Descripcion"]=$la_Tupla["descripciontipoa"];
				$this->aaForm["Estatus"]=$la_Tupla["estatustipoa"];
				$lb_Enc=true;
			}
			//PASO 4 cierro filtro
			$this->f_Cierra($lrTablaBusqueda);
			//PASO 5 desconecto
			$this->f_Des();
			return $lb_Enc;
		}
		//Funcion Operacion
		function f_Operacion(){
			$lb_Hecho=false;
			//Pregunta la Operacion a Realizar
			if($this->aaForm['Operacion']=='incluir'){
				//Creo el Sql de Insercion
				$ls_Sql="INSERT INTO t_tipoactividad (idtipoactividad,nombretipoa,descripciontipoa,estatustipoa) VALUES ('".$this->aaForm['idTipoActividad']."','".$this->aaForm['Nombre']."','".$this->aaForm['Descripcion']."','".$this->aaForm['Estatus']."')";
			}else if($this->aaForm['Operacion']=='modificar'){
				//Creo el SQL de Modificacion
				$ls_Sql="UPDATE t_tipoactividad SET nombretipoa='".$this->aaForm['Nombre']."',descripciontipoa='".$this->aaForm['Descripcion']."',estatustipoa='".$this->aaForm['Estatus']."' WHERE idtipoactividad='".$this->aaForm['idTipoActividad']."'";
			}else if($this->aaForm['Operacion']=='eliminar'){
				//Creo el SQL de Eliminacion
				$ls_Sql="DELETE FROM t_tipoactividad WHERE idtipoactividad='".$this->aaForm['idTipoActividad']."'";
			}
			//PASO 1 conecto
			$this->f_Con();
			//PASO 2 ejecuto con el SQL dependiendo de la Operacion a realizar
			$lb_Hecho=$this->f_Ejecutar($ls_Sql);
			//PASO 3 desconecto
			$this->f_Des();
			return $lb_Hecho;
		}
}
?>