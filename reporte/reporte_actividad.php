<?php
if(0){
		error_reporting(E_ALL & ~E_NOTICE);
		ini_set("display_errors","on");
	}else{
		error_reporting(0);
		ini_set("display_errors","off");
	}
   date_default_timezone_set('America/Caracas');
   //include_once("../clases/clase_lapso.php");
   include_once("../clases/clase_donacion.php");
   ob_end_clean();
   require_once("../libreria/fpdf/clsFpdf.php");
    require_once("../clases/clase_bitacora.php");
   require_once('../libreria/utilidades.php');
   require_once('../libreria/uuid.php');
   $lobjBitacora=new clsBitacora;
   $lobjUtil=new clsUtil;
   //$ObjLapso = new clsLapso();
   //$ObjCurso = new clsCurso();
   $d = new clsDonacion();
    $lobjPdf=new clsFpdf();
   $lcReal_ip=$lobjUtil->get_real_ip();
    $ldFecha=date('Y-m-d h:m');
    
   $lobjPdf->AliasNbPages();
   $lobjPdf->codigo=UUID::v4();
   $lobjPdf->AddPage("L","Legal");
   $lobjPdf->SetFont("arial","B",12);
   $IdLapso=(isset($_GET['idlapso']))?$_GET['idlapso']:'';
   	//$lobjBitacora->set_Datos($_SERVER['HTTP_REFERER'],$ldFecha,$lcReal_ip,'Reporte','-','Historial','-',$lobjPdf->codigo,$IdLapso,$_SESSION['usuario'],'historial_donacion'); //envia los datos a la clase bitacora
   	//$lobjBitacora->registrar_bitacora();//registra los datos en la tabla tbitacora.
   	//$ObjLapso->set_Lapso($IdLapso);
   	//$ObjCurso->set_Lapso($IdLapso);
	//$row_detalle=$ObjLapso->historial_lapso();
	//$row_lapso=$ObjLapso->consultar_lapso_bitacora();
	//row_cursos=$ObjCurso->historial_cursos();

   
   $lobjPdf->Ln(10);
   $d->idDonacion=$_POST["idDonacion"];
   $d->idPersona=$_POST["idPersona"];
   $d->idEmpresa=$_POST["idEmpresa"];
	$lobjPdf->Cell(50,6,utf8_decode(""),0,1,"C");		
	
	 
	 $lobjPdf->Cell(0,6,utf8_decode("CERTIFICADO DE PARTICIPACION"),0,1,"C");	
	 $lobjPdf->Ln(6);
	 $lobjPdf->Cell(140);
	 $lobjPdf->Cell(30,6,utf8_decode("Se otroga a: "),0,0,"L");
	 $e=$d->consultar_empresa_id();
	 $p=$d->consultar_persona_id();
	 
	 	$lobjPdf->Cell(100,6,utf8_decode($_GET['e']),0,1,"L");

		
	 
	
	$lobjPdf->Ln(6);

	$lobjPdf->Cell(0,6,utf8_decode("Agradecemos de su valiosa colaboración al Participar"),0,1,"C");	
	$lobjPdf->Cell(0,6,utf8_decode("y apoyarnos en alcanzar los objetivos y metas, que como"),0,1,"C");	
	$lobjPdf->Cell(0,6,utf8_decode("institución nos hemos trazado, siendo participe al difundir al CAIDV como ente "),0,1,"C");	
	$lobjPdf->Cell(0,6,utf8_decode("educacional a personas con deficiencia visual."),0,1,"C");	
	$lobjPdf->Cell(0,6,utf8_decode(""),0,1,"C");	
	$lobjPdf->Ln(2);

	$lobjPdf->Cell(0,6,utf8_decode('la actividad '.$_GET['a'].' se llevo a cabo en las fechas "'.$_GET['fi'].'" a "'.$_GET['ff'].'" entre las horas "'.$_GET['hi'].'" a "'.$_GET['hf'].'" '),0,1,"C");	
	$lobjPdf->Cell(0,6,utf8_decode(' siendo en encargado por parte de "'.$_GET['e'].'" '.$_GET['enc'].' bajo la supervision del representate del CAIDV '.$_GET['caidv'].'.'),0,1,"C");	


	
   	
	$lobjPdf->Ln(20);
	$lobjPdf->Cell(140);
	$lobjPdf->Cell(50,0,utf8_decode(''),1,1,"C");
	$lobjPdf->Ln(1);
	$lobjPdf->Cell(0,3,utf8_decode('Firma director(a)'),0,1,"C");

		

	
   $lobjPdf->Output(); 
?>