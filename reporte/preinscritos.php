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
   include_once("../clases/clase_preinscripcion.php");
   ob_end_clean();
   require_once("../libreria/fpdf/clsFpdf.php");
    require_once("../clases/clase_bitacora.php");
   require_once('../libreria/utilidades.php');
   require_once('../libreria/uuid.php');
   $lobjBitacora=new clsBitacora;
   $lobjUtil=new clsUtil;
   //$ObjLapso = new clsLapso();
   //$ObjCurso = new clsCurso();
   $d = new clsPreinscripcion();
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
	$d->fecha_preinscripcion=$_POST["fecha_i"];
	$d->fecha_fin=$_POST["fecha_f"];
	$fecha_i=explode("-", $_POST["fecha_i"]);
	$fecha_f=explode("-", $_POST["fecha_f"]);
   if($_POST["fecha_i"]!="" && $_POST["fecha_f"]=="" ){
   	$lobjPdf->Cell(0,6,utf8_decode("HISTORIAL DE PREINSCRIPCIONES DESDE LA FECHA: ".$fecha_i[2]."/".$fecha_i[1]."/".$fecha_i[0]),0,1,"C");	
   }else if($_POST["fecha_i"]!="" && $_POST["fecha_f"]!=""){
   	$lobjPdf->Cell(0,6,utf8_decode("HISTORIAL DE PREINSCRIPCIONES ENTRE LAS FECHAS: ".$fecha_i[2]."/".$fecha_i[1]."/".$fecha_i[0]." - ".$fecha_f[2]."/".$fecha_f[1]."/".$fecha_f[0]),0,1,"C");	
   }else{
   	$lobjPdf->Cell(0,6,utf8_decode("HISTORIAL DE PREINSCRIPCIONES"),0,1,"C");	
   }
   	$lobjPdf->Cell(20);
    $lobjPdf->Cell(40,6,utf8_decode('Nro de participante'),1,0,"C"); 
	$lobjPdf->Cell(27,6,utf8_decode('Cedula'),1,0,"C");
	$lobjPdf->Cell(40,6,utf8_decode('Primer nombre'),1,0,"C");
	$lobjPdf->Cell(40,6,utf8_decode('Primer apellido'),1,0,"C");
	$lobjPdf->Cell(15,6,utf8_decode('Sexo'),1,0,"C");
	$lobjPdf->Cell(25,6,utf8_decode('Telefono'),1,0,"C");
	$lobjPdf->Cell(45,6,utf8_decode('Fecha de Nacimiento'),1,0,"C");
	$lobjPdf->Cell(50,6,utf8_decode('Fecha de preinscripcion'),1,1,"C");
  
	
	$r=$d->consultar_reporte();
		for($i=0;$i<count($r);$i++)
		{
			$lobjPdf->SetFont("arial","",9);
			$lobjPdf->Cell(20);
			$lobjPdf->Cell(40,6,utf8_decode($r[$i]["idparticipante"]),1,0,"C"); 
			$lobjPdf->Cell(27,6,utf8_decode($r[$i]["cedula"]),1,0,"C");
			$lobjPdf->Cell(40,6,utf8_decode($r[$i]["primer_nombre"]),1,0,"C");
			$lobjPdf->Cell(40,6,utf8_decode($r[$i]["primer_apellido"]),1,0,"C");
			$lobjPdf->Cell(15,6,utf8_decode($r[$i]["sexo"]),1,0,"C");
			$lobjPdf->Cell(25,6,utf8_decode($r[$i]["telefono"]),1,0,"C");
			$lobjPdf->Cell(45,6,utf8_decode($r[$i]["fecha_m"]),1,0,"C");	
			$lobjPdf->Cell(50,6,utf8_decode($r[$i]["fecha_p"]),1,0,"C");	
		}

	
   $lobjPdf->Output(); 
?>