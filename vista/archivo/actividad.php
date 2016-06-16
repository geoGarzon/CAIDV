<?php
$consultar= $registrar= $eliminar=false;
for($i=0;$i<count($laModulos);$i++) 
    {
         
        $laServicios=$lobjRol->consultar_servicios_menu($laModulos[$i][0]); 
        for ($j=0; $j <count($laServicios) ; $j++) //Se recorre un ciclo para poder extraer los datos de cada uno de los servicios que tiene asignado el modulo para poder constuir el menú
        {
            if($laServicios[$j][2]=='archivo/consultar_actividad')
            {
                $consultar=true;
            }
            if($laServicios[$j][2]=='archivo/registrar_actividad')
            {
                $registrar=true;
            }
            if($laServicios[$j][2]=='archivo/eliminar_actividad')
            {
                $eliminar=true;
            }
        }
    }
?>
<script>
 function buscar(id)
 {
    window.location.href="?vista=archivo/consultar_actividad&id="+id;
 }
  function eliminar(id)
  {
     if(confirm("¿Esta seguro que desea desactivar el tema de actividad seleccionada?"))
    {
      document.getElementById("cam_codigoActividad").value=id;
      document.form_actividad.submit();
    }
  }
    function restaurar(id)
  {
     if(confirm("¿Esta seguro que desea restaurar el tema de actividad seleccionada?"))
    {
      document.getElementById("cam_codigoActividad").value=id;
      document.getElementById("cam_operacion").value='restaurar_actividad';
      document.form_actividad.submit();
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
    <h3>Actividad</h3>
   <div class="alert alert-info">
        <ul>
            En este módulo podrá registrar, consultar, editar, desactivar y activar la actividad en el sistema.
        </ul>
    </div>
    <form action="../controlador/control_actividad.php" method="POST" name="form_actividad">
        <input type="hidden" value="eliminar_actividad" name="operacion" id="cam_operacion"/>
        <input type="hidden"  name="codigoActividad" id="cam_codigoActividad"/>
        <?php
        if($registrar)
        {
            echo '<a id="btn_registrar" class="btn btn-success" href="?vista=archivo/registrar_actividad"><i class="icon-plus icon-white"></i> Registrar Tema de Actividad</a>';
        }
        ?>
        <table class="table table-striped table-hover table-bordered bootstrap-datatable datatable dataTable" id="filtro">
            <thead>
                <th>Código</th><th>Nombre</th><th>Tipo de actividad</th><th>Estatus</th><?php if($consultar || $eliminar)
                        { echo '<th>Acción</th>';}?>
            </thead>
            <tbody>
            <?php
                    require_once('../clases/clase_actividad.php');
                    $lobjactividad=new clsactividad;
                    $laactividad=$lobjactividad->consultar_actividad_inactivos();
                    for($i=0;$i<count($laactividad);$i++)
                    {
                       // $dependencia=false;
                        $lobjactividad->idActividad=$laactividad[$i][0];
                        //$dependencia=$lobjtactividad->consultar_dependencia();
                        if($laactividad[$i][3])
                        {
                            $laactividad[$i][3]='Activo';
                        }
                        elseif(!$laactividad[$i][3]) 
                        {
                            $laactividad[$i][3]='Inactivo';
                        }

                        echo '<tr>';
                        echo '<td>'.$laactividad[$i][0].'</td>';
                        echo '<td>'.$laactividad[$i][1].'</td>';
                        echo '<td>'.$laactividad[$i][2].'</td>';
                        echo '<td>'.$laactividad[$i][3].'</td>';
                        if($consultar || $eliminar)
                        {
                            echo '<td>';
                            if($consultar && $laactividad[$i][3]=='Activo')
                            {
                                echo '<a class="btn btn-info" href="#" title="Consultar" onclick="buscar('.$laactividad[$i][0].')"><i class="icon-search icon-white"></i></a> ';
                            }
                           // if($eliminar && $dependencia==false)
                            {
                                if($laactividad[$i][3]=='Activo')
                                {
                                    echo '<a class="btn btn-danger" href="#" title="Desactivar" onclick="eliminar('.$laactividad[$i][0].')" ><i class="icon-remove icon-white"></i></a> ';
                                    
                                }
                                elseif ($laactividad[$i][3]=='Inactivo') 
                                {
                                    echo '<a class="btn btn-warning" title="Restaurar" href="#" onclick="restaurar('.$laactividad[$i][0].')" ><i class="icon-refresh icon-white"></i></a>';
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