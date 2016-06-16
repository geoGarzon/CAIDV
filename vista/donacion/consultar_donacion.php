<?php
    require_once("../clases/clase_donacion.php");
    $lobjModulo=new clsDonacion;
    $id=(isset($_GET['id']))?$_GET['id']:"";
    $lobjModulo->idDonacion=$id;
    $d=$lobjModulo->consultar_donacion_id();
?>
<style>
    body, input, textarea{
        text-transform: uppercase;
    }
</style>
<div style="float: left" class="col-lg-8 span8 pull-left">
    <h3>Consultar donaciones</h3>
     <div class="alert alert-info">
        <ul>
            <li>En este formulario podrá registrar las donaciones del sistema.</li>
           <!--<li>Sí necesitas ayuda para usar este formulario haz clic en el botón <button class="btn btn-warning" type="button" onclick="javascript:introJs().start();"><i class="fa fa-question-circle"></i> Ayuda</button>.</li>-->
        </ul>
    </div>
    <form class="formulario" style='width:100%;' action="../reporte/reporte_donacion.php" method="POST" name="form_modulo">
        <input type="hidden" value="registrar_donacion" name="operacion" />
        <input type="hidden"  name="idDonacion" id="cam_idDonacion" value='<?=$id?>'/>
        <div class="row-fluid">
            <div class="col-lg-6 span6">
                <label>Persona <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Seleccione la persona que donara."><i class="fa fa-question" ></i></span></label>
                <select name='idPersona' forzar='obligatorio' readonly required/>
                    <option value=''>Seleccione una Persona</option>
                    <?php
                        $filas = $lobjModulo->consultar_persona();
                        foreach($filas as $fila){
                            if($d[1]==$fila["idPersona"]){
                                echo "<option value='".$fila["idPersona"]."' selected>".$fila["cedula"]." ".$fila["primer_nombre"]." ".$fila["primer_apellido"]."</option>";
                            }else{
                               echo "<option value='".$fila["idPersona"]."' >".$fila["cedula"]." ".$fila["primer_nombre"]." ".$fila["primer_apellido"]."</option>"; 
                            }
                        }
                    ?>
                </select>   
            </div>
            <div class="col-lg-6 span6">
                <label>Empresa <span class="label label-warning" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Seleccione la empresa que representa la persona."><i class="fa fa-question" ></i></span></label>
                <select name='idEmpresa' forzar='obligatorio' readonly required/>
                    <?php
                        $filas = $lobjModulo->consultar_empresa();
                        foreach($filas as $fila){
                            if($d[2]==$fila["idEmpresa"]){
                                echo "<option value='".$fila["idEmpresa"]."' selected>".$fila["nombre"]." "; if($fila["rif"]!="NO APLICA"){echo $fila["rif"];} echo "</option>";
                            }else{
                                echo "<option value='".$fila["idEmpresa"]."'>".$fila["nombre"]." "; if($fila["rif"]!="NO APLICA"){echo $fila["rif"];} echo "</option>";
                            }
                        }
                    ?>
                </select>
        </div>
        <div class="row-fluid">
            <table class='table table-striped table-hover table-bordered bootstrap-datatable datatable dataTable'>
                <thead>
                    <th>Articulo</th><th>Serial/Factura</th><th>Cantidad</th><!--<th>agregar</th>-->
                </thead>
                <tbody id='tbody_contenido'>
                    <!--<tr>
                        <td>
                            <select id='articulo' required/>
                                <?php
                                    $filas = $lobjModulo->consultar_articulo();
                                    foreach($filas as $fila){
                                        echo "<option value='".$fila["idArticulo"]."' >".$fila["nombre"]."</option>";
                                    }
                                ?>
                            </select>
                        </td>
                        <td>
                            <input type='text' id='serial_factura' placeholder='DEJAR VACIO SI NO APLICA'>
                        </td>
                        <td>
                            <input type='number' id='cantidad' min='1' value='1'>
                        </td>
                        <td>
                            <button class='btn btn-default' type='button' id='agregar'>+</button>
                        </td>
                    </tr>-->
                    <?php
                        $dd = $lobjModulo->consultar_donacion_detalle_id();

                         for($i=0;$i<count($dd);$i++)
                        {
                            echo "<tr id='".$i."'>
                                    <td><input type='text' id='articulo-".$i."' value='".$dd[$i][1]."' readonly></td>
                                    <input type='hidden' name='idArticulo[]' value='".$dd[$i][0]."'>
                                    <td><input type='text' name='serial_factura[]' id='serial_factura-".$i."' value='".$dd[$i][2]."' readonly></td>
                                    <td><input type='number' name='cantidad[]' id='cantidad-".$i."' value='".$dd[$i][3]."' readonly></td>
                                    <!--<td><button type='button' class='btn btn-default' onclick='eliminar_fila(this,\"tbody_contenido\");'>-</button></td>-->
                                </tr>";
                        }

                    ?>
                </tbody>
            </table>
        </div>
        <div class="botonera">
            <input type="submit" class="btn btn-success" name="btn_enviar" id="btn_enviar" value="Generar">
            <input type="button" class="btn btn-danger" name="btn_regresar" id="btn_regresar" value="Regresar" onclick="window.location.href='?vista=donacion/donacion';">
        </div>
    </form>
</div>
<script type="text/javascript">
   //console.log(typeof muchos());
document.getElementById("agregar").onclick = function()
{
    var articulo = document.getElementById("articulo");
    var articulo_value = document.getElementById("articulo").value;
    var articulo_option = articulo.options[articulo.selectedIndex].text;
    var serial_factura_value = document.getElementById("serial_factura").value
    var cantidad_value = document.getElementById("cantidad").value

    var idTabla = "tbody_contenido";
    var campos = {
        //ETIQUETAS     
        tag : ["input","input","input","input"],
        //NOMBRES DE LAS ETIQUETAS
        name : ["","idArticulo[]","serial_factura[]","cantidad[]"],
        //ID DE LAS ETIQUETAS (FINALIZAR CON - PARA HACER NUMERACION)
        id : ["articulo-","idArticulo-","serial_factura-","cantidad-"],
        //TIPOS DE LA ETIQUETAS (DEJAS VACIO PARA SELECT)
        type : ["text","hidden","text","text"],
        //VALORES PARA LAS ETIQUETAS
        value : [articulo_option,articulo_value,serial_factura_value,cantidad_value],
        //CLASES PARA LAS ETIQUETAS
        clases: ["form-control","form-control","form-control","form-control"],
        //VALIDACIONES DE LA LIBRERIA PARA LAS ETIQUETAS
        /*libAA: ["",["forzar","obligatorio","numeros"],"",""],*/
        //ATRIBUTOS PARA LAS ETIQUETAS
        attributes: [["readonly","true"],"",["readonly","true"],["readonly","true"]]
    };
    var boton_eliminar={
        clases: "btn btn-default",
        texto: "-"
    }
    if(cantidad_value!="0" && cantidad_value!=""){
        muchos(idTabla,campos,boton_eliminar);
    }else{
        alert("Debe agregar una cantidad mayor o igual a 1");
    }
};

</script>