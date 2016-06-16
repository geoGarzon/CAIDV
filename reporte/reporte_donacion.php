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
	$lobjPdf->Cell(50,6,utf8_decode("Certificado Nro:".$_POST['idDonacion']),0,1,"C");		
	
	 
	 $lobjPdf->Cell(0,6,utf8_decode("CERTIFICADO DE DONACION"),0,1,"C");	
	 $lobjPdf->Ln(6);
	 $lobjPdf->Cell(140);
	 $lobjPdf->Cell(25,6,utf8_decode("Se otroga a: "),0,0,"C");
	 $e=$d->consultar_empresa_id();
	 $p=$d->consultar_persona_id();
	 if($e[0]["nombre"]!="NO APLICA"){
	 	$lobjPdf->Cell(25,6,utf8_decode($e[0]["nombre"]),0,1,"C");
	 }else{
	 	$lobjPdf->Cell(25,6,utf8_decode($p[0]["primer_nombre"]." ".$p[0]["primer_apellido"]),0,1,"C");
	 }

		
	 
	
	$lobjPdf->Ln(6);

	$lobjPdf->Cell(0,6,utf8_decode("Agradecemos de su valiosa colaboración al donar"),0,1,"C");	
	$lobjPdf->Cell(0,6,utf8_decode("y apoyarnos en alcanzar los objetivos y metas, que como"),0,1,"C");	
	$lobjPdf->Cell(0,6,utf8_decode("institución nos hemos trazado, beneficiando a personas con deficiencia visual."),0,1,"C");	
	$lobjPdf->Ln(2);



	
   	$lobjPdf->Cell(20);
    $lobjPdf->Cell(40,6,utf8_decode('Rif:'),1,0,"C"); 
	$lobjPdf->Cell(27,6,utf8_decode('Cedula'),1,0,"C");
	$lobjPdf->Cell(40,6,utf8_decode('Primer nombre'),1,0,"C");
	$lobjPdf->Cell(40,6,utf8_decode('Primer apellido'),1,0,"C");
	$lobjPdf->Cell(35,6,utf8_decode('Rif'),1,0,"C");
	$lobjPdf->Cell(70,6,utf8_decode('Nombre de la empresa'),1,0,"C");
	$lobjPdf->Cell(23,6,utf8_decode('Fecha'),1,0,"C");
	$lobjPdf->Cell(25,6,utf8_decode('Estado'),1,1,"C");
  
	
	$r=$d->consultar_reporte_id();
	
			$lobjPdf->SetFont("arial","",9);
			$lobjPdf->Cell(20);
			$lobjPdf->Cell(40,6,utf8_decode($r["rif"]),1,0,"C"); 
			$lobjPdf->Cell(27,6,utf8_decode($r["cedula"]),1,0,"C");
			$lobjPdf->Cell(40,6,utf8_decode($r["primer_nombre"]),1,0,"C");
			$lobjPdf->Cell(40,6,utf8_decode($r["primer_apellido"]),1,0,"C");
			$lobjPdf->Cell(35,6,utf8_decode($r["rif"]),1,0,"C");
			$lobjPdf->Cell(70,6,utf8_decode($r["nombre"]),1,0,"C");
			$lobjPdf->Cell(23,6,utf8_decode($r["fecha_a"]),1,0,"C");	
			$lobjPdf->Cell(25,6,utf8_decode($r["estatus_d"]),1,1,"C");	

	$lobjPdf->Cell(20);
	$lobjPdf->SetFont("arial","B",12);
    $lobjPdf->Cell(100,6,utf8_decode('Articulo:'),1,0,"C"); 
	$lobjPdf->Cell(100,6,utf8_decode('Serial/Factura'),1,0,"C");
	$lobjPdf->Cell(100,6,utf8_decode('Cantidad'),1,1,"C");

	$r=$d->consultar_reporte_detalle_id();
	for($i=0;$i<count($r);$i++){
		$lobjPdf->SetFont("arial","",9);
		$lobjPdf->Cell(20);
		$lobjPdf->Cell(100,6,utf8_decode($r[$i]["nombre"]),1,0,"C"); 
		$lobjPdf->Cell(100,6,utf8_decode($r[$i]["serial_factura"]),1,0,"C");
		$lobjPdf->Cell(100,6,utf8_decode($r[$i]["cantidad"]),1,1,"C");
	}
	$lobjPdf->Ln(20);
	$lobjPdf->Cell(140);
	$lobjPdf->Cell(50,0,utf8_decode(''),1,1,"C");
	$lobjPdf->Ln(1);
	$lobjPdf->Cell(0,3,utf8_decode('Firma director(a)'),0,1,"C");

		

	
   $lobjPdf->Output(); 
?>