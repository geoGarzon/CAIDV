<?php


  session_start();
  if(!array_key_exists("usuario", $_SESSION)) 
	{
		header("location: visSalir.php");
	}

	require_once("menu_principal.php");
	require_once("encabezado.php");
	require_once("../clases/clsFuncionesGlobales.php");
	$loFuncion = new clsFunciones;
	echo utf8_Decode('

<!DOCTYPE html>
<html lang="es">
  <head>
		<title>'.$_SESSION['title'].' - Configuración</title>
		');
			

	echo utf8_Decode('
		</head>
		<body onload="fpInicio();">
		<div class="mygrid-wrapper-div">
	<div class="container pre-scrollable" style="margin-top:5px; min-height: 530px; background: #FFFFFF; -webkit-box-shadow: 2px 0px 10px 2px #999; -moz-box-shadow: 2px 0px 10px 2px #999; box-shadow: 2px 0px 10px 2px #999;">


		');
		//encab("../");
	
		
echo utf8_Decode('
	
	<form name="fr_configuracion" id="fr_configuracion" action="../controlador/cn_confCombos.php" method="post">
		<div class ="col-lg-12"> 
		<input type="hidden" id="temporal"> </input>
		<table class="table table-striped table-bordered table-hover" border="1">
			<thead>
				<tr>
					<th colspan="2"> 
					<center> Configuración de Tipo de Actividad </center>
					</th>
				</tr>

				<tr colspan="2">
					<th>
						<center>
							<div class="form-group has-default" onclick="fpAvisaSeleccionar(document.getElementById(\'KcodCombo\').value);"
								id="haf_listarTipoActividad" style="width:400px;">
								<div class="on-focus clearfix" style="position: relative;">
									<font class="control-label">
										Tipo de Actividad a Editar:	
									</font>
									<br/>
									<select title="Debe presionar el botón \'Seleccionar\' antes de editar un elemento." name="f_listarTipoActividad" class="form-control" size="8" onchange="SeleccionaItem(this.value);"
									 id="f_listarTipoActividad" value = "">');
/*									echo utf8_decode($loFuncion->fncreateComboSelectConfDos("t_tipoactividad", "idtipoactividad", "nombretipoa", $selectt_tipoactividad));
*/
									echo utf8_decode(' 
										</select>

										<div class="tool-tip slideIn" di="ttipf_listarTipoActividad" style="display:none;">

										</div>



								</div>
							</div>
							
							<div class="form-group has-default" id="haf_descripcion" style="width:200px;">
								<div class="on-focus clearfix" style="position:relative">
									<font class="control-label">
										Nombre:
									</font>
									<input type="text" id="f_descripcion" name="f_descripcion" class="form-control" onkeypress="vSoloLetras();" onblur="this.value= this.value.toUpperCase(); vCampoVacio(this.id);" value="">
									<div class="tool-tip  slideIn" id="ttipf_descripcion" style="display:none;"></div>
								</div>
							</div>


						</center>	
					</th>
				</tr>

				<tr colspan="2">
					<th><center>

						<div class="form-group has-default" id="haKcodForaneo" style="width:400px;"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">Descripción:</font><input type="text" id="KcodForaneo" name="KcodForaneo" class="form-control" onkeypress="vSoloLetras();" onblur="this.value=this.value.toUpperCase(); vCampoVacio(this.id);" value=""><div class="tool-tip  slideIn" id="ttipKcodForaneo" style="display:none;"></div></div></div>


							</center>
					</th>
					
				</tr>
				
			</thead>
		</table>
		</div>	
	</form>

<br>


</div>
	</div>
	<div class="container" style="margin-top:5px; padding:5px; min-height: auto; background: #FFFFFF; -webkit-box-shadow: 0px 2px 5px 2px #999; -moz-box-shadow: 2px 2px 5px #999;">
		<table class="table table-striped table-bordered table-hover" border="1" style="margin:0px">	
		<tr>
			<th colspan="2"><center>
					<input type="hidden" name="txtOperacion" id="txtOperacion" value="">
					<input type="hidden" name="txtHay" id="txtHay" value="">
					<input type="hidden" name="KcodCombo" id="KcodCombo" value="">
					<input type="hidden" name="KcharSelector" value="t_tipoactividad">
					<input type="hidden" name="KestadoActual" id="KestadoActual" value="">
					<input type="button" class="btn btn-primary" name="b_Nuevo" value="Nuevo" onclick="fpNuevo()">
					<input type="button" class="btn btn-primary" name="b_Modificar" value="Modificar" onclick="fpModificar()">
					<input type="button" class="btn btn-primary" name="b_Buscar" value="Seleccionar" onclick="fpSeleccionar()">
					<input type="button" class="btn btn-primary" name="b_Eliminar" value="Desactivar" onclick="fpDesactivar()">
					<input type="button" class="btn btn-primary" name="b_Guardar" value="Guardar" onclick="fpGuardar()">
					<input type="button" class="btn btn-primary" name="b_Cancelar" value="Cancelar" onclick="fpCancelar()"></center>
			</th>
		</tr>		
		</table>
	</div>');

	footer(); // pie de pagina

	echo utf8_decode('</form>
</div>

</body>
<script>
	var loF=document.fr_configuracion;
	function fpInicio()
	{	

			fpInicial();
			fpCancelar();
						

	}
		
		function fpNuevo()
		{
			fpCambioN();
			loF.KcodForaneo.disabled=false;
			loF.f_descripcion.disabled=false;
			loF.txtOperacion.value="incluir";
			loF.f_descripcion.focus();
		}
		
		function fpEncender()
		{

			loF.f_listarTipoActividad.disabled=false;
			loF.KcodForaneo.disabled=false;
			loF.f_descripcion.disabled=false;

			
		}

		function fpApagar()
		{

			loF.f_listarTipoActividad.disabled=true;
			loF.KcodForaneo.disabled=true;
			loF.f_descripcion.disabled=true;
			loF.KestadoActual.value=2;
			fpEstadoActual();

		}
		
		function fpCancelar()
		{

			loF.txtOperacion.value="";
			loF.txtHay.value=0;
			loF.f_listarTipoActividad.value="";
			loF.KcodForaneo.value="";
			loF.f_descripcion.value="";
			$( ".tool-tip.slideIn" ).each(function(i) {$(this).css( "display", "none" );});
			$( ".form-group.has-error" ).each(function(i) {$(this).attr( "class", "form-group has-default" );});
			loF.KcodCombo.value="";
			fpApagar();
			fpInicial();

		}

		function buscar()
		{
			var mas = document.getElementById("mascara");
			var bus = document.getElementById("buscador");

			mas.style.display = "block";
			bus.style.display = "block";

			document.getElementById("txtbuscador").focus();
		}

		function fpModificar()
		{
			loF.txtOperacion.value="modificar";
			loF.txtHay.value=0;
			loF.f_listarTipoActividad.disabled=true;
			loF.KcodForaneo.disabled=false;
			loF.f_descripcion.disabled=false;
			loF.f_descripcion.focus();
			fpCambioN();

		}


		function fpSeleccionar()
		{
			loF.txtOperacion.value="seleccionar";
			loF.txtHay.value=0;
			loF.f_listarTipoActividad.disabled=false;

			fpCambioE();
			
		}

		function SeleccionaItem()
		{
			var valueIndex=loF.f_listarTipoActividad.selectedIndex;
			var arraySelectValue=loF.f_listarTipoActividad.options[loF.f_listarTipoActividad.selectedIndex].value;
			arraySelectValue=arraySelectValue.split(\'*\');
			loF.f_descripcion.value=loF.f_listarTipoActividad.options[valueIndex].text;
			loF.KcodCombo.value=loF.f_listarTipoActividad.options[valueIndex].value;


			$("#f_listarTipoActividad option[value="+loF.f_listarTipoActividad.options[valueIndex].className.replace(\'Mu\', \'\')+"]").attr("selected",true);
			loF.KcodForaneo.value=arraySelectValue[1];
			loF.txtOperacion.value="busestatusact";
			var $forme = $("#fr_configuracion");

			$.ajax({
				url: \'../controlador/cn_confCombos.php\',
				dataType: \'json\',
				type: \'post\',
				data: $forme.serialize(),
		        success: function(data){
		        	var Confi=data[\'Confi\'];
					if(Confi.liHay==1)
					{
							loF.KestadoActual.value=Confi.lsestatusact;	
							fpEstadoActual();	
					}
					else	
					{
							NotificaE("Error en el Estatus del elemento.");
															
					}
					
				}
			});

		}

		function fpEstadoActual()
		{
			var KedoActual=loF.KestadoActual.value;
			if(KedoActual==1)
			{
				loF.b_Eliminar.value="Desactivar";

			}
			else if(KedoActual==2)
			{
				loF.b_Eliminar.value="Estado";

			}
			else
			{
				loF.b_Eliminar.value="Activar";
			}
			
		}

				
		function fpDesactivar()
		{
			if (loF.b_Eliminar.value=="Desactivar")
			{
				if(confirm("Desea Desactivar a "+loF.f_descripcion.value+"?"))
				{
					loF.txtOperacion.value="desactivar";
					var $forme = $("#fr_configuracion");

					$.ajax({
						url: \'../controlador/cn_confCombos.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data){
				        	var Confi=data[\'Confi\'];
							if(Confi.liHay==1)
							{
									fpCancelar();
									NotificaS(loF.f_descripcion.value+" Desactivado");
									setTimeout(function(){ document.location.reload(); }, 1500);
									fpInicial();							
							}
							else	
							{
									fpCancelar();
									NotificaE("No se pudo Desactivar "+loF.f_descripcion.value+".");
									fpInicial();									
							}
							
						}
					});

				}
			}
			if (loF.b_Eliminar.value=="Activar")
			{
				if(confirm("Desea Reactivar a "+loF.f_descripcion.value+"?"))
				{
					loF.txtOperacion.value="reactivar";
					var $forme = $("#fr_configuracion");

					$.ajax({
						url: \'../controlador/cn_confCombos.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data){
				        	var Confi=data[\'Confi\'];
							if(Confi.liHay==1)
							{
									fpCancelar();
									NotificaS(loF.f_descripcion.value+" Reactivado");
									setTimeout(function(){ document.location.reload(); }, 1500);

									fpInicial();							
							}
							else	
							{
									fpCancelar();
									NotificaE("No se pudo Reactivar "+loF.f_descripcion.value+".");

									fpInicial();									
							}
							
						}
					});

				}

			}

		}


		function fbValidar()
		{
			var lbValido=false;
			var vInvalido=0;
			if(loF.KcodForaneo.value=="")
			{
				loF.KcodForaneo.focus();
				vCampoVacio("KcodForaneo");
				vInvalido=1;
			}
			if(loF.f_descripcion.value=="")
			{
				loF.f_descripcion.focus();
				vCampoVacio("f_descripcion");
				vInvalido=1;
			}
			if (vInvalido==0)
			{
				lbValido=true;
			}
			return lbValido;
		}
	

		function fpGuardar()
		{
			if(fbValidar())
			{

				var $forme = $("#fr_configuracion");

					$.ajax(
					{
						url: \'../controlador/cn_confCombos.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data)
				        {
				        	var Confi=data[\'Confi\'];
								if ((loF.txtOperacion.value=="incluir")&&(Confi.liHay==0))
								{
									NotificaE("El nombre que ha introducido ya se encuentra registrado.");
									loF.f_descripcion.focus();
								}

								if ((loF.txtOperacion.value=="incluir")&&(Confi.liHay==1))
								{

									NotificaS("Registro incluido con exito.");
									setTimeout(function(){ document.location.reload(); }, 1500);
									
								}

								if ((loF.txtOperacion.value=="modificar")&&(Confi.liHay==0))
								{
									NotificaE("El dato que ha introducido ya se encuentra registrado.");
								}

								if ((loF.txtOperacion.value=="modificar")&&(Confi.liHay==1))
								{

									NotificaS("Registro modificado con exito.");
									setTimeout(function(){ document.location.reload(); }, 1500);

								}
						}
					});
			}
			
		}


	

</script>



</html>
'); 






?>
