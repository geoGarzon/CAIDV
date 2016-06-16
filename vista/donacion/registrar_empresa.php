<?php
    require_once("../clases/clase_empresa.php");
    $lobjModulo=new clsEmpresa;
    $id=(isset($_GET['id']))?$_GET['id']:"";
    $lobjModulo->idEmpresa=$id;
    $Modulos=$lobjModulo->consultar_empresa();
?>
<style>
    body, input, textarea{
        text-transform: uppercase;
    }
</style>
<div style="float: left" class="col-lg-8 span8 pull-left">
    <h3>Registrar empresa</h3>
     <div class="alert alert-info">
        <ul>
            <li>En este formulario podrá registrar las empresas del sistema.</li>
           <!--<li>Sí necesitas ayuda para usar este formulario haz clic en el botón <button class="btn btn-warning" type="button" onclick="javascript:introJs().start();"><i class="fa fa-question-circle"></i> Ayuda</button>.</li>-->
        </ul>
    </div>
    <form class="formulario" action="../controlador/control_empresa.php" method="POST" name="form_modulo">
        <input type="hidden" value="registrar_empresa" name="operacion" />
        <input type="hidden"  name="idEmpresa" id="cam_idEmpresa"/>
        <div class='row-fluid'>
            <label>Rif <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Rif de la empresa."><i class="fa fa-question" ></i></span></label>
            <input type="text" name="rif" id="cam_rifmod"  class='span12' forzar='cedula' onchange="validar_nombre();" onblur='validar();' required/>
        </div>
        <div class='row-fluid'>
            <label>Nombre <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Nombre de la empresa."><i class="fa fa-question" ></i></span></label>
            <input type="text" name="nombre" id="cam_nombremod" class='span12' required/>
        </div>
        <div class='row-fluid'>
            <label>Direccion <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Direccion de la empresa."><i class="fa fa-question" ></i></span></label>
            <textarea name='direccion' id='direccion' required style='resize:none;' class='span12' rows='5'></textarea>
        </div>
        <div class='row-fluid'>
            <label>Primer Telefono: <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Primer telefono de la empresa."><i class="fa fa-question" ></i></span></label>
            <input type="text" name="tlf_uno" id="cam_tlf_unomod" forzar='numeros' class='span12' maxlength='11' required/>
        </div>
        <div class='row-fluid'>
            <label>Segundo Telefono: <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Segundo telefono de la empresa."><i class="fa fa-question" ></i></span></label>
            <input type="text" name="tlf_dos" id="cam_tlf_dosmod" forzar='numeros' class='span12' maxlength='11' />
        </div>
        <div class='row-fluid'>
            <label>Correo: <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Correo de la empresa."><i class="fa fa-question" ></i></span></label>
            <input type="text" name="correo" id="cam_correomod" forzar='correo' class='span12' required/>
        </div>
        <div class="botonera">
            <input type="submit" class="btn btn-success" name="btn_enviar"  id="btn_enviar" value="Aceptar">
            <input type="button" class="btn btn-danger" name="btn_regresar" id="btn_regresar" value="Regresar" onclick="window.location.href='?vista=donacion/empresa';">
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
function validar(){
    if(document.getElementById("cam_rifmod").value.length<8){
        alert("Debe introduccir al menos 8 caracteres para el rif");
        document.getElementById("cam_rifmod").value="";
        return false;
    }
}
function validar_nombre()
{
    nombre_modulo=document.getElementById('cam_rifmod');
    nom_modulos = document.getElementsByName('nombres[]');
       for(i=0;i<nom_modulos.length;i++)
        {
            if(nom_modulos[i].value==nombre_modulo.value.toUpperCase())
            {
                alert('Debe ingresar un rif distinto, este ya se encuentra registrado.');
                nombre_modulo.value='';
                nombre_modulo.focus();
            }
        }
}
</script>