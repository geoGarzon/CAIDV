<?php

    require_once("../clases/clase_tactividad.php");
    $lobjtactividad=new clstactividad;
    $id=(isset($_GET['id']))?$_GET['id']:"";
    $lobjtactividad->set_tactividad($id);
    $latactividad=$lobjtactividad->consultar_tactividad_id();
    $tactividad= $lobjtactividad->consultar_tactividad_inactivos();
?>
<div style="float: left" class="col-lg-8 span8 pull-left">
    <h3>Consultar Tipo de Actividad</h3>
    <div class="alert alert-info">
        <ul>
            <li>En este formulario podrá consultar y editar el tipo de actividad en el sistema.</li>
            <li>Sí necesitas ayuda para usar este formulario haz clic en el botón <button class="btn btn-warning" type="button" onclick="javascript:introJs().start();"><i class="fa fa-question-circle"></i> Ayuda</button>.</li>
        </ul>
    </div>
    <form class="formulario" action="../controlador/control_tactividad.php" method="POST" name="form_tactividad">
        <input type="hidden"  name="idtactividad" id="cam_idtactividad" value="<?php echo $latactividad[0];?>"/>
        
        <label>Nombre <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Nombre del tipo de actividad."><i class="fa fa-question" ></i></span></label>
        <input type="text" name="nombretipoa" id="cam_nombretipoa"onchange="validar_nombre();" data-step="1" data-intro="Ingrese el tipo de actividad" data-position="right" value="<?php echo $latactividad[1];?>" required/>
        <div class="botonera">
            <input type="submit" class="btn btn-success" data-step="2" data-intro='Haga clic en <button class="btn btn-success">Guardar</button> para guardar el tipo de actividad ingresado' data-position="top" name="btn_enviar" id="btn_enviar" value="Guardar">
            <input type="button" class="btn btn-danger" data-step="3" data-intro='Haga clic en <button class="btn btn-danger">Regresar</button> para regresar al listado de tipos de actividad' data-position="top" name="btn_regresar" id="btn_regresar" value="Regresar" onclick="window.location.href='?vista=archivo/tactividad';">
        </div>
        <input type="hidden" value="editar_tactividad" name="operacion" />
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
$("#cam_nombretipoa").lemez_aceptar("texto","btn_enviar");
});
function validar_nombre()
{
    nombre_tipoa=document.getElementById('cam_nombretipoa');
    nom_tipoa = document.getElementsByName('nombres[]');
        for(i=0;i<nom_tipoa.length;i++)
        {
            if(nom_tipoa[i].value==nombre_tipoa.value.toUpperCase())
            {
                alert('Debe ingresar un nombre distinto, este ya se encuentra registrado.');
                nombre_tipoa.value='';
                nombre_tipoa.focus();
            }
        }
} 
</script>