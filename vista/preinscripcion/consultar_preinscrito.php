<?php

include('../clases/clase_preinscripcion.php');

$pre = NEW clsPreinscripcion();
$Datos_Participante=$pre->consultar_participante($_SESSION['usuario']);


?>
       

    <h3>Registrar participante por Pre-inscripcion</h3>
    <div class="alert alert-info">
        <ul>
            <li>En este formulario podrá consultar y editar la hoja de vida del participante.</li>
           <!-- <li>Sí necesitas ayuda para usar este formulario haz clic en el botón <button class="btn btn-warning" type="button" onclick="javascript:introJs().start();"><i class="fa fa-question-circle"></i> Ayuda</button>.</li>-->
        </ul>
    </div>

    <form class="formulario"  action="../controlador/control_preinscripcion.php" method="POST" name="form_participante" id="form_participante" enctype="multipart/form-data">
        <input type="hidden" value="editar_preinscripcion" name="operacion" />
        <input type="hidden" value="<?php print($Datos_Participante['idparticipante']);?>" name="idparticipante" />
       
                    <div class="row-fluid">
                        <div class="col-lg-6 span6">
                            <label>Nacionalidad <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Nacionalidad del participante."><i class="fa fa-question" ></i></span></label>
                            <select name="nacionalidadpar" id="cam_nacionalidadpar">
                                <option value="V" <?php if($Datos_Participante['nacionalidadpar']=="V"){print('SELECTED');}?>>VENEZOLANO/A</option>
                                <option value="E" <?php if($Datos_Participante['nacionalidadpar']=="E"){print('SELECTED');}?>>EXTRANJERO/A</option>
                            </select>
                        </div>
                        <div class="col-lg-6 span6">
                            <label>Cédula <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Cedula del participante."><i class="fa fa-question" ></i></span></label>
                            <input type="text" readonly class="span12" maxlength="8" <?php if($Datos_Participante['nacionalidadpar']=="N"){print('readonly');}?>  name="cedulapar" id="cam_cedulapar" value="<?php print($Datos_Participante['cedulapar']);?>" required/>
                            <div style="float:right" id="status"></div>
                        </div>
                    </div>   
                    <div class="row-fluid">
                        <div class="col-lg-6 span6">
                            <label>Primer Nombre <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Primer nombre del participante."><i class="fa fa-question" ></i></span></label>
                            <input type="text" class="span12"  name="nombreunopar" id="cam_nombreunopar" value="<?php print($Datos_Participante['nombreunopar']);?>" required/>
                            
                        </div>
                        <div class="col-lg-6 span6">
                            <label>Segundo Nombre <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Segundo nombre del participante."><i class="fa fa-question" ></i></span></label>
                            <input type="text" class="span12"  name="nombredospar" id="cam_nombredospar" value="<?php print($Datos_Participante['nombredospar']);?>"/>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="col-lg-6 span6">
                            <label>Primer Apellido <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Primer apellido del participante."><i class="fa fa-question" ></i></span></label>
                            <input type="text" class="span12"  name="apellidounopar" id="cam_apellidounopar" value="<?php print($Datos_Participante['apellidounopar']);?>" required/>
                        </div>
                        <div class="col-lg-6 span6">
                            <label>Segundo Apellido <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Segundo apellido del participante."><i class="fa fa-question" ></i></span></label>
                            <input type="text" class="span12"  name="apellidodospar" id="cam_apellidodospar" value="<?php print($Datos_Participante['apellidodospar']);?>"/>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="col-lg-6 span6">
                            <label>Sexo <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Sexo del participante."><i class="fa fa-question" ></i></span></label>
                            <label style="display:inline;margin-left:20px">Masculino
                                <input type="radio"   name="sexopar" id="cam_sexopar1" value="M" <?php if($Datos_Participante['sexopar']=='M'){echo 'checked';}?> required/>
                            </label>
                             <label style="display:inline;margin-left:30px">Femenino
                                <input type="radio"   name="sexopar" id="cam_sexopar2" value="F" <?php if($Datos_Participante['sexopar']=='F'){echo 'checked';}?>  required/>
                            </label>
                        </div>
                        <div class="col-lg-6 span6">
                            <label>Teléfono <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Telefono del participante."><i class="fa fa-question" ></i></span></label>
                            <input type="text" class="span12" maxlength="11"  name="telefonopar" id="cam_telefonopar" value="<?php print($Datos_Participante['telefonopar']);?>" required/>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="col-lg-6 span6">
                            <label>Correo <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Correo del participante."><i class="fa fa-question" ></i></span></label>
                            <input type="text" class="span12" name="correopar" id="cam_correopar" value="<?php print($Datos_Participante['correopar']);?>"/>
                        </div>
                        <div class="col-lg-6 span6">
                            <label>Fecha Nacimiento <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Fecha de nacimiento del participante."><i class="fa fa-question" ></i></span></label>
                            <!--<div class="span10 input-append date"   id="dp3" data-date="12-02-2012"  data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                              <input class="span12" name="fechanacimientopar" id="cam_fechanacimientopar" size="16" value="<?php print($Datos_Participante['fechanacimientopar']);?>" type="text" required>
                              <span class="add-on" ><i class="icon-calendar"></i></span>
                            </div>-->
                            <input class="span12" type='date' name="fechanacimientopar" id="cam_fechanacimientopar" size="16" value='<?php print($Datos_Participante['fechanacimientopar']);?>' required>
                        </div>
                        
                    </div>
                    <div class="row-fluid">
                        <div class="col-lg-6 span6">
                            <label>Lugar de nacimiento <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Localidad donde vive el participante."><i class="fa fa-question" ></i></span></label>
                            <select class="span12" name="tlocalidad_idlugarnacimiento" id="cam_tlocalidad_idlugarnacimiento" required>
                                <option value="">-</option>
                                <?php 
                                    require_once('../clases/clase_localidad.php');
                                    $lobjLocalidad = new clsLocalidad;
                                    $laLocalidades = $lobjLocalidad->consultar_localidades();
                                    $tmpvar='';
                                    for($i=0;$i<count($laLocalidades);$i++)
                                    {
                                        if($laLocalidades[$i][4]!=$tmpvar)
                                        {
                                            if($tmpvar)
                                            {
                                                print('</optgroup>');
                                            }
                                            $tmpvar=$laLocalidades[$i][4];
                                            print('<optgroup label="'.$laLocalidades[$i][4].'">');
                                        }//Fin IF
                                        ?><option value="<?php print($laLocalidades[$i][0])?>" <?php if($laLocalidades[$i][0]==$Datos_Participante['tlocalidad_idlugarnacimiento']){print('SELECTED');}?>><?php print($laLocalidades[$i][1])?></option>
                                    <?php 
                                    } //Fin For?>
                            </select>
                        </div>
                        <div class="col-lg-6 span6">
                            <label>Dirección <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Dirección del participante."><i class="fa fa-question" ></i></span></label>
                            <textarea class="span12"  name="direccionpar" id="cam_direccionpar" required><?php print($Datos_Participante['direccionpar']);?></textarea>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="col-lg-6 span6">
                            <label>Localidad <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Localidad donde vive el participante."><i class="fa fa-question" ></i></span></label>
                            <select class="span12" name="tlocalidad_idlocalidad" id="cam_tlocalidad_idlocalidad" required>
                                <option value="">-</option>
                                <?php 
                                    require_once('../clases/clase_localidad.php');
                                    $lobjLocalidad = new clsLocalidad;
                                    $laLocalidades = $lobjLocalidad->consultar_localidades();
                                    $tmpvar='';
                                    for($i=0;$i<count($laLocalidades);$i++)
                                    {
                                        if($laLocalidades[$i][4]!=$tmpvar)
                                        {
                                            if($tmpvar)
                                            {
                                                print('</optgroup>');
                                            }
                                            $tmpvar=$laLocalidades[$i][4];
                                            print('<optgroup label="'.$laLocalidades[$i][4].'">');
                                        }//Fin IF
                                        ?><option value="<?php print($laLocalidades[$i][0])?>" <?php if($laLocalidades[$i][0]==$Datos_Participante['tlocalidad_idlocalidad']){print('SELECTED');}?>><?php print($laLocalidades[$i][1])?></option>
                                    <?php 
                                    } //Fin For?>
                            </select>
                        </div>
                        <div class="col-lg-6 span6">
                            <label>Tenencia de la vivienda <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Tenencia de la vivienda."><i class="fa fa-question" ></i></span></label>
                           <select type="text" class="span12"  name="viviendapar" id="cam_viviendapar" required>
                                <option value="">-</option>
                                <option value="PROPIA" <?php if($Datos_Participante['viviendapar']=='PROPIA'){ echo 'selected';} ?>>PROPIA</option>
                                <option value="ALQUILADA" <?php if($Datos_Participante['viviendapar']=='ALQUILADA'){ echo 'selected';} ?>>ALQUILADA</option>
                                <option value="INVADIDA" <?php if($Datos_Participante['viviendapar']=='INVADIDA'){ echo 'selected';} ?>>INVADIDA</option>
                                <option value="OTRO" <?php if($Datos_Participante['viviendapar']=='OTRO'){ echo 'selected';} ?>>OTRO</option>
                            </select>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="col-lg-6 span6">
                            <label>Medio <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Medio en el que vive el participante."><i class="fa fa-question" ></i></span></label>
                            <select type="text" class="span12"  name="medioviviendapar" id="cam_medioviviendapar" required>
                                <option value="">-</option>
                                <option value="RURAL" <?php if($Datos_Participante['medioviviendapar']=='RURAL'){ echo 'selected';} ?>>RURAL</option>
                                <option value="URBANO" <?php if($Datos_Participante['medioviviendapar']=='URBANO'){ echo 'selected';} ?>>URBANO</option>                            
                            </select>
                        </div>
                        <div class="col-lg-6 span6">
                            <label>Tipo de construcción <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Tipo de construcción de la casa donde vive el participante."><i class="fa fa-question" ></i></span></label>
                            <select type="text" class="span12"  name="tipoconstruccionpar" id="cam_tipoconstruccionpar" required>
                                <option value="">-</option>
                                <option value="INAVI" <?php if($Datos_Participante['tipoconstruccionpar']=='INAVI'){ echo 'selected';} ?>>INAVI</option>
                                <option value="BLOQUES Y ZINC" <?php if($Datos_Participante['tipoconstruccionpar']=='BLOQUES Y ZINC'){ echo 'selected';} ?>>BLOQUES Y ZINC</option>
                                <option value="ADOBE" <?php if($Datos_Participante['tipoconstruccionpar']=='ADOBE'){ echo 'selected';} ?>>ADOBE</option>
                                <option value="BAHAREQUE" <?php if($Datos_Participante['tipoconstruccionpar']=='BAHAREQUE'){ echo 'selected';} ?>>BAHAREQUE</option>
                                <option value="CONSTRUCCIÓN RURAL" <?php if($Datos_Participante['tipoconstruccionpar']=='CONSTRUCCIÓN RURAL'){ echo 'selected';} ?>>CONSTRUCCIÓN RURAL</option>
                                <option value="EN ESTADO DE DETERIORO" <?php if($Datos_Participante['tipoconstruccionpar']=='EN ESTADO DE DETERIORO'){ echo 'selected';} ?>>EN ESTADO DE DETERIORO</option>
                                
                            </select>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="col-lg-6 span6">
                            <label>Nº de Hermanos <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Número de hermanos."><i class="fa fa-question" ></i></span></label>
                            <select type="text" class="span12"  name="numerohermanospar" id="cam_numerohermanospar" required>
                                <option value="">-</option>
                                <?php
                                    for ($i=1;$i<=10 ; $i++)
                                    {

                                        echo '<option value="'.$i.'"'; if($Datos_Participante['numerohermanospar']==$i){ echo 'selected';} echo '>'.$i.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-6 span6">
                            <label>Hijo Nº <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Lugar que ocupa entre los hermanos."><i class="fa fa-question" ></i></span></label>
                            <select type="text" class="span12"  name="numhijopar" id="cam_numhijopar" required>
                                <option value="">-</option>
                                <?php
                                    for ($i=1;$i<=10 ; $i++)
                                    {

                                        echo '<option value="'.$i.'"'; if($Datos_Participante['numhijopar']==$i){ echo 'selected';} echo '>'.$i.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="col-lg-6 span6">
                            <label>Condición Visual <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Diagnostico general del participante."><i class="fa fa-question" ></i></span></label>
                            <select type="text" class="span12"  name="tdiagnostico_iddiagnostico" id="cam_tdiagnostico_iddiagnostico" required>
                                <option value="">-</option>
                                <?php
                                    require_once('../clases/clase_diagnostico.php');
                                    $lobjDiagnostico= new clsDiagnostico;
                                    $laDiagnosticos=$lobjDiagnostico->consultar_diagnosticos();
                                    for ($i=0; $i <count($laDiagnosticos) ; $i++) 
                                    {
                                         echo '<option value="'.$laDiagnosticos[$i][0].'"'; if($Datos_Participante['tdiagnostico_iddiagnostico']==$laDiagnosticos[$i][0]){ echo 'selected';} echo '>'.$laDiagnosticos[$i][1].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                         <div class="col-lg-6 span6 hide">
                            <label>Institución <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Institución de la que proviene el participante."><i class="fa fa-question" ></i></span></label>
                            <select type="text" class="span12"  name="tinstitucion_idinstitucion" id="cam_tinstitucion_idinstitucion1" >
                                <option value="">-</option>
                                <?php
                                    require_once('../clases/clase_institucion.php');
                                    $lobjInstitucion= new clsInstitucion;
                                    $laInstituciones=$lobjInstitucion->consultar_instituciones();
                                    for ($i=0; $i <count($laInstituciones) ; $i++) 
                                    {
                                         echo '<option value="'.$laInstituciones[$i][0].'"'; if($Datos_Participante['tinstitucion_idinstitucion']==$laInstituciones[$i][0]){ echo 'selected';} echo '>'.$laInstituciones[$i][1].'</option>';
                                    }
                                ?>
                            </select>                
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="col-lg-6 span6">
                            <label>Braille <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Indica si el participante conoce BRAILLE."><i class="fa fa-question" ></i></span></label>
                            <label style="display:inline;margin-left:20px">SI
                                <input type="radio"   name="braillepar" id="cam_braillepar1" value="1" <?php if($Datos_Participante['braillepar']=='1'){echo 'checked';}?> required/>
                            </label>
                             <label style="display:inline;margin-left:30px">NO
                                <input type="radio"   name="braillepar" id="cam_braillepar2" value="0" <?php if($Datos_Participante['braillepar']=='0'){echo 'checked';}?> required/>
                            </label>
                        </div>
                        <div class="col-lg-6 span6">
                            <label>Etnia <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Indica si el participante pertenece a alguna etnia indigena."><i class="fa fa-question" ></i></span></label>
                            <label style="display:inline;margin-left:20px">SI
                                <input type="radio"   name="etniapar" id="cam_etniapar1" value="1" <?php if($Datos_Participante['etniapar']=='1'){echo 'checked';}?> required/>
                            </label>
                             <label style="display:inline;margin-left:30px">NO
                                <input type="radio"   name="etniapar" id="cam_etniapar2" value="0" <?php if($Datos_Participante['etniapar']=='0'){echo 'checked';}?> required/>
                            </label>
                        </div>                        
                    </div>
                    <br>
                    <div class="botonera">
                        <input type="submit" class="btn btn-success" name="btn_enviar" id="btn_enviar" value="Guardar">
                    </div>
                </div>
            <!--FIN PARTICIPANTE-->
            </div>
        </div>
    </form>
<?php
    require_once('../clases/clase_participante.php');
    $lobjParticipante=new clsParticipante;
    $laParticipantes=$lobjParticipante->consultar_participantes();
    for($i=0;$i<count($laParticipantes);$i++)
    {
        echo '<input type="hidden" value="'.$laParticipantes[$i][1].'" name="nombres[]" />';

    }
?>
<script type="text/javascript">

function validar_nombre()
{
    nombre_modulo=document.getElementById('cam_cedulapar');
    nom_modulos = document.getElementsByName('nombres[]');
       for(i=0;i<nom_modulos.length;i++)
        {
            if(nom_modulos[i].value==nombre_modulo.value.toUpperCase())
            {
                alert('Debe ingresar una cedula distinta, esta ya se encuentra registrada.');
                nombre_modulo.value='';
                nombre_modulo.focus();
            }
        }
}
</script>
<script type="text/javascript">
    $('#dp3').datepicker();
</script>
<script type="text/javascript">


function calcular_edad(fecha) 
{
    var fechaActual = new Date()
    var diaActual = fechaActual.getDate();
    var mmActual = fechaActual.getMonth() + 1;
    var yyyyActual = fechaActual.getFullYear();
    FechaNac = fecha.split("-");
    var diaCumple = FechaNac[0];
    var mmCumple = FechaNac[1];
    var yyyyCumple = FechaNac[2];
    //retiramos el primer cero de la izquierda
    if (mmCumple.substr(0,1) == 0) {
    mmCumple= mmCumple.substring(1, 2);
    }
    //retiramos el primer cero de la izquierda
    if (diaCumple.substr(0, 1) == 0) {
    diaCumple = diaCumple.substring(1, 2);
    }
    var edad = yyyyActual - yyyyCumple;

    if ((mmActual < mmCumple) || (mmActual == mmCumple && diaActual < diaCumple)) {
    edad--;
    }
    return edad;
}

$(function(){
    $("#cam_cedulapar").lemez_aceptar("numero","btn_enviar");
    $("#cam_nombreunopar").lemez_aceptar("texto","btn_enviar");
    $("#cam_nombredospar").lemez_aceptar("texto");
    $("#cam_apellidounopar").lemez_aceptar("texto","btn_enviar");
    $("#cam_apellidodospar").lemez_aceptar("texto");
    //$("#cam_fechanacimientopar").lemez_aceptar("fecha","btn_enviar");
    $("#cam_direccionpar").lemez_aceptar("todo","btn_enviar");
    $("#cam_telefonopar").lemez_aceptar("numero","btn_enviar");
    $("#cam_numhijopar").lemez_aceptar("numero","btn_enviar");
    $("#cam_correopar").lemez_aceptar("correo","btn_enviar");
    $("#cam_viviendapar").lemez_aceptar("texto","btn_enviar");
    $("#cam_medioviviendapar").lemez_aceptar("texto","btn_enviar");
    $("#cam_tipoconstruccionpar").lemez_aceptar("texto","btn_enviar");
    $("#cam_tdiagnostico_iddiagnostico").lemez_aceptar("numero","btn_enviar");
    $("#cam_nacionalidadpar").lemez_aceptar("texto","btn_enviar");
     $("#cam_telefono_docente_grado").lemez_aceptar("numero","btn_enviar");
    $("#cam_telefono_docente_aula_integrada").lemez_aceptar("numero","btn_enviar");

    $("#cam_docente_grado").lemez_aceptar("texto","btn_enviar");
    $("#cam_docente_aula_integrada").lemez_aceptar("texto","btn_enviar");

    $("#cam_gradoins").lemez_aceptar("texto_numero");
    $("#cam_seccionins").lemez_aceptar("texto_numero");
    $("#cam_disponibilidadins").lemez_aceptar("texto","btn_enviar");
    $("#cam_observacionins").lemez_aceptar("texto_especial");
    $("#cam_motivocambioins").lemez_aceptar("texto_especial");
    $("#cam_resumendiagnosticoins").lemez_aceptar("texto_especial","btn_enviar");
    });
</script>
<script>

    $("#btn-enviar").click(function() {
        
                    cedula=$('#cam_cedulapar').val();
                    telefono=$('#cam_telefonopar').val();
                    // Make sure we entered the name
                    if(!$('#cam_cedulapar').val()) {
                        alert('Debe ingresar la cedula del participante');
                        $('#cam_cedulapar').focus();
                        return false;
                    }
                    if(cedula.length<6)
                    {
                        alert('Cédula invalida, debe ingresar una cédula valida.');
                        $("#cam_cedulapar").focus();
                        return false;
                    }
                    if(!$('#cam_nombreunopar').val()) {
                        alert('Debe ingresar el primer nombre del participante');
                        $('#cam_nombreunopar').focus();
                        return false;
                    }
                    if(!$('#cam_apellidounopar').val()) {
                        alert('Debe ingresar el primer apellido del participante');
                        $('#cam_apellidounopar').focus();
                        return false;
                    }
                    if(($('#cam_sexopar1').prop('checked')==false)&&($('#cam_sexopar2').prop('checked')==false)) {
                        alert('Debe seleccionar el sexo del participante');
                        $('#cam_sexopar1').focus();
                        return false;
                    }
                    if(!$('#cam_telefonopar').val()) {
                        alert('Debe ingresar el nro de teléfono del participante');
                        $('#cam_telefonopar').focus();
                        return false;
                    }
                    if(telefono.length<11)
                    {
                        alert('Teléfono invalido, debe ingresar un teléfono valido de 11 caracteres.');
                        $("#cam_telefonopar").focus();
                        return false;
                    }
                    if(!$('#cam_fechanacimientopar').val()) {
                        alert('Debe ingresar la fecha de nacimiento del participante');
                        $('#cam_fechanacimientopar').focus();
                        return false;
                    }
                    edad=calcular_edad($('#cam_fechanacimientopar').val());
                    if(edad<4)
                    {
                        alert('Por favor retifique la fecha de nacimiento.');
                        $('#cam_fechanacimientopar').focus();
                        return false;                        
                    }
                    if(!$('#cam_direccionpar').val()) {
                        alert('Debe ingresar la dirección del participante');
                        $('#cam_direccionpar').focus();
                        return false;
                    }
                    if(!$('#cam_tlocalidad_idlocalidad').val()) {
                        alert('Debe seleccionar la localidad donde vive el participante.');
                        $('#cam_tlocalidad_idlocalidad').focus();
                        return false;
                    }
                    if(!$('#cam_viviendapar').val()) {
                        alert('Debe seleccionar cual es el estus de vivienda en el cual se encuentra el participante.');
                        $('#cam_viviendapar').focus();
                        return false;
                    }
                    if(!$('#cam_medioviviendapar').val()) {
                        alert('Debe seleccionar el medio en el cual el participante vive.');
                        $('#cam_medioviviendapar').focus();
                        return false;
                    }

                    if(!$('#cam_numhijopar').val()) {
                        alert('Debe seleccionar el nro de hijo del participante dentro de su familia.');
                        $('#cam_numhijopar').focus();
                        return false;
                    }                    
                    if(($('#cam_braillepar1').prop('checked')==false)&&($('#cam_braillepar2').prop('checked')==false)) {
                        alert('Debe seleccionar si el participante conoce braille.');
                        $('#cam_braillepar').focus();
                        return false;
                    }                  
                    if(($('#cam_etniapar1').prop('checked')==false)&&($('#cam_etniapar2').prop('checked')==false)) 
                    {
                        alert('Debe seleccionar si el participante pertenece a alguna etnia indigena.');
                        $('#cam_etniapar1').focus();
                        return false;
                    }
                    $("#form_participante").submit();
                    
              
    }); 
    </script>