<?php

    require_once("../clases/clase_actividad.php");
    $lobjactividad=new clsactividad;
    $id=(isset($_GET['id']))?$_GET['id']:"";
    $lobjactividad->idActividad=$id;
    $laactividad=$lobjactividad->consultar_actividad_id();
    $actividad= $lobjactividad->consultar_actividad_inactivos();
?>
<div style="float: left" class="col-lg-8 span8 pull-left">
    <h3>Consultar Actividad</h3>
    <div class="alert alert-info">
        <ul>
            <li>En este formulario podrá consultar y editar la actividad en el sistema.</li>
            <!--<li>Sí necesitas ayuda para usar este formulario haz clic en el botón <button class="btn btn-warning" type="button" onclick="javascript:introJs().start();"><i class="fa fa-question-circle"></i> Ayuda</button>.</li>-->
        </ul>
    </div>
    <form class="formulario" action="../controlador/control_actividad.php" method="POST" name="form_actividad">
        <input type="hidden"  name="codigoActividad" id="cam_codigoActividad" value="<?php echo $laactividad[0];?>"/>
        
        <label>Nombre <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Nombre de actividad."><i class="fa fa-question" ></i></span></label>
        <input type="text" name="nombre" id="cam_nombreact"onchange="validar_nombre();" data-step="1" data-intro="Ingrese la actividad" data-position="right" value="<?php echo $laactividad[1];?>" required/>
        <label>Tipo de actividad <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Tipo de Actividad."><i class="fa fa-question" ></i></span></label>
        <select name='idTipoActividad'>
            <?php
                $filas=$lobjactividad->listar_tipo_actividad();
                foreach($filas AS $fila){
                    if($laactividad[2]==$fila["idtipoactividad"]){
                        echo "<option value='".$fila["idtipoactividad"]."' selected>".$fila["nombretipoa"]."</option>";
                    }else{
                        echo "<option value='".$fila["idtipoactividad"]."'>".$fila["nombretipoa"]."</option>";
                    }
                    
                }
            ?>
        </select>
        <div class="botonera">
            <input type="submit" class="btn btn-success" data-step="2" data-intro='Haga clic en <button class="btn btn-success">Guardar</button> para guardar la actividad ingresado' data-position="top" name="btn_enviar" id="btn_enviar" value="Guardar">
            <input type="button" class="btn btn-danger" data-step="3" data-intro='Haga clic en <button class="btn btn-danger">Regresar</button> para regresar al listado de actividades' data-position="top" name="btn_regresar" id="btn_regresar" value="Regresar" onclick="window.location.href='?vista=archivo/actividad';">
        </div>
        <input type="hidden" value="editar_actividad" name="operacion" />
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
    nombre_act=document.getElementById('cam_nombreact');
    nom_act = document.getElementsByName('nombres[]');
        for(i=0;i<nom_act.length;i++)
        {
            if(nom_act[i].value==nombre_act.value.toUpperCase())
            {
                alert('Debe ingresar un nombre distinto, este ya se encuentra registrado.');
                nombre_act.value='';
                nombre_act.focus();
            }
        }
} 
</script>