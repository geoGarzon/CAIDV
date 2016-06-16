<?php
    require_once("../clases/clase_donacion.php");
    $lobjModulo=new clsDonacion;
    /*$id=(isset($_GET['id']))?$_GET['id']:"";
    $lobjModulo->idDonacion=$id;*/
    //$Modulos=$lobjModulo->consultar_donacion();
?>*/
<style>
    body, input, textarea{
        text-transform: uppercase;
    }
</style>
<div style="float: left" class="col-lg-8 span8 pull-left">
    <h3>Consultar donaciones</h3>
     <div class="alert alert-info">
        <ul>
            <!--<li>En este formulario podrá registrar las donaciones del sistema.</li>-->
           <!--<li>Sí necesitas ayuda para usar este formulario haz clic en el botón <button class="btn btn-warning" type="button" onclick="javascript:introJs().start();"><i class="fa fa-question-circle"></i> Ayuda</button>.</li>-->
        </ul>
    </div>
    <form class="formulario" style='width:100%;' action="../reporte/donaciones_fecha.php" method="POST" name="form_donacion" id='form_donacion'>
        <div class="row-fluid">
            <div class="col-lg-6 span6">
                <label>Listar donaciones por: <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Seleccione el tipo de reporte a generar."><i class="fa fa-question" ></i></span></label>
                <select id='tipo' required/>
                    <option value='0'>Completo</option>
                    <option value='1'>Persona</option>
                    <option value='2'>Empresa</option>
                </select>   
            </div>
            <div class="col-lg-6 span6" id='div_persona' style="visibility:hidden;">
                <label>Persona <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Seleccione la persona a listar sus donaciones."><i class="fa fa-question" ></i></span></label>
                <select name='idPersona' id='idPersona' />
                    <option value='0'>Seleccione una Persona</option>
                    <?php
                        $filas = $lobjModulo->consultar_persona();
                        foreach($filas as $fila){
                            echo "<option value='".$fila["idPersona"]."'>".$fila["cedula"]." ".$fila["primer_nombre"]." ".$fila["primer_apellido"]."</option>";
                        }
                    ?>
                </select>   
            </div>
            <div class="col-lg-6 span6" id='div_empresa' style="display:none;">
                <label>Empresa <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Seleccione la empresa a listar sus donaciones."><i class="fa fa-question" ></i></span></label>
                <select name='idEmpresa' id='idEmpresa' />
                <option value='0'>Seleccione una Empresa</option>
                    <?php
                        $filas = $lobjModulo->consultar_empresa();
                        foreach($filas as $fila){
                            echo "<option value='".$fila["idEmpresa"]."'>".$fila["nombre"]." "; if($fila["rif"]!="NO APLICA"){echo $fila["rif"];} echo "</option>";
                        }
                    ?>
                </select>
        </div>
        <div class="row-fluid">
            <div class="col-lg-6 span6">
                <label>Fecha de inicio <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Seleccione la fecha de inicio para el reporte o deje en blanco si no require."><i class="fa fa-question" ></i></span></label>
                <input type='date' name='fecha_i' id='fecha_i'> 
            </div>
            <div class="col-lg-6 span6">
                <label>Fecha fin <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Seleccione la fecha fin para el reporte o deje en blanco para listar desde inicio hasta el dia de hoy."><i class="fa fa-question" ></i></span></label>
               <input type='date' name='fecha_f' id='fecha_f'> 
            </div>
        </div>
        <div class="botonera">
            <input type="button" class="btn btn-success" name="btn_enviar" id="btn_enviar" value="Generar">
            <input type="button" class="btn btn-danger" name="btn_regresar" id="btn_regresar" value="Regresar" onclick="window.location.href='?vista=donacion/donacion';">
        </div>
    </form>
</div>
<script >
  $("#tipo").change(function(){
    if($("#tipo").val()=="1"){
        $("#div_persona").css("display","block");
        $("#div_persona").css("visibility","visible");
        $("#div_empresa").css("display","none");
        $("#idEmpresa").val("0");
    }else if($("#tipo").val()=="2"){
        $("#div_persona").css("display","none");
        $("#div_persona").css("visibility","hidden");
        $("#div_empresa").css("display","block");
        $("#idPersona").val("0");
    }else{
        $("#div_persona").css("display","block");
        $("#div_persona").css("visibility","hidden");
        $("#div_empresa").css("display","none"); 
        $("#idPersona").val("0");
        $("#idEmpresa").val("0");
    }
  });
  $("#fecha_i").change(function(){
    if($("#fecha_i").val()>$("#fecha_f").val() && $("#fecha_f").val()!=""){
        alert("LA FECHA DE INICIO NO PUEDE SER MAYOR A LA FINAL");
        $("#fecha_i").val("");
    }
  });
  $("#fecha_f").change(function(){
    if($("#fecha_f").val()<$("#fecha_i").val()){
        alert("LA FECHA DE FIN NO PUEDE SER MENOR A LA FECHA DE INICIO");
        $("#fecha_f").val("");
    }
  });
  $("#btn_enviar").click(function(){
    if($("#tipo").val()=="1"){
        if($("#idPersona").val()=="0"){
            alert("NO A SELECCIONADO LA PERSONA");
            return false;
        }
    }else if($("#tipo").val()=="2"){
        if($("#idEmpresa").val()=="0"){
            alert("NO A SELECCIONADO LA EMPRESA");
            return false;
        }
    }
    if($("#fecha_f").val()!="" && $("#fecha_i").val()=="" ){
        alert("NO HA SELECCIONADO UNA FECHA DE INICIO");
        return false;
    }
    $("#form_donacion").submit();

  });

</script>