<?php
include_once("clsDatos.php");
class  claAgendaParroquial extends  clsDatos{
		private $aa_Form;
		private $as_Cadena;

		public function __construct(){
			$this->aa_Form=Array();
			$this->as_Cadena="";
		}

		public function __destruct()
		{
		}
	/********* Funcion Obtener Formulario *********************************************************/
		public function f_SetsForm($pa_Form){														
			$this->aa_Form=$pa_Form;																
		}																							
	/**********************************************************************************************/

	/********* Funcion Retornar Formulario ********/
		public function	f_GetsForm(){				
			return $this->aa_Form;					
		}											
	/**********************************************/

	/************************ Funcion Guardar   ***************************************************************************/
	/* Se encarga de volcado de los datos en la base de datos															  */
	/**********************************************************************************************************************/
		public function fpIncluirActividad($EstadoAgenda){		

			$lbHecho=false;
			$this->fpConectar();									

			if ($this->aa_Form['Actividad']=="")
			{
			/*Con esto Insertamos la nueva actividad*/
				$lsSql="INSERT INTO tactividad (nombre,tipo_actividad) VALUES ('".$this->aa_Form['Nombre']."','".$this->aa_Form['CodigoTipoActividad']."')";
				$lbHecho=$this->fbEjecutarNoDie($lsSql);
				$IDTActividadIngresado=$this->fpGetIDinsertado();
			}
			else
			{
				$IDTActividadIngresado=$this->aa_Form['Actividad'];
			}

				$lsSql="INSERT INTO tagenda (
				idFcodigo_actividad,
				id_empresa,
				id_personaempresa,
				id_personacaidv,
				fecha_act_Inicio,
				hora_act_Inicio,
				fecha_act_Fin,
				hora_act_Fin,
				lugar,
				Estatus,
				EstadoAgenda
				) VALUES (
				'$IDTActividadIngresado',
				'".$this->aa_Form['Organizacion']."',
				'".$this->aa_Form['PersonaEncargada']."',
				'".$this->aa_Form['RepresentanteCAIDV']."',
				'".$this->aa_Form['Fecha_Ini']."',
				'".$this->aa_Form['Hora_Ini']."',
				'".$this->aa_Form['Fecha_Fin']."',
				'".$this->aa_Form['Hora_Fin']."',
				'".$this->aa_Form['Lugar_Enc']."',
				'P',2)";
																			
				$lbHecho=$this->fbEjecutarNoDie($lsSql);															
				$this->fpDesconectar();																										
																						
