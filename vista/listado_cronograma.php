 <?php
 	include_once("../clases/cls_Listado_Cronograma.php");
 	$listar= new cls_Listado_Cronograma();
 	$Cronogramas=$listar->Listado_Cronograma();
 	//print_r($Cronogramas);
 ?>

 <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
 
 <section class="columns">
 	<h2>Listado <span class="text-green">Cronogramas</span></h2>
 	<article class="col1 ">
 		<table>
 			<tr>
 				<td>Tema</td>
 				<td>Empresa</td>
 				<td>Fecha</td>
 				<td>Hora</td>
 				<td></td>
 			</tr>
 			<?php
 				for ($i=0; $i < count($Cronogramas); $i++) { 
 					echo '
	 					<tr>
			 				<td>'.$Cronogramas[$i][3].'</td>
			 				<td>'.$Cronogramas[$i][0].'</td>
			 				<td>'.$Cronogramas[$i][4].'</td>
			 				<td>'.$Cronogramas[$i][6].'</td>
			 				<td><a href="#" class="link" data-toggle="modal" data-target=".modal'.$i.'">Ver mas</a></td>
			 			</tr>

	 				';

	 				echo '
	 				<style>
						.modal-body p{
							font-size:12px;
						}
	 				</style>
						<!-- Small modal -->
			                  <div class="modal fade modal'.$i.'" tabindex="-1" role="dialog" aria-hidden="true">
			                      <div class="modal-content">

			                        <div class="modal-header bg-magenta">
			                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
			                          </button>
			                          <h4 class="modal-title" id="myModalLabel2">Le informamos...</h4>
			                        </div>
			                        <div class="modal-body">
			                        	<h6> La actividad <span class="text-green">'.$Cronogramas[$i][3].'</span> se llevará a cabo en <span class="text-green">'.$Cronogramas[$i][0].'</span></h6>
			                        	<p>Esta sera dirigida por el Representante del CAIDV '.$Cronogramas[$i][2].'</p>
			                        	<p>En la siguiente fecha '.$Cronogramas[$i][4].' a '.$Cronogramas[$i][5].'</p>
			                        	<p>En un horario comprendido entre '.$Cronogramas[$i][6].' a '.$Cronogramas[$i][7].'</p>

			                          
				                        <div class="col-md-8 col-xs-12 col-sm-8">
				                          
					                        <div class="modal-footer">
			                          			<button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Cerrar</span>
					                        </div>
											</div>
				                        </div>
			                        
					                    <div style="width:100%;height:0px;clear:both;"></div>
			                    </div>
			                  </div>
			                 <!-- /modals -->
	 				';
 				}
 				
 			?>
 		</table>
 		
 	</article>
 	<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
 <script type="text/javascript" src="../bootstrap/js/jquery.js"></script>
 	<!-- /article -->

 	
 </section>