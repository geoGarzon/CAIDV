<?php


	include_once("../clases/cls_Calendario.php");
	require_once("menu_principal.php");
	require_once("encabezado.php");
	require_once("../clases/clsFuncionesGlobales.php");
	$loFuncion = new clsFunciones;
	$lobj_Calendario= new cls_Calendario();
	$lobj_Calendario->Cargar('tagenda'); //el numero 1 corresponde al tipo de Agenda, en este caso Diocesana
	$la_Campos=$_SESSION["Campos"];
	unset($_SESSION["Campos"]);
	$ano=$_GET["CalendarioA"];
	$mes=$_GET["CalendarioM"];
	if(!$ano)
	{
		$hoy=explode('/',DATE('Y/m/d'));
		$ano=$hoy[0];
		$mes=$hoy[1];
	}

	if (!empty($_POST["MatriEdo"])&&isset($_POST["MatriEdo"]))
	{
		$lsnvaCedula=$_POST["nvaCedula"];
		$lsnvoCedula=$_POST["nvoCedula"];
		$lsNvaNombre=$_POST["NvaNombre"];
		$lsNvoNombre=$_POST["NvoNombre"];
		$lsMatriSacer=$_POST["MatriSacer"];
		$lsMatriFecha=$_POST["MatriFecha"];
		$lsMatriMotivo=$_POST["MatriMotivo"];
		$lsMatriEdo=$_POST["MatriEdo"];
		$lsMatriEdoNum=$_POST["MatriEdoNum"];
	}

	$activaMotivo="disabled";
	if($lsnvaCedula!="")
	{
		$activaMotivo="";
	}


	$mes=$mes-1;
	echo utf8_Decode('

<!DOCTYPE html>
<html lang="es">
  <head>
		<title>'.$_SESSION['title'].' - Gestion de Matrimonio</title>
		');
			
	echo utf8_Decode('
	<link href="Calendario/css/fullcalendar.css" rel="stylesheet" />
	<link href="Calendario/css/fullcalendar.print.css" rel="stylesheet" media="print" />
	<script src="Calendario/javascript/jquery.min.js"></script>
	<script src="Calendario/javascript/jquery-ui.custom.min.js"></script>
	<script src="Calendario/javascript/fullcalendar.js"></script>
	<script>
	anoACargar='.$ano.';
	mesACargar='.$mes.';
	superWidth=\'127px\';
	superHeight=\'108px\';
	events = [');

		$lobj_Calendario->eventos();
		
	echo utf8_Decode(']
	$(document).ready(function() {
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();

		$(\'#calendar\').fullCalendar({
			theme: true,
			header: {
				left: \'prev,next today\',
				center: \'title\',
				rigth: \'gotoDate\'
			},
			editable: true,
			events: [');

		$lobj_Calendario->eventos();
		
	echo utf8_Decode(']

		});
		
	});

</script>
<style>

	body {
		text-align: center;
		font-size: 13px;
		font-family: \'Lucida Grande\',Helvetica,Arial,Verdana,sans-serif;
		}

	#calendar {
		width: 750px;
		margin:2px auto;
		float:left;
		margin-left:12%;
		margin-top:15px;
	}

div[Cabecera]{
	margin: 0px auto;
	width: 1024px;
	height: 50px;
	border: 1px solid silver;
	background: url(\'img/pie.png\') repeat-x;
	background-size: 100% 100%;
	border-radius: 10px 10px 0px 0px ;
}

div[Cabecera] p{
	font-size: 28px;
	float: left;
	margin: 6px 0px 0px 50px;
	text-shadow:1px 1px 5px #184B7C;
	color: #184B7C;
}

	div[Menu]{
		height: auto;
		min-height: 30px;
		background:silver;
		width: 100%;
		border: none;
		margin-top: 0px;

	}


.fc-header {
    	background: url(\'img/pie.png\') repeat-x;
	background-size: 100% 100%;
	text-shadow: 1px 1px 5px rgb(24, 75, 124);
	color: rgb(24, 75, 124);
}


</style>
</head>
		<body onload="cargar();">
		
		');
		
		
		
echo utf8_Decode('
			
					<div Cabecera>
						<p>Agenda CAIDV</p>
					</div>
					<div  id="calendar"></div>
					<div class="formulario" >
						<form method="POST" name="fr_agenda" id="fr_agenda" action="../../controlador/cn_agendaParroquial.php">	
							<h2>
							  Actividad 
							       <input type="button" value="x" onclick="this.parentNode.parentNode.parentNode.style.display=\'none\';">
							</h2>
							<input type="hidden" name="Codigo">
							<input type="hidden" name="txtOperacion" id="txtOperacion" value="">
							<input type="hidden" name="txtHay" id="txtHay" value="">
							<input type="hidden" name="Proyecto" value="'.$pro.'">	
							<table align="center">
								<tr>
									<td>
										<div id="containerActividad2" style="display:none;">
											<label>Tipo de Actividad</label><br>
											<select name="CodigoTipoActividad" onblur="">
											<option value="-">Seleccione</option>
											<br>
											  ');
											   echo utf8_decode($loFuncion->fncreateComboSelect("t_tipoactividad", "","idtipoactividad","", ' ',"","nombretipoa", $selecttipo_actividad,"", "", "")); 
											   echo utf8_Decode('
											   </select>
											<br>
											
										</div>
									</td>

									<td colspan="2">
										<div id="containerActividad1" style="display:none;">
											<label>Tema de Actividad</label><br>
											<input type="text" title="ingrese Nombre" validar="solo letras" requerido="obligatorio" name="Nombre" id="Nombre" value="'.$la_Campos['Nombre'].'" /><br>
										</div>
										<div id="containerActividad3" style="display:none;">
											<label>Seleccione Tema de Actividad</label><br>
											<select  requerido="obligatorio"name="Actividad"><option value="-">Seleccione</option>
											');
											echo utf8_decode($loFuncion->fncreateComboSelect("tactividad", "","codigoActividad","", ' ',"","nombreact", $selectactividad,"", "", "")); 
											echo utf8_Decode('
											</select>
										</div>
									</td>
								</tr>

									<td>
										<div id="containerActividad2" style="display:none;">
											<label>Tipo de Actividad</label><br>
											<select name="CodigoTipoActividad" onblur="">
											<option value="-">Seleccion</option>
											<br>
											  ');
											    echo utf8_decode($loFuncion->fncreateComboSelect("t_tipoactividad", "","idtipoactividad","", ' ',"","nombretipoa", $selecttipo_actividad,"", "", "")); 
											   echo utf8_Decode('
											   </select>
											<br>
											
										</div>

									</td>

								<tr>
										
										<td colspan="2">
											<label>Organizacion</label><br>
											<select name="Organizacion" onblur="">
											<option value="-">Seleccione</option>
											<br>
											  ');
											    echo utf8_decode($loFuncion->fncreateComboSelect("am_tempresa", "","idEmpresa","", ' ',"","nombre", $selectempresa,"", "", "")); 
											   echo utf8_Decode('
											   </select>
											<br>
											
										</td>

										<td colspan="2">
											<label>Persona Encargada Comunidad</label><br>
											<select name="PersonaEncargada" onblur="">
											<option value="-">Seleccione</option>
											<br>
											  ');
											   echo utf8_decode($loFuncion->fncreateComboSelect("am_tpersona", "","idPersona","", ' ',"","primer_nombre", $selectpersona,"", "", "")); 
											   echo utf8_Decode('
											   </select>
											<br>
											
										</td>

									</tr>

									<tr>
										<td colspan="2">
											<label>Representante CAIDV</label><br>
											<select name="RepresentanteCAIDV" onblur="">
											<option value="-">Seleccione</option>
											<br>
											  ');
											    echo utf8_decode($loFuncion->fncreateComboSelect("tpersonal", "","idpersonal","", ' ',"","nombreunoper", $selectpersonal,"", "", "")); 
											   echo utf8_Decode('
											   </select>
											<br>
											
										</td>


									</tr>

								<tr>
									
									<td colspan="2">
											<label>Fecha Inicio</label>
											<input type="date" maxlength="10" placeholder="01-12-1991" validar="Fecha_Ini" name="Fecha_Ini" requerido="obligatorio" value="'.$la_Campos['Fecha'].'" />
									</td>

									<td colspan="2">
											<label>Fecha final </label>
									
											     <input type="date" onblur="validarFecha(this)" name="Fecha_Fin" onblur="" requerido="obligatorio" value="'.$la_Campos['Fecha_Fin'].'" />
									</td>
								</tr>
								<tr>
									
									<td colspan="2">
											<label>Hora inicio </label
											<br>
											   <input type="time" validar="Hora_Ini" name="Hora_Ini" onblur="" requerido="obligasstorio" value="'.$la_Campos['Hora_Ini'].'" />
											 <br>
									</td>


									<td colspan="2">
											<label>Hora final </label>
											<input type="time" validar="Hora_Ini" name="Hora_Fin" onblur="validarHora();" requerido="obligatorio" value="'.$la_Campos['Hora_Fin'].'" />
									</td>
								</tr>
								<tr>
									<td colspan="3">
											<label>Lugar de Encuentro</label>
											<br>
											     <textarea name="Lugar_Enc"></textarea>
											 <br>
									</td>

									<td colspan="2">
											<label>Estado </label>									
											     <select name="estado" >
											     	<option value="-"> Seleccione un estado</option>
											     	<option value="P">Planificado</option>
											     	<option value="A">Anulado</option>
											     	<option value="C">Completado</option>
											     	<option value="E">En Ejecucion</option>
											     </select>
									</td>

								</tr>

								
								<tr>
									<td>
										<input type="hidden" name="btn_Despli" id="btn_Despli" onclick="fpDespliegaActividades();" style="float:left;" value="Nueva Actividad">
									</td>

									<td>
										<input type="button" onclick="fGuardar();" value="Guardar"/>

									</td>
									
								</tr>
							</table>
								<input type="hidden" value="0" name="ModoActividad" id="ModoActividad">
								<input type="hidden" value="0" name="EstatusAgenda" id="EstatusAgenda">
								
						</form>
					</div>
				
		
			
	</div>
	</div>
	');
	footer(); // pie de pagina
	echo utf8_decode('
</div>

</body>
<script type="text/javascript">
var loF=document.fr_agenda;
	function cargar(){
		var lista=document.getElementsByTagName(\'td\');
		let hoy = new Date().toJSON().slice(0,10);
		for(var x=0;x<lista.length;x++){
			if(lista[x].classList.contains(\'fc-day\')){
				//validacion solo actividades para fechas mayores al dia de hoy
				if(validate_fechaMayorQue(hoy,lista[x].getAttribute("data-date"))){
					lista[x].onclick=function(){cargaFormulario(this.getAttribute(\'data-date\'),this.getAttribute(\'data-date\'),\'\',\'\',\'\',\'-\',this,\'\',\'-\',\'-\',\'-\',\'\');};
				}			
			}
		}
		lista=document.getElementsByTagName(\'span\');
		for(var y=0;y<lista.length;y++){
			lista[y].onclick=function(){setTimeout(\'cargar()\',50);};
		}
		lista=document.getElementsByTagName(\'div\');
		for( y=0;y<lista.length;y++){
			if(lista[y].classList.contains(\'fc-event-inner\')){	
				lista[y].onclick=function(){cargaFormulario(this.parentNode.getAttribute(\'inicia\'),this.parentNode.getAttribute(\'finaliza\'),this.parentNode.getAttribute(\'hora_ini\'),this.parentNode.getAttribute(\'codigo\'),this.parentNode.getAttribute(\'nombre\'),this.parentNode.getAttribute(\'Actividad\'),this.parentNode,this.parentNode.getAttribute(\'lugar_enc\'),this.parentNode.getAttribute(\'tipo_acti\'),this.parentNode.getAttribute(\'evento_estatus\'));};
			}
		}
		loF.txtOperacion.value="modificar";

	}
	function dayClick(date){
		console.log(date);
		calendar=document.getElementById(\'calendar\');
    	calendar.fullCalendar(\'gotoDate\', date);
    	calendar.fullCalendar(\'changeView\',\'agendaDay\');
	}
	//-------------------------------validacion fecha ----------------------------------------
	function validarFecha(nodoFechaFin){
		let fechaFin = nodoFechaFin.value;
		let fechaInicio = document.querySelector(\'input[name="Fecha_Ini"]\').value;
		if(validate_fechaMayorQue(fechaInicio,fechaFin)){
			console.log("paso");
		}else{
			nodoFechaFin.value = fechaInicio;
		}
	}
	function validate_fechaMayorQue(fechaInicial,fechaFinal)
        {
        	if(fechaFinal!=""){

	            valuesStart=fechaInicial.split("-");
	            valuesEnd=fechaFinal.split("-");
	 
	            // Verificamos que la fecha no sea posterior a la actual
	            var dateStart=new Date(valuesStart[0],(valuesStart[1]-1),valuesStart[2]);
	            var dateEnd=new Date(valuesEnd[0],(valuesEnd[1]-1),valuesEnd[2]);
	            if(dateStart>=dateEnd)
	            {
	                return 0;
	            }
	            return 1;
        	}else{
        		return 0;
        	}
        }
	//-------------------------------fin validacion fecha ------------------------------------
    //-------------------------------validacion de hora ------------------------------------
    function validarHora(){
    	let horafin = document.querySelector(\'input[name="Hora_Fin"]\').value;
    	let horaini = document.querySelector(\'input[name="Hora_Ini"]\').value;
    	if(!validar_horaMayor(horaini,horafin)){
    		document.querySelector(\'input[name="Hora_Fin"]\').value = document.querySelector(\'input[name="Hora_Ini"]\').value;
    		document.querySelector(\'input[name="Fecha_Fin"]\').value = document.querySelector(\'input[name="Fecha_Ini"]\').value;
    	}else{
    		console.log("no entro");
    	}
    }
    function validar_horaMayor(hora_ini,hora_fin){

    	if(hora_fin!=""){
    		valuesStart = document.querySelector(\'input[name="Fecha_Ini"]\').value.split("-");
	        valuesEnd = document.querySelector(\'input[name="Fecha_Fin"]\').value.split("-");
	 		valuesHoraStart = hora_ini.split(":");	
	 		valuesHoraFin = hora_fin.split(":");

    		// Verificamos que la fecha no sea posterior a la actual
	        var dateStart=new Date(valuesStart[0],(valuesStart[1]-1),valuesStart[2],valuesHoraStart[1],valuesHoraStart[0]);
	        var dateEnd=new Date(valuesEnd[0],(valuesEnd[1]-1),valuesEnd[2],valuesHoraFin[1],valuesHoraFin[0]);
    		if(dateStart>dateEnd)
            {
                return 0;
            }
            return 1;

    	}else{
    		return 0;
    	}
    }
    //-------------------------------validacion de fin hora ------------------------------------
	function f_cambiar(obj,padre){
		console.log("linea");
		obj.style.transition = \'all 1s ease-out 0.5s\';	
		obj.style.display=\'block\';
		obj.style.marginTop = \'calc(15%)\';
		obj.style.marginLeft = \'calc(15%)\';	
		loF.txtOperacion.value="incluir";
		loF.ModoActividad.value=\'1\';
		fpDespliegaActividades();
	}
	function cargaFormulario(fechaInicio,fechaFin,hora_ini,codigo,nombre,Actividad,objeto,lugar_enc,tipo_acti,even_estatus){
		var obj=document.getElementsByClassName(\'formulario\');
		f_cambiar(obj[0],objeto);
		if(codigo!=\'\'){
			loF.txtOperacion.value="modificar";
			//document.getElementsByName(\'Eliminar\')[0].style.display=\'block\';
		}else {
			//document.getElementsByName(\'Eliminar\')[0].style.display=\'none\';
		}
		if(even_estatus==\'C\')
		{
			for(let x = 0; x < document.fr_agenda.length; x++){
				document.fr_agenda[x].disbled=true;
			}
		}
		else
		{
			//document.getElementsByName(\'Eliminar\')[0].value=\'Reactivar\';
		}

		var a = fechaInicio.substring(0,4);
		var m = fechaInicio.substring(5,7);
		var d = fechaInicio.substring(8,10);
		if(codigo){
			if(m==\'00\'){
				m=\'01\';
			}else{
				m=parseInt(m)+1;
			}
		}
		if(d.length==1){
			d=\'0\'+d;
		}
		if(m.toString().length==1){
			m=\'0\'+m;
		}
		document.getElementsByName(\'Fecha_Ini\')[0].value=a+\'-\'+m+\'-\'+d;
		var a = fechaFin.substring(0,4);
		var m = fechaFin.substring(5,7);
		var d = fechaFin.substring(8,10);
		if(codigo){
			if(m==\'00\'){
				m=\'01\';

			}else{
				m=parseInt(m)+1;
			}
		}
		if(d.length==1){
			d=\'0\'+d;
		}
		if(m.toString().length==1){
			m=\'0\'+m;
		}
		document.getElementsByName(\'Fecha_Ini\')[0].value=objeto.getAttribute("inicia");
		document.getElementsByName(\'Fecha_Fin\')[0].value=objeto.getAttribute("finaliza");
		document.getElementsByName(\'Codigo\')[0].value=codigo;
		document.getElementsByName(\'Actividad\')[0].value=Actividad;
		document.getElementsByName(\'Hora_Ini\')[0].value=hora_ini;
		document.getElementsByName(\'Hora_Fin\')[0].value=objeto.getAttribute("hora_fin");
		document.getElementsByName(\'Lugar_Enc\')[0].value=lugar_enc;
		document.getElementsByName(\'Nombre\')[0].value=nombre;
		document.getElementsByName(\'CodigoTipoActividad\')[0].value=tipo_acti;
		document.getElementsByName(\'EstatusAgenda\')[0].value=even_estatus;
		document.getElementsByName(\'Organizacion\')[0].value=objeto.getAttribute("org");
		document.getElementsByName(\'estado\')[0].value=objeto.getAttribute("estado");
		document.getElementsByName(\'PersonaEncargada\')[0].value=objeto.getAttribute("per_emp");
		document.getElementsByName(\'RepresentanteCAIDV\')[0].value=objeto.getAttribute("per_caidv");
		loF.Actividad.focus();
	}

	function fpDespliegaActividades()
	{
		loF.Actividad.value=\'-\';
		loF.Nombre.value=\'\';
		loF.CodigoTipoActividad.value=\'\';
		if (loF.ModoActividad.value==\'0\')
		{
			loF.Actividad.disabled=true;
			document.getElementById(\'containerActividad1\').style.display=\'block\';
			document.getElementById(\'containerActividad2\').style.display=\'block\';
			document.getElementById(\'containerActividad3\').style.display=\'none\';
			loF.btn_Despli.value=\'Seleccionar Actividad\';
			loF.ModoActividad.value=\'1\';
			loF.Nombre.focus();
		}
		else
		{
			loF.Actividad.disabled=false;
			document.getElementById(\'containerActividad1\').style.display=\'none\';
			document.getElementById(\'containerActividad2\').style.display=\'none\';
			document.getElementById(\'containerActividad3\').style.display=\'block\';
			loF.btn_Despli.value=\'Nueva Actividad\';
			loF.ModoActividad.value=\'0\';
			loF.Actividad.focus();
		}
	}


	function fbValidar()
	{
		var lbValido=false;
		var vInvalido=0;
		var ModoFormu=loF.ModoActividad.value;
				
			if(loF.Lugar_Enc.value=="")
			{
				console.log("Escriba un lugar para la Actividad.");
				loF.Lugar_Enc.focus();
				vInvalido=1;
			}
			if(loF.Hora_Ini.value=="")
			{
				console.log("Indique una Hora para la Actividad.");
				loF.Hora_Ini.focus();
				vInvalido=1;
			}
			if(loF.Fecha_Ini.value=="")
			{
				console.log("Indique una Fecha para la Actividad.");
				loF.Fecha_Ini.focus();
				vInvalido=1;
			}
			switch(ModoFormu) 
			{
			    case \'1\':

					if(loF.CodigoTipoActividad.value=="-")
					{
						console.log("Seleccione Tipo de Actividad.");
						loF.CodigoTipoActividad.focus();
						vInvalido=1;
					}
				   	
				
					if(loF.Nombre.value=="")
					{
						console.log("Escriba un Nombre para la Actividad.");
						loF.Nombre.focus();
						vInvalido=1;
					}

			    break;
			    case \'0\':
			       	if(loF.Actividad.value=="-")
					{
						console.log("Seleccione una Actividad.");
						loF.Actividad.focus();
						vInvalido=1;
					}
			    break;
			}
			if(validarEmp()){
				
			}			
			if (vInvalido==0)
			{
				lbValido=true;
			}

		return lbValido;
	}

	function validarEmp(){
		for(let x = 0; x < events.length; x++){
			let org = document.getElementsByName(\'Organizacion\')[0].value;
			let per_emp = document.getElementsByName(\'PersonaEncargada\')[0].value;
			let per_caidv = document.getElementsByName(\'RepresentanteCAIDV\')[0].value;
			let codigo = document.getElementsByName(\'Codigo\')[0].value
			//fechas
			let fecha_ini = document.getElementsByName(\'Fecha_Ini\')[0].value.split("-");
			let fecha_fin = document.getElementsByName(\'Fecha_Fin\')[0].value.split("-");

			fecha_ini = new Date(fecha_ini[0],(fecha_ini[1]-1),fecha_ini[2]);
			fecha_fin = new Date(fecha_fin[0],(fecha_fin[1]-1),fecha_fin[2]);

			if(!(codigo==events[x].id)){

					
				if((fecha_ini <= events[x].end && fecha_ini >= events[x].start)||(fecha_fin <= events[x].end && fecha_fin >= events[x].start)){
					if(events[x].org === org){
						alert("organizacion ocupada");
						return false;
					}
					if(events[x].per_emp === per_emp){
						alert("Responsable empresa ocupado");
						return false;
					}
					if(events[x].per_caidv === per_caidv){
						alert("Responsable CAIDV ocupado");
						return false;
					}
				}
			}
		}
		return true;
	}

	function fGuardar(){
	
		if(fbValidar())
			{

				var $forme = $("#fr_agenda");
					$.ajax(
					{
						url: \'../controlador/cn_agendaParroquial.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data)
				        {
      					    var ReAgenda=data[\'Agenda\'];
							
							if ((loF.txtOperacion.value=="incluir")&&(ReAgenda.liHay==0))
							{
								console.log("No se pudo incluir el Registro.");
							}

							if ((loF.txtOperacion.value=="incluir")&&(ReAgenda.liHay==1))
							{

								console.log("Registro incluido con exito.");
								setTimeout(function(){document.location.href = "?vista=cronograma/gestAgendaParroquial"; }, 1000);
								
							}

							if ((loF.txtOperacion.value=="modificar")&&(ReAgenda.liHay==0))
							{
								console.log("No se pudo modificar el Registro.");
							}

							if ((loF.txtOperacion.value=="modificar")&&(ReAgenda.liHay==1))
							{

								console.log("Registro modificado con exito.");
								setTimeout(function(){ document.location.href = "?vista=cronograma/gestAgendaParroquial"; }, 1000);

							}
						}
					});
			}
	}
		function f_Eliminar(){
			if (confirm(\'Desea Continuar con la operación?\'))
			{

				loF.txtOperacion.value=\'ActualizaEstado\';
				var $forme = $("#fr_agenda");
					
					$.ajax(
					{
						url: \'../controlador/cn_agendaParroquial.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data)
				        {
				        	console.log(data);
      					    var ReAgenda=data[\'Agenda\'];
      					    var NuevoEstado=\'\';

      					    if (ReAgenda.EstatusAgenda==\'0\')
      					    {
      					    	NuevoEstado=\'Reactivado\';
      					    }
      					    else
      					    {
      					    	NuevoEstado=\'Desactivado\';
      					    }

							if ((loF.txtOperacion.value=="ActualizaEstado")&&(ReAgenda.liHay==0))
							{
								console.log("El registro no pudo ser "+NuevoEstado+".");
							}

							if ((loF.txtOperacion.value=="ActualizaEstado")&&(ReAgenda.liHay==1))
							{

								console.log("Registro "+NuevoEstado+" con exito.");
								setTimeout(function(){ document.location.href = "?vista=cronograma/gestAgendaParroquial";  }, 1000);
								
							}
						}
					});
			}
		}
	
</script>



</html>
'); 


?>