			return $lbHecho;																								
		}			

		public function fpModificarActividad($EstadoAgenda){		

			$lbHecho=false;
			$this->fpConectar();


			if ($this->aa_Form['Actividad']=="")
			{
			/*Con esto Insertamos la nueva actividad*/
				$lsSql="INSERT INTO tactividad (nombreact,tipo_actividad) VALUES ('".$this->aa_Form['Nombre']."','".$this->aa_Form['CodigoTipoActividad']."')";
				$lbHecho=$this->fbEjecutarNoDie($lsSql);
				$IDTActividadIngresado=$this->fpGetIDinsertado();
			}
			else
			{
				$IDTActividadIngresado=$this->aa_Form['Actividad'];
			}

				$lsSql="UPDATE tagenda SET 
				idFcodigo_actividad='$IDTActividadIngresado', 
				fecha_act_Inicio='".$this->aa_Form['Fecha_Ini']."', 
				fecha_act_Fin='".$this->aa_Form['Fecha_Fin']."', 
				hora_act_Inicio='".$this->aa_Form['Hora_Ini']."',  
				hora_act_Fin='".$this->aa_Form['Hora_Fin']."',  
				lugar='".$this->aa_Form['Lugar_Enc']."', 
				Estatus='".$this->aa_Form['estado']."',
				id_empresa='".$this->aa_Form['Organizacion']."',
				id_personaempresa='".$this->aa_Form['PersonaEncargada']."',
				id_personacaidv='".$this->aa_Form['RepresentanteCAIDV']."' 
				WHERE  codigoagenda='".$this->aa_Form['Codigo']."'";
				
				$lbHecho=$this->fbEjecutarNoDie($lsSql);															
				$this->fpDesconectar();																										
																						
			return $lbHecho;																								
		}																													
	/**********************************************************************************************************************/

	/************************ Funcion Guardar   ***************************************************************************/
	/* Se encarga de volcado de los datos en la base de datos															  */
	/**********************************************************************************************************************/
		public function fpDesactivar($variControl){	
			switch ($variControl)  //variControl tiene como valor el estatus actual, por eso si es 1 cambiaremos por un 0 y viceversa.
			{
				case '0':
					$variControl='1';
					break;
				case '1':
					$variControl='0';
					break;
			}
			$lbHecho=false;																									
			$lsSql="UPDATE tagenda SET 
				Estatus='A' 
				WHERE  codigoagenda='".$this->aa_Form['Codigo']."'";

				$this->fpConectar();	
				$lbHecho=$this->fbEjecutarNoDie($lsSql);															
				$this->fpDesconectar();			
																				
			return $lbHecho;																								
		}		

		

		public function faListarActividades($EstadoAgendaMostrar,$Reporte_FechaInicio,$Reporte_FechaFin)
		{

			$lsSql="SELECT 
			tage.codigoagenda,
			tage.idFcodigo_actividad,
			tage.fecha_act_Inicio,
			date_format(tage.fecha_act_Inicio,'%Y') AS Calendario_Anno,
			date_format(tage.fecha_act_Inicio,'%m') AS Calendario_Mes,
			tage.hora_act_Inicio,
			DATE_FORMAT(tage.hora_act_Inicio,'%h:%i %p') AS HoraExacta,
			tage.lugar,
			tage.EstadoAgenda,
			tage.FechaRegistro,
			tage.Estatus AS Agenda_Estatus,
			tacti.codigoActividad,
			tacti.nombreact AS Actividad_Nombre,
			tacti.tipo_actividad,
			tacti.estatusact AS Actividad_Estatus,
			tipoAc.idtipoactividad,
			tipoAc.nombretipoa AS TipoAct_Nombre,
			tipoAc.descripciontipoa,
			tipoAc.estatustipoa AS TipoAct_Estatus,
			FROM tagenda AS tage 
			LEFT JOIN tactividad AS tacti ON tage.idFcodigo_actividad = tacti.codigoActividad 
			INNER JOIN t_tipoactividad AS tipoAc ON tacti.tipo_actividad = tipoAc.idtipoactividad 
			WHERE tage.EstadoAgenda='".$EstadoAgendaMostrar."' AND tage.fecha_act_Inicio >= '$Reporte_FechaInicio' AND tage.fecha_act_Inicio <= '$Reporte_FechaFin'
			ORDER BY tage.fecha_actividad,tage.hora_act_Inicio";

			$laMatriz=array();
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			$liI=0;
			while($laArreglo=$this->faProximo($lrTb))
			{
				$laMatriz[$liI]["codigoAgenda"]=$laArreglo["codigoAgenda"];
				$laMatriz[$liI]["idFcodigo_actividad"]=$laArreglo["idFcodigo_actividad"];
				$laMatriz[$liI]["fecha_act_Inicio"]=$laArreglo["fecha_act_Inicio"];
				$laMatriz[$liI]["Calendario_Anno"]=$laArreglo["Calendario_Anno"];
				$laMatriz[$liI]["Calendario_Mes"]=$laArreglo["Calendario_Mes"];
				$laMatriz[$liI]["hora_act_Inicio"]=$laArreglo["hora_act_Inicio"];
				$laMatriz[$liI]["HoraExacta"]=$laArreglo["HoraExacta"];
				$laMatriz[$liI]["lugar"]=$laArreglo["lugar"];
				$laMatriz[$liI]["estado"]=$laArreglo["Estatus"];
				$laMatriz[$liI]["FechaRegistro"]=$laArreglo["FechaRegistro"];
				$laMatriz[$liI]["Agenda_Estatus"]=$laArreglo["Agenda_Estatus"];
				$laMatriz[$liI]["codigoActividad"]=$laArreglo["codigoActividad"];
				$laMatriz[$liI]["Actividad_Nombre"]=$laArreglo["Actividad_Nombre"];
				$laMatriz[$liI]["tipo_actividad"]=$laArreglo["tipo_actividad"];
				$laMatriz[$liI]["Actividad_Estatus"]=$laArreglo["Actividad_Estatus"];
				$laMatriz[$liI]["TipoAct_Nombre"]=$laArreglo["TipoAct_Nombre"];
				$laMatriz[$liI]["descripcion"]=$laArreglo["descripcion"];
				$laMatriz[$liI]["TipoAct_Estatus"]=$laArreglo["TipoAct_Estatus"];
				
				$liI++;

			}
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $laMatriz;
		}


	/**********************************************************************************************************************/
}