<?php
    include_once("../clases/cls_Listado_Cronograma.php");
    $listar= new cls_Listado_Cronograma();
    $Cronogramas=$listar->Listado_Cronograma();
?>
<div style="float: left" class="col-lg-8 span8 pull-left">
    <h3>Rol</h3>
   <div class="alert alert-info">
        <ul>
            En este módulo podrá generar los certificados para las actividades 
        </ul>
    </div>
    <div class="col-md-8" style='min-height:330px'>
        <style>
            table{
                margin: 20px 0px;
            }
            table tr{
                border-bottom: 1px solid silver;
                font-size: 12px;
            }
            table tr td{padding: 5px !important;}
            table tr:first-child{
                font-weight: bold;
                font-size: 14px;
            }
        </style>
        <table width="800">
            <tr>
                <td>Actividad</td>
                <td>Empresa</td>
                <td></td>
            </tr>
            <?php
                for ($i=0; $i < count($Cronogramas); $i++) { 
                    echo '
                        <tr>
                            <td>'.$Cronogramas[$i][3].'</td>
                            <td>'.$Cronogramas[$i][0].'</td>
                            <td><a href="../reporte/reporte_actividad.php?e='.$Cronogramas[$i][0].'&fi='.$Cronogramas[$i][4].'&ff='.$Cronogramas[$i][5].'&a='.$Cronogramas[$i][3].'&hi='.$Cronogramas[$i][6].'&hf='.$Cronogramas[$i][7].'&enc='.$Cronogramas[$i][2].'&caidv='.$Cronogramas[$i][1].'" class="link" >Generar Certificado</a></td>
                        </tr>

                    ';

                }
                
            ?>
        </table>
    </div>
</div>