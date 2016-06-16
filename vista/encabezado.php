<?php
function encab($rut)
{
			//$lsRolNombre=$_SESSION["rolNombre"];

			$encabe=utf8_decode('
		<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; margin-left:-15px; margin-right:-15px;">
			<div class="navbar-header">
				<img src="'.$rut.'logos/encabezado.png" alt="CAIDV" width="100%" height="100px">');
				
			if (!empty($lsRolNombre))
			{
				$encabe.=utf8_decode('<button style="margin-left:10px; padding-left:2px; padding-right:2px; width:auto; color:#31708f; font-weight:bold; position:absolute; top:30%; right:26%;" class="form-control" disabled>'.$lsRolNombre.'</button>');
			}

			$encabe.=utf8_decode('
			</div>
		</nav>');

				print($encabe);


}

function footer()
{
$footer=utf8_decode('
		<footer class="footer">
			<div class="inner" style="margin-top:25px;">
	              <center><p>CAIDV</p></center>
      		</div>
      	</footer>');
	print($footer);
}

?>