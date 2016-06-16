<?php
$consultar= $registrar= $eliminar=false;
for($i=0;$i<count($laModulos);$i++) 
    {
        $laServicios=$lobjRol->consultar_servicios_menu($laModulos[$i][0]); 
        for ($j=0; $j <count($laServicios) ; $j++) //Se recorre un ciclo para poder extraer los datos de cada uno de los servicios que tiene asignado el modulo para poder constuir el menú
        {
            if($laServicios[$j][2]=='donacion/consultar_empresa')
            {
                $consultar=true;
            }
            if($laServicios[$j][2]=='donacion/registrar_empresa')
            {

                $registrar=true;
            }
            if($laServicios[$j][2]=='donacion/eliminar_empresa')
            {
                $eliminar=true;
            }
        }
    }
?>
<script>
 function buscar(id)
 {
    window.location.href="?vista=donacion/consultar_empresa&o=Consultar&id="+id;
 }
  function eliminar(id)
  {
     if(confirm("¿Esta seguro que desea desactivar la empresa seleccionado?"))
    {
      document.getElementById("cam_idEmpresa").value=id;
      document.form_modulo.submit();
    }
  }
    function restaurar(id)
  {
     if(confirm("¿Esta seguro que desea restaurar la empresa seleccionado?"))
    {
      document.getElementById("cam_idEmpresa").value=id;
      document.getElementById("cam_operacion").value='restaurar_empresa';
      document.form_modulo.submit();
    }
  }
    $(document).ready(function() {
        oTable = $('#filtro').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "iDisplayLength": 5                    
        });
    } );
</script>
<style>
    body, input, textarea{
        text-transform: uppercase;
    }
</style>
<!--datatable-->  
<div style="float: left" class="col-lg-8 span8 pull-left">
    <h3>Empresas</h3>
    <div class="alert alert-info">
        <ul>
            En este módulo podrá registrar, consultar, editar, desactivar y activar los tipos de articulo del sistema.
        </ul>
    </div>
    <form action="../controlador/control_empresa.php" method="POST" name="form_modulo">
        <input type="hidden" value="eliminar_empresa" name="operacion" id="cam_operacion"/>
        <input type="hidden"  name="idEmpresa" id="cam_idEmpresa"/>
        <?php
        if($registrar)
        {
            echo '<a class="btn btn-success" id="btn_registrar" href="?vista=donacion/registrar_empresa"><i class="icon-plus icon-white"></i> Registrar Empresas</a>';
        }
        ?>
        <table class="table table-striped table-hover table-bordered bootstrap-datatable datatable dataTable" id="filtro">
            <thead>
                <th>Código</th><th>Rif</th><th>Nombre</th><th>Primer telefono</th><th>Segundo Telefono</th><th>Correo</th><th>Estatus</th><?php if($consultar || $eliminar)
                        { echo '<th>Acción</th>';}?>
            </thead>
            <tbody>
            <?php
                    require_once('../clases/clase_empresa.php');
                    $lobjModulo = new clsEmpresa;
                    $laModulos=$lobjModulo->consultar_empresa();
                    for($i=0;$i<count($laModulos);$i++)
                    {
                        $dependencia=false;
                        $lobjModulo->idEmpresa=$laModulos[$i][0];
                        //$dependencia=$lobjModulo->consultar_dependencia();
                        if($laModulos[$i][7])
                        {
                            $laModulos[$i][7]='Activo';
                        }
                        elseif(!$laModulos[$i][7]) 
                        {
                            $laModulos[$i][7]='Inactivo';
                        }

                        echo '<tr>';
                        echo '<td>'.$laModulos[$i][0].'</td>';
                        echo '<td>'.$laModulos[$i][1].'</td>';
                        echo '<td>'.$laModulos[$i][2].'</td>';
                        echo '<td>'.$laModulos[$i][4].'</td>';
                        echo '<td>'.$laModulos[$i][5].'</td>';
                        echo '<td>'.$laModulos[$i][6].'</td>';
                        echo '<td>'.$laModulos[$i][7].'</td>';
                        if($consultar || $eliminar)
                        {
                            echo '<td>';
                            if($consultar && $laModulos[$i][7]=='Activo')
                            {
                                echo '<a class="btn btn-info" href="#" onclick="buscar('.$laModulos[$i][0].')"><i class="icon-search icon-white"></i></a>';
                            }
                            if($eliminar && $dependencia==false)
                            {
                                if($laModulos[$i][7]=='Activo')
                                {
                                    echo '<a class="btn btn-danger" href="#" onclick="eliminar('.$laModulos[$i][0].')" ><i class="icon-remove icon-white"></i></a>';
                                }
                                elseif($laModulos[$i][7]=='Inactivo')
                                {
                                    echo '<a class="btn btn-warning" title="Revertir Cambios" href="#" onclick="restaurar('.$laModulos[$i][0].')" ><i class="icon-refresh icon-white"></i></a>';
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