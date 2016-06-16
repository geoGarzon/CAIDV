<?php
session_start();
//incluye la clase cuerpo donde se encuentran las funciones de construccion de maestros
include_once("../clases/cls_Cuerpo.php");
$lobj_Cuerpo=new cls_Cuerpo;
//recivo los valores que vienen del controlador
$la_Campos=$_SESSION["Campos"];
unset($_SESSION["Campos"]);
//recivo la data de los listados
$la_listados=$_SESSION["matriz"];
unset($_SESSION["matriz"]);
//instancio los nombre de los campos
$la_Nombres=Array("Codigo","Nombre","Descripcion","Estatus");

?>
<html>
<head>
		
		<title>Tipo Actividad</title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="css/estilo-general.css">
</head>


<body>

<div id="contenedor">
	<?php
		//Imprimo la cabecera del archivo desde cls_Cuerpo
		$lobj_Cuerpo->f_Cabecera();
		//luego se imprime el Menu
		$lobj_Cuerpo->f_Menu();
	?>
	


<div id="contenido">
	

<div class="ordenar"></div>
		<fieldset>
		<form name='form1' method='POST' action='../controladores/cor_tactividad.php'>
			<?php
				//se Imprimen todos los campos que controlan el funcionamiento del formulario 
				//pasandole como parametro el valor de los mismos
				$lobj_Cuerpo->f_ControlFormulario($la_Campos);
			?>
			<legend>ORGANISMO</legend>
			<table class="tabla-ordenada">
				<tr>
					<td align='right'>Código Tipo Actividad</td> 
					<td><input type="text" name='idTipoActividad' onKeyPress="return solonumeros(event)" value='<?php print($la_Campos['idTipoActividad']); ?>' onblur='f_PerderFocus()'></td>
				</tr>
				<tr>
					<td align='right'>Nombre Tipo Actividad</td> 
					<td><input type="text" name='Nombre' onKeyPress="return sololetras(event)" value='<?php print($la_Campos['Nombre']); ?>'></td>
				</tr>
				<tr>
					<td align='right'>Estatus</td>
					<td>
						<input type='radio' name='Estatus' id='Estatus1' <?php if($la_Campos['Estatus']=="A"){print("checked");}?> value='A'>Activo
						<input type='radio' name='Estatus' id='Estatus2' <?php if($la_Campos['Estatus']=="I"){print("checked");}?> value='I'>Inactivo
					</td>
				</tr>
			 </table>
		</fieldset>
			
 <div class="ordenar"></div>

</table>

 <div id='botones'>
	<input type='button' name='Nuevo' value='Nuevo' onclick='f_Nuevo();'/>
	<input type='button' name='Guardar' value='Guardar' onclick='f_Guardar();' />
	<input type='button' name='Cancelar' value='Cancelar' onclick='f_Cancelar();'/>
	<input type='button' name='Buscar' value='Buscar' onclick='f_Buscar();'/>
	<input type='button' name='Modificar' value='Modificar' onclick='f_Modificar();'/>
	<input type='hidden' name='Eliminar' value='Eliminar' onclick='f_Eliminar();'/>
 </div>
</form>



<div class="ordenar"></div>
	</div>
	<div id="pie"></div>
</div>
</body>
		<script type="text/javascript" src='JS/Mensajes.js'></script>
		<script type="text/javascript" src='JS/motorValidaciones.js'></script>
		<script type="text/javascript" src='JS/maestros.inicio.js'></script>
	<script type="text/javascript">

function sololetras(e) {
    //compatibilidad con navegadores para saber que tecla se pulso
    key = e.keyCode || e.which;

    //convertimos la letra a minuscula y lo pasamos de int a char
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz"; //caracteres admitidos
    especiales = [8, 39,9];
    
    tecla_especial = !1;
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }
    //si no pulse una tecla valida, y la tecla_especial no se pulso
    if(letras.indexOf(tecla) == -1 && !tecla_especial){
        return!1;
    }
}
function solonumeros(e){
	key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "0123456789";
    especiales = [8,39,9];

    tecla_especial = !1;
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }
    if(letras.indexOf(tecla) == -1 && !tecla_especial)
        return!1;
}

</script>

</html>