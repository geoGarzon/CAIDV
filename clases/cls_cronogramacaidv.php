<?php
include_once("clsDatos.php");
class  cls_cronogramacaidv extends  clsDatos{
		private $aa_Form;
		private $as_Cadena;

		public function __construct()
		{
			$this->aa_Eventos=Array();
			$this->as_Cadena="";
		}
		public function __destruct()
		{
		}
		public function Cargar($tabla){
			$this->f_VerificarEventos();
			$lii=0;
			$ls_Sql="SELECT 
			tage.codigoAgenda,
			tage.idFcodigo_actividad,
			tage.fecha_act_Inicio,
			tage.hora_act_Inicio,
			tage.fecha_act_Fin,
			tage.hora_act_Fin,
			DATE_FORMAT(tage.hora_act_Inicio,'%h:%i %p') AS HoraExactaInicio,
			DATE_FORMAT(tage.hora_act_Fin,'%h:%i %p') AS HoraExactaFin,
			tage.lugar,
			tage.FechaRegistro,
			tage.EstadoAgenda,
			tage.Estatus AS Agenda_Estatus,
			tage.id_empresa AS organizacion,
			tage.id_personacaidv AS persona_caidv,
			tage.id_personaempresa AS persona_empresa,
			tacti.codigoActividad,
			tacti.nombreact,
			tacti.tipo_actividad
			FROM ".$tabla." AS tage 
			LEFT JOIN tactividad AS tacti ON tage.idFcodigo_actividad = tacti.codigoActividad
			WHERE tage.estatus <> 'u'";							
			$this->fpConectar();																								
			$lr_Tabla=$this->frFiltro($ls_Sql);																			
			while($la_Tupla=$this->faProximo($lr_Tabla)){		
				$this->aa_Eventos[$lii]["Codigo"]=$la_Tupla["codigoAgenda"];
				$this->aa_Eventos[$lii]["Actividad"]=$la_Tupla["idFcodigo_actividad"];
				$this->aa_Eventos[$lii]["Organizacion"]=$la_Tupla["organizacion"];
				$this->aa_Eventos[$lii]["Persona_caidv"]=$la_Tupla["persona_caidv"];
				$this->aa_Eventos[$lii]["Persona_empresa"]=$la_Tupla["persona_empresa"];
				$this->aa_Eventos[$lii]["Fecha_Ini"]=$la_Tupla["fecha_act_Inicio"];
				$this->aa_Eventos[$lii]["Hora_Ini"]=$la_Tupla["hora_act_Inicio"];
				$this->aa_Eventos[$lii]["Fecha_Fin"]=$la_Tupla["fecha_act_Fin"];
				$this->aa_Eventos[$lii]["Hora_Fin"]=$la_Tupla["hora_act_Fin"];
				$this->aa_Eventos[$lii]["HoraExacta"]=$la_Tupla["HoraExactaInicio"];
				$this->aa_Eventos[$lii]["HoraExactaFin"]=$la_Tupla["HoraExactaFin"];
				$this->aa_Eventos[$lii]["lugar_enc"]=$la_Tupla["lugar"];
				$this->aa_Eventos[$lii]["Fecha_Registro"]=$la_Tupla["FechaRegistro"];
				$this->aa_Eventos[$lii]["Nombre"]=$la_Tupla["nombreact"];
				$this->aa_Eventos[$lii]["tipo_acti"]=$la_Tupla["tipo_actividad"];
				$this->aa_Eventos[$lii]["EstadoAgenda"]=$la_Tupla["EstadoAgenda"];
				$this->aa_Eventos[$lii]["Agenda_Estatus"]=$la_Tupla["Agenda_Estatus"];
				$this->aa_Eventos[$lii]["Actividad_Estatus"]=$la_Tupla["Actividad_Estatus"];
				$this->aa_Eventos[$lii]["Color"]="ff0000";

				$lii++;
			}		
			$this->fpCierraFiltro($lr_Tabla);
			$this->fpDesconectar();

		}
		public function eventos(){
			for($lix=0;$lix<count($this->aa_Eventos);$lix++){
				$diaI=substr($this->aa_Eventos[$lix]["Fecha_Ini"], 8,2);
				$diaF=substr($this->aa_Eventos[$lix]["Fecha_Fin"], 8,2);
				$diar=substr($this->aa_Eventos[$lix]["Fecha_Registro"], 8,2);
				$mesI=substr($this->aa_Eventos[$lix]["Fecha_Ini"], 5,2);
				$mesF=substr($this->aa_Eventos[$lix]["Fecha_Fin"], 5,2);
				$mesr=substr($this->aa_Eventos[$lix]["Fecha_Registro"], 5,2);
				$anoI=substr($this->aa_Eventos[$lix]["Fecha_Ini"], 0,4);
				$anoF=substr($this->aa_Eventos[$lix]["Fecha_Fin"], 0,4);
				$anor=substr($this->aa_Eventos[$lix]["Fecha_Registro"], 0,4);
				echo "\n\t{";
				echo "\n\t\tid: ".$this->aa_Eventos[$lix]["Codigo"].",";
				echo "\n\t\ttitle: '".$this->aa_Eventos[$lix]["Nombre"]."',";
				echo "\n\t\tstart: new Date($anoI,".($mesI-1).",$diaI),";
				echo "\n\t\tend: new Date($anoF,".($mesF-1).",$diaF),";
				echo "\n\t\treg: new Date('$anor','".($mesr-1)."','$diar').toJSON().slice(0,10),";
				echo "\n\t\thora_ini: '".$this->aa_Eventos[$lix]["Hora_Ini"]."',";
				echo "\n\t\thora_fin: '".$this->aa_Eventos[$lix]["Hora_Fin"]."',";
				echo "\n\t\tactividad: ".$this->aa_Eventos[$lix]["Actividad"].",";
				echo "\n\t\ttipo_acti: ".$this->aa_Eventos[$lix]["tipo_acti"].",";
				echo "\n\t\torg: '".$this->aa_Eventos[$lix]["Organizacion"]."',";
				echo "\n\t\tper_caidv: '".$this->aa_Eventos[$lix]["Persona_caidv"]."',";
				echo "\n\t\tper_emp: '".$this->aa_Eventos[$lix]["Persona_empresa"]."',";
				echo "\n\t\tlugar_enc: '".$this->aa_Eventos[$lix]["lugar_enc"]."',";
				echo "\n\t\tcolor: '".$this->aa_Eventos[$lix]["Color"]."'";
				if($lix!=count($this->aa_Eventos)-1){
					echo "\n\t},";
				}else{
					echo "\n\t}";
				}
			}
		}
		
