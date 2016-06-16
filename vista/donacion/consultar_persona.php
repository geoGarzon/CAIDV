<?php
    require_once("../clases/clase_persona.php");
    $lobjModulo=new clsPersona;
    $id=(isset($_GET['id']))?$_GET['id']:"";
    $lobjModulo->idPersona=$id;
    $laModulo=$lobjModulo->consultar_persona_id();
    $Modulos=$lobjModulo->consultar_persona();
?>
<style>
    body, input, textarea{
        text-transform: uppercase;
    }
</style>
<div style="float: left" class="col-lg-8 span8 pull-left">
    <h3>Consultar persona</h3>
     <div class="alert alert-info">
        <ul>
            <li>En este formulario podrá consultar y editar las personas del sistema.</li>
            <!--<li>Sí necesitas ayuda para usar este formulario haz clic en el botón <button class="btn btn-warning" type="button" onclick="javascript:introJs().start();"><i class="fa fa-question-circle"></i> Ayuda</button>.</li>-->
        </ul>
    </div>
    <form class="formulario" action="../controlador/control_persona.php" method="POST" name="form_modulo">
        <input type="hidden" value="editar_persona" name="operacion" />
        <input type="hidden"  name="idPersona" id="cam_idPersona" value="<?php echo $laModulo[0];?>"/>
        <div class='row-fluid'>
            <label>Cedula <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Cedula de la persona."><i class="fa fa-question" ></i></span></label>
            <input type="text" name="cedula" id="cam_cedulamod" value="<?php echo $laModulo[1];?>" maxlength='9' onchange="validar_nombre();" onblur='validar();' forzar='cedula' placeholder='V12345678' class='span12' required/>
        </div>
        <div class='row-fluid'>
            <label>Primer nombre <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Primer nombre de la persona."><i class="fa fa-question" ></i></span></label>
            <input type="text" name="primer_nombre" id="cam_primer_nombremod" value="<?php echo $laModulo[2];?>"  class='span12'required/>
        </div>
        <div class='row-fluid'>
            <label>Segundo nombre <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Segundo nombre de la persona."><i class="fa fa-question" ></i></span></label>
            <input type="text" name="segundo_nombre" id="cam_segundo_nombremod" value="<?php echo $laModulo[3];?>" class='span12'/>
        </div>
        <div class='row-fluid'>
            <label>Primer apellido <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Primer apellido de la persona."><i class="fa fa-question" ></i></span></label>
            <input type="text" name="primer_apellido" id="cam_primer_apellidomod" value="<?php echo $laModulo[4];?>"  class='span12'required/>
        </div>
        <div class='row-fluid'>
            <label>Segundo apellido <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Segundo apellido de la persona."><i class="fa fa-question" ></i></span></label>
            <input type="text" name="segundo_apellido" id="cam_segundo_apellidomod" value="<?php echo $laModulo[5];?>" class='span12'/>
        </div>
        <div class='row-fluid'>
            <label>Sexo <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Sexo de la persona."><i class="fa fa-question" ></i></span></label>
            <select name='sexo' required class='span12'>
                <?php
                if($laModulo[6]=="M"){
                    echo"
                    <option value='M' selected>Masculino</option>
                    <option value='F'>Femenino</option>";
                }else{
                echo"
                    <option value='M'>Masculino</option>
                    <option value='F' selected>Femenino</option>";
                }
                ?>
            </select>
        </div>
        <div class='row-fluid'>
            <label>Direccion <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Direccion de la persona."><i class="fa fa-question" ></i></span></label>
            <textarea name='direccion' required  style='resize:none;' class='span12' rows='5'><?php echo $laModulo[7];?></textarea>
        </div>
        <div class='row-fluid'>
            <label>Primer telefono <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Primer telefono de la persona."><i class="fa fa-question" ></i></span></label>
            <input type="text" name="tlf_uno" id="cam_tlf_unomod" value="<?php echo $laModulo[8];?>" forzar='numeros' maxlength='11' class='span12' required/>
        </div>
        <div class='row-fluid'>
            <label>Segundo telefono <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Segundo telefono de la persona."><i class="fa fa-question" ></i></span></label>
            <input type="text" name="tlf_dos" id="cam_tlf_dosmod" value="<?php echo $laModulo[9];?>" forzar='numeros' maxlength='11' class='span12' />
        </div>
        <div class='row-fluid'>
            <label>Correo <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Correo de la persona."><i class="fa fa-question" ></i></span></label>
            <input type="text" name="correo" id="cam_correomod" value="<?php echo $laModulo[10];?>" forzar='correo' class='span12' required/>
        </div>
        <div class="botonera">
            <input type="submit" class="btn btn-success" name="btn_enviar" id="btn_enviar" value="Guardar">
            <input type="button" class="btn btn-danger" name="btn_regresar" id="btn_regresar" value="Regresar" onclick="window.location.href='?vista=donacion/persona';">
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
    if(document.getElementById("cam_cedulamod").value.length<8){
        alert("Debe introduccir al menos 8 caracteres para la cedula");
        document.getElementById("cam_cedulamod").value="";
        return false;
    }
}
function validar_nombre()
{
   nombre_modulo=document.getElementById('cam_cedulamod');
    nom_modulos = document.getElementsByName('nombres[]');
       for(i=0;i<nom_modulos.length;i++)
        {
            if(nom_modulos[i].value==nombre_modulo.value.toUpperCase())
            {
                alert('Debe ingresar una cedula distinto, este ya se encuentra registrado.');
                nombre_modulo.value='';
                nombre_modulo.focus();
            }
        }
}
</script>