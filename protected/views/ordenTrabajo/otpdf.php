<?php


//require_once dirname(__FILE__) . '/../../models/OrdeneTrabajo.php';   

genFile();

function genFile() {
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, '¡Hola, Mundo!');
    $pdf->Output("", "I");
    //$bitacoras = Bitacora::model()->findAllByAttributes(array('fecha_bitacora'=>date('Y-m-d')));
//		foreach ($bitacoras as $key6 => $value6){
//			$pdf->AddPage();
//			if ($con_titulo==false) {
//				$pdf->titulo();
//				$con_titulo = true;
//			}
//			
//			$pdf->SetFont('Times','',14);
//			$pdf->SetDrawColor(0, 0, 0);
//				
//			//$pdf->SetLink(array_shift($array_links));
//			$pdf->resumen_bitacora($value6);
//			$registros = DetallesBitacora::model()->findAllByAttributes(array('id_bitacora'=>$value6->id_bitacora));
//			$pdf->detalle_bitacora($registros);
//			//$pdf->observaciones($value6);
//			
//	
//    $pdf->Cell(30, 10, 'Registros Asociados', 0, 0);	
//    $pdf->Cell(40,10,'Hello World !',1);
//    $pdf->Output("", "I");
    //$pdf->Output($dir);
}
