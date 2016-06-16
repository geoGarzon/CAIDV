<?php
    require_once("../clases/clase_tipo_articulo.php");
    $lobjModulo=new clsTipo_articulo;
    $id=(isset($_GET['id']))?$_GET['id']:"";
    $lobjModulo->idTipo_articulo=$id;
    $Modulos=$lobjModulo->consultar_tipo_articulo();
?>
<style>
    body, input, textarea{
        text-transform: uppercase;
    }
</style>
<div style="float: left" class="col-lg-8 span8 pull-left">
    <h3>Registrar Tipos de articulos</h3>
     <div class="alert alert-info">
        <ul>
            <li>En este formulario podrá registrar los Tipos de Articulos del sistema.</li>
           <!--<li>Sí necesitas ayuda para usar este formulario haz clic en el botón <button class="btn btn-warning" type="button" onclick="javascript:introJs().start();"><i class="fa fa-question-circle"></i> Ayuda</button>.</li>-->
        </ul>
    </div>
    <form class="formulario" action="../controlador/control_tipo_articulo.php" method="POST" name="form_modulo">
        <input type="hidden" value="registrar_tipo_articulo" name="operacion" />
        <input type="hidden"  name="idTipo_articulo" id="cam_idTipo_articulo"/>
        <label>Nombre <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Nombre del tipo de articulo."><i class="fa fa-question" ></i></span></label>
        <input type="text" name="nombre" id="cam_nombremod"onchange="validar_nombre();"required/>
        <div class="botonera">
            <input type="submit" class="btn btn-success" name="btn_enviar" id="btn_enviar" value="Aceptar">
            <input type="button" class="btn btn-danger" name="btn_regresar" id="btn_regresar" value="Regresar" onclick="window.location.href='?vista=donacion/tipo_articulo';">
        </div>
    </form>
</div>
<?php
            for($i=0;$i<count($Modulos);$i++)
            {
                ?>
                    <input type="hidden" value="<?php print($Modulos[$i][1]);?>" name="nombres[]" />
                <?php
            }
?>
<script type="text/javascript">

function validar_nombre()
{
    nombre_modulo=document.getElementById('cam_nombremod');
    nom_modulos = document.getElementsByName('nombres[]');
       for(i=0;i<nom_modulos.length;i++)
        {
            if(nom_modulos[i].value==nombre_modulo.value.toUpperCase())
            {
                alert('Debe ingresar un nombre distinto, este ya se encuentra registrado.');
                nombre_modulo.value='';
                nombre_modulo.focus();
            }
        }
}
</script>