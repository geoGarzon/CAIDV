<?php
$consultar= $registrar= $eliminar=false;
for($i=0;$i<count($laModulos);$i++) 
    {
         
        $laServicios=$lobjRol->consultar_servicios_menu($laModulos[$i][0]); 
        for ($j=0; $j <count($laServicios) ; $j++) //Se recorre un ciclo para poder extraer los datos de cada uno de los servicios que tiene asignado el modulo para poder constuir el menú
        {
            if($laServicios[$j][2]=='archivo/consultar_tactividad')
            {
                $consultar=true;
            }
            if($laServicios[$j][2]=='archivo/registrar_tactividad')
            {
                $registrar=true;
            }
            if($laServicios[$j][2]=='archivo/eliminar_tactividad')
            {
                $eliminar=true;
            }
        }
    }
?>
<script>
 function buscar(id)
 {
    window.location.href="?vista=archivo/consultar_tactividad&id="+id;
 }
  function eliminar(id)
  {
     if(confirm("¿Esta seguro que desea desactivar el tipo de actividad seleccionado?"))
    {
      document.getElementById("cam_idtipoactividad").value=id;
      document.form_tactividad.submit();
    }
  }
    function restaurar(id)
  {
     if(confirm("¿Esta seguro que desea restaurar el tipo de actividad seleccionado?"))
    {
      document.getElementById("cam_idtipoactividad").value=id;
      document.getElementById("cam_operacion").value='restaurar_tactividad';
      document.form_tactividad.submit();
    }
  }
</script>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        oTable = $('#filtro').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "iDisplayLength": 5                    
        });
    } );
</script>  
<div style="float: left" class="col-lg-8 span8 pull-left">
    <h3>Tipo de Actividad</h3>
   <div class="alert alert-info">
        <ul>
            En este módulo podrá registrar, consultar, editar, desactivar y activar el tipo de actividad en el sistema.
        </ul>
    </div>
    <form action="../controlador/control_tactividad.php" method="POST" name="form_tactividad">
        <input type="hidden" value="eliminar_tactividad" name="operacion" id="cam_operacion"/>
        <input type="hidden"  name="idtipoactividad" id="cam_idtipoactividad"/>
        <?php
        if($registrar)
        {
            echo '<a id="btn_registrar" class="btn btn-success" href="?vista=archivo/registrar_tactividad"><i class="icon-plus icon-white"></i> Registrar Tipo Actividad</a>';
        }
        ?>
        <table class="table table-striped table-hover table-bordered bootstrap-datatable datatable dataTable" id="filtro">
            <thead>
                <th>Código</th><th>Nombre</th><th>Estatus</th><?php if($consultar || $eliminar)
                        { echo '<th>Acción</th>';}?>
            </thead>
            <tbody>
            <?php
                    require_once('../clases/clase_tactividad.php');
                    $lobjtactividad=new clstactividad;
                    $latactividad=$lobjtactividad->consultar_tactividad_inactivos();
                    for($i=0;$i<count($latactividad);$i++)
                    {
                       // $dependencia=false;
                        $lobjtactividad->set_tactividad($latactividad[$i][0]);
                        //$dependencia=$lobjtactividad->consultar_dependencia();
                        if($latactividad[$i][2])
                        {
                            $latactividad[$i][2]='Activo';
                        }
                        elseif(!$latactividad[$i][2]) 
                        {
                            $latactividad[$i][2]='Inactivo';
                        }

                        echo '<tr>';
                        echo '<td>'.$latactividad[$i][0].'</td>';
                        echo '<td>'.$latactividad[$i][1].'</td>';
                        echo '<td>'.$latactividad[$i][2].'</td>';
                        if($consultar || $eliminar)
                        {
                            echo '<td>';
                            if($consultar && $latactividad[$i][2]=='Activo')
                            {
                                echo '<a class="btn btn-info" href="#" title="Consultar" onclick="buscar('.$latactividad[$i][0].')"><i class="icon-search icon-white"></i></a> ';
                            }
                           // if($eliminar && $dependencia==false)
                            {
                                if($latactividad[$i][2]=='Activo')
                                {
                                    echo '<a class="btn btn-danger" href="#" title="Desactivar" onclick="eliminar('.$latactividad[$i][0].')" ><i class="icon-remove icon-white"></i></a> ';
                                    
                                }
                                elseif ($latactividad[$i][2]=='Inactivo') 
                                {
                                    echo '<a class="btn btn-warning" title="Restaurar" href="#" onclick="restaurar('.$latactividad[$i][0].')" ><i class="icon-refresh icon-white"></i></a>';
                                }
                            }
                            echo "</td>";
                        }
                       
                        echo '</tr>';
                    }
                ?>
                </tbody>
        </table>
    </form>
     
</div>