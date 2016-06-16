<?php
include_once("clsDatos.php");
class  cls_Listado_Cronograma extends  clsDatos{
		private $aa_Form;
		private $as_Cadena;

		public function __construct(){
			$this->aa_Form=Array();
			$this->as_Cadena="";
		}

		public function Listado_Cronograma()
		{

			$lsSql="SELECT a.fecha_act_inicio,a.fecha_act_fin,a.hora_act_inicio,a.hora_act_fin, e.Nombre as empresa, pe.primer_nombre as NE, pe.primer_apellido as AE, act.nombreact as actividad, p.nombreunoper as NP, p.apellidounoper as AP
					FROM `tagenda` as a
					inner join am_tempresa as e on(a.id_empresa=e.idEmpresa) 
					inner join am_tpersona as pe on(a.id_personaempresa=pe.idPersona)  
					inner join tactividad as act on(a.idFcodigo_actividad=act.codigoActividad) 
					inner join tpersonal as p on(a.id_personacaidv=p.idpersonal)
					WHERE a.Estatus=''";

			$laMatriz=array();
			$this->fpConectar();
			$lrTb=$this->frFiltro($lsSql);
			$liI=0;
			while($laArreglo=$this->faProximo($lrTb))
			{
				$laMatriz[$liI][0]=$laArreglo["empresa"];
				$laMatriz[$liI][1]=$laArreglo["NE"].' '.$laArreglo["AE"];
				$laMatriz[$liI][2]=$laArreglo["NP"].' '.$laArreglo["AP"];
				$laMatriz[$liI][3]=$laArreglo["actividad"];
				$laMatriz[$liI][4]=$laArreglo["fecha_act_inicio"];
				$laMatriz[$liI][5]=$laArreglo["fecha_act_fin"];
				$laMatriz[$liI][6]=$laArreglo["hora_act_inicio"];
				$laMatriz[$liI][7]=$laArreglo["hora_act_fin"];
				
				
				$liI++;

			}
			$this->fpCierraFiltro($lrTb);
			$this->fpDesconectar();
			
			return $laMatriz;
		}


	/**********************************************************************************************************************/
}