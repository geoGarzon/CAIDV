<?php

    require_once("../clases/clase_actividad.php");
    $lobjactividad=new clsactividad;
    $id=(isset($_GET['id']))?$_GET['id']:"";
    $lobjactividad->idActividad=$id;
    $actividad= $lobjactividad->consultar_actividad_inactivos();
?>
<div style="float: left" class="col-lg-8 span8 pull-left">
    <h3>Registrar Tema de Actividad</h3>
        <div class="alert alert-info">
            <ul>
                <li>En este formulario podrá registrar el tema de actividad en el sistema.</li>
                
            </ul>
        </div>
    <form class="formulario" action="../controlador/control_actividad.php" method="POST" name="form_actividad">
        <input type="hidden" value="registrar_actividad" name="operacion" />
        <label>Nombre <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Nombre de Actividad."><i class="fa fa-question" ></i></span></label>
        <input type="text" name="nombre" id="cam_actividad" onchange="validar_nombre();" data-step="1" data-intro="Ingrese el nombre de la actividad" data-position="right" required/>
        <label>Tipo de actividad <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Tipo de Actividad."><i class="fa fa-question" ></i></span></label>
        <select name='idTipoActividad'>
            <?php
                $filas=$lobjactividad->listar_tipo_actividad();
                foreach($filas AS $fila){
                    echo "<option value='".$fila["idtipoactividad"]."'>".$fila["nombretipoa"]."</option>";
                }
            ?>
        </select>
        <div class="botonera">
        <input type="submit" data-step="2" data-intro='Haga clic en <button class="btn btn-success">Aceptar</button> para guardar la actividad ingresada.' data-position="top" class="btn btn-success" name="btn_enviar" id="btn_enviar" value="Aceptar">
            <input type="button" data-step="3" data-intro='Haga clic en <button class="btn btn-danger">Regresar</button> para regresar al listado de actividades' data-position="top" class="btn btn-danger" name="btn_regresar" id="btn_regresar" value="Regresar" onclick="window.location.href='?vista=archivo/actividad';">
        </div>
    </form>
</div>

<?php
            for($i=0;$i<count($actividad);$i++)
            {
                ?>
                    <input type="hidden" value="<?php print($actividad[$i][1]);?>" name="nombres[]" />
                <?php
            }
        ?>
<script type="text/javascript">
$(function(){
$("#cam_nombreact").lemez_aceptar("texto","btn_enviar");
});
function validar_nombre()
{
    nombre_actividad=document.getElementById('cam_nombreact');
    nom_actividad = document.getElementsByName('nombres[]');
        for(i=0;i<nom_actividad.length;i++)
        {
            if(nom_actividad[i].value==nombre_actividad.value.toUpperCase())
            {
                alert('Debe ingresar un nombre distinto, este ya se encuentra registrado.');
                nombre_actividad.value='';
                nombre_actividad.focus();
            }
        }
} 
</script>