		public function f_Cabecera(){
		echo "<div ddt>
				<input type='button' id='atras' title='Atras' onclick='window.history.back();'>
				<div id='nom_usu'>";
					print('<span align="right">Bienvenido: '.$_SESSION['usuario']['Nombre'].'</span>');
					print('<span id="hora">Hora: '.date('h:i:s').'</span>');
					print('<span id="hora">Fecha: '.date('d-m-Y').'</span>');
				echo "</div>";
		echo"</div>";
	}
	public function f_VerificarEventos(){
		echo '<br><br>entro';
		$ls_Sql = "SELECT * FROM tagenda WHERE Estatus <> 'A'";
		$this->fpConectar();																								
			$lr_Tabla=$this->frFiltro($ls_Sql);																			
			while($la_Tupla=$this->faProximo($lr_Tabla)){		
				$Codigo=$la_Tupla["codigoAgenda"];
				$Fecha_Ini=$la_Tupla["fecha_act_Inicio"];
				$Fecha_Fin=$la_Tupla["fecha_act_Fin"];
				$status=$la_Tupla["Estatus"];
				//comparo fechas contra la actual
				$fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
				$Fecha_Ini = strtotime($Fecha_Ini." 00:00:00");
				$Fecha_Ini = strtotime($Fecha_Fin." 00:00:00");
				if($Fecha_Ini <= $fecha_actual){
					if($Fecha_Fin < $fecha_actual){
						//completada
						if($estatus != 'C'){
							$ls_Sql = "UPDATE tagenda SET Estatus = 'C' WHERE codigoAgenda = '".$Codigo."'";
							$lb_Hecho = $this->fbEjecutar($ls_Sql);
						}
					}else{
						//en ejecucion
						if($estatus != 'E'){
							$ls_Sql = "UPDATE tagenda SET Estatus = 'E' WHERE codigoAgenda = '".$Codigo."'";
							$lb_Hecho = $this->fbEjecutar($ls_Sql);
						}
					}
				}
			}		
			$this->fpCierraFiltro($lr_Tabla);
			$this->fpDesconectar();
	}
}
