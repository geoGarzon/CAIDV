<?php

    require_once("../clases/clase_tactividad.php");
    $lobjtactividad=new clstactividad;
    $id=(isset($_GET['id']))?$_GET['id']:"";
    $lobjtactividad->set_tactividad($id);
    $tactividad= $lobjtactividad->consultar_tactividad_inactivos();
?>
<div style="float: left" class="col-lg-8 span8 pull-left">
    <h3>Registrar Tipo de Actividad</h3>
        <div class="alert alert-info">
            <ul>
                <li>En este formulario podrá registrar el tipo de actividad en el sistema.</li>
                <!--<li>Sí necesitas ayuda para usar este formulario haz clic en el botón <button class="btn btn-warning" type="button" onclick="javascript:introJs().start();"><i class="fa fa-question-circle"></i> Ayuda</button>.</li>-->s
            </ul>
        </div>
    <form class="formulario" action="../controlador/control_tactividad.php" method="POST" name="form_tactividad">
        <input type="hidden" value="registrar_tactividad" name="operacion" />
        <input type="hidden"  name="idtipoactividad" id="cam_idtipoactividad"/>
        <label>Nombre <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Nombre de Tipo de Actividad."><i class="fa fa-question" ></i></span></label>
        <input type="text" name="nombretipoa" id="cam_actividad" onchange="validar_nombre();" data-step="1" data-intro="Ingrese el nombre del tipo de actividad" data-position="right" required/>
        <div class="botonera">
        <input type="submit" data-step="2" data-intro='Haga clic en <button class="btn btn-success">Aceptar</button> para guardar el tipo de actividad ingresado.' data-position="top" class="btn btn-success" name="btn_enviar" id="btn_enviar" value="Aceptar">
            <input type="button" data-step="3" data-intro='Haga clic en <button class="btn btn-danger">Regresar</button> para regresar al listado de municipios' data-position="top" class="btn btn-danger" name="btn_regresar" id="btn_regresar" value="Regresar" onclick="window.location.href='?vista=archivo/tactividad';">
        </div>
    </form>
</div>

<?php
            for($i=0;$i<count($tactividad);$i++)
            {
                ?>
                    <input type="hidden" value="<?php print($tactividad[$i][1]);?>" name="nombres[]" />
                <?php
            }
        ?>
<script type="text/javascript">
$(function(){
$("#cam_nombreactividad").lemez_aceptar("texto","btn_enviar");
});
function validar_nombre()
{
    nombre_tactividad=document.getElementById('cam_nombreactividad');
    nom_tactividad = document.getElementsByName('nombres[]');
        for(i=0;i<nom_tactividad.length;i++)
        {
            if(nom_tactividad[i].value==nombre_tactividad.value.toUpperCase())
            {
                alert('Debe ingresar un nombre distinto, este ya se encuentra registrado.');
                nombre_tactividad.value='';
                nombre_tactividad.focus();
            }
        }
} 
</script>
