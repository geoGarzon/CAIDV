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
    <h3>Consultar preinscritos</h3>
     <div class="alert alert-info">
        <ul>
            <!--<li>En este formulario podrá registrar las donaciones del sistema.</li>-->
           <!--<li>Sí necesitas ayuda para usar este formulario haz clic en el botón <button class="btn btn-warning" type="button" onclick="javascript:introJs().start();"><i class="fa fa-question-circle"></i> Ayuda</button>.</li>-->
        </ul>
    </div>
    <form class="formulario" style='width:100%;' action="../reporte/preinscritos.php" method="POST" name="form_donacion" id='form_preinscritos'>
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
    if($("#fecha_f").val()!="" && $("#fecha_i").val()=="" ){
        alert("NO HA SELECCIONADO UNA FECHA DE INICIO");
        return false;
    }
    $("#form_preinscritos").submit();

  });

</script>