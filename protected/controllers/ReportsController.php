<?php

class ReportsController extends Controller {

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                //'actions'=>array('*'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function actionIndex() {
        $model = new Reports;
        $tabs = array();
        if (!Yii::app()->user->A1() && !Yii::app()->user->ADM() && !Yii::app()->user->GG())
            $model->company = Yii::app()->getSession()->get('id_empresa');

        if (isset($_POST['Reports'])) {
            $model->attributes = $_POST['Reports'];




            if (isset($_POST['loadData'])) {
                //reporte por contratista
                if ($model->type == 1) {
                    $model->scenario = 'rcontractor';
                }
                if ($model->type == 2) {
                    $model->scenario = 'rcc';
                }
            }

            if ($model->validate()) {

                if (isset($_POST['generatexls'])) {
                    $this->SetXls($model->data);
                }
            }
        }

        $this->render('index', array('model' => $model, 'tabs' => $tabs));
    }

    private function setXlsBase($objPHPExcel, $filename) {

        ini_set('display_errors', TRUE);
        ini_set('display_startup_errors', TRUE);
        error_reporting(E_ALL);
        define('EOL', (PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
        /** Include path * */
        date_default_timezone_set('UTC');
        // echo date('H:i:s') . " Create new PHPExcel object\n";
        $objPHPExcel->getProperties()->setCreator("Reporte Ordenes de trabajo");
        $objPHPExcel->getProperties()->setLastModifiedBy("Ots");




        // Set default font
        $xlsName = $filename . '.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $xlsName . '"');
        header('Cache-Control: max-age=0');

        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function SetXls($data) {
        $objPHPExcel = new PHPExcel();
        $index = 0;
        $objPHPExcel->removeSheetByIndex(0);
        foreach ($data as $key => $value) {
            
            $row = 3;
            $column = 'A';
            $contratista = Contratista::model()->findByPk($key);
            $objPHPExcel->createSheet($index);
            $objPHPExcel->setActiveSheetIndex($index);
            $sheet = $objPHPExcel->getActiveSheet();
            $sheet->setTitle($contratista->RUT_CONTRATISTA);
            $sheet->setCellValue('A1', $contratista->concatened);
            $this->fillAndLetter($sheet, 'A1', 'FFFFFF', '009900', 20);
            //$this->drawBorder($sheet, array('A', 1, 'L', 1));
            $titles = array(array("Numero Ot", "Numero de Item", "Creador", "Detalle", "Numero Cotizacion", "Tipo Moneda", "Costo Contratista", "Centro de costo", "Cuenta", "Sub Centro de Costo", "Seccion", "Fecha OT"));
            $sheet->fromArray($titles, null, 'A3');
            $sheet->setAutoFilter("A3:L3");
            $this->fillAndLetter($sheet, $column . $row . ':L' . $row, '009900', 'FFFFFF', 16);
            $row++;
            foreach ($value as $v) {

                $money = TipoMoneda::model()->findByPk($v->iDOT->ID_TIPO_MONEDA);
                $sheet->setCellValue($column++ . $row, $v->iDOT->NUMERO_OT);
                $sheet->setCellValue($column++ . $row, $v->NUMERO_SUB_ITEM);
                $sheet->setCellValue($column++ . $row, $v->iDOT->creador->concatened);
                $sheet->setCellValue($column++ . $row, $v->NOMBRE_SUB_ITEM);
                $sheet->setCellValue($column++ . $row, $v->NRO_COTIZACION);
                $sheet->setCellValue($column++ . $row, $money->TIPO_MONEDA);
                $sheet->setCellValue($column++ . $row, $v->COSTO_CONTRATISTA);
                $sheet->setCellValue($column++ . $row, $v->centroCosto->concatened);
                $sheet->setCellValue($column++ . $row, @$v->iDCCC->concatened);
                $sheet->setCellValue($column++ . $row, @$v->iDSCC->concatened);
                $sheet->setCellValue($column++ . $row, @$v->iDSEC->concatened);
                $this->setFormatDate($sheet, $column . $row, $v->iDOT->FECHA_OT);
                $this->fillAndLetter($sheet, 'A' . $row . ':' . $column . $row, $row % 2 == 0 ? 'DDDDDD' : 'FFFFFF', '000000', 12);
                $this->drawBorder($sheet, array('A', 3, $column, $row++), '009900');
                $column = 'A';
            }
            for ($col = 'A'; $col !== 'M'; $col++) {
                $objPHPExcel->getActiveSheet()->getColumnDimension($col)
                        ->setAutoSize(true);
            }
            $index++;
        }


        //$this->autosize($sheet, 'L');
        $this->setXlsBase($objPHPExcel, 'reporte-' . uniqid());

        Yii::app()->end();
    }

    public function setReport($data) {
        $tabs = array();
        if (isset($data['error']))
            $tabs['Error'] = "<h2 class=\"red\">No existen Datos Asociados</h2>";
        else
            foreach ($data as $key => $ins) {
                $html = "";
                $contratista = Contratista::model()->findByPk($key);
                $html .= "<table class=\"report-table\">";
                $html.="<thead>"
                        . "<th>Numero Ot</th>"
                        . "<th>Numero de Item</th>"
                        . "<th>Creador</th>"
                        . "<th>Detalle</th>"
                        . "<th>Numero Cotizacion</th>"
                        . "<th>Tipo Moneda</th>"
                        . "<th>Costo Contratista</th>"
                        . "<th>Centro de costo</th>"
                        . "<th>Cuenta</th>"
                        . "<th>Sub Centro de Costo</th>"
                        . "<th>Seccion</th>"
                        . "<th>Fecha OT</th>"
                        . "</thead>";
                $class = 'rtdw';
                foreach ($ins as $i) {

                    //print_r($ot);
                    // die($ot->insumos_ot[0]->NOMBRE_SUB_ITEM);
                    $money = TipoMoneda::model()->findByPk($i->iDOT->ID_TIPO_MONEDA);

                    $html.= "<tbody><tr class='$class' >";
                    $html.=
                            "<td>" . $i->iDOT->NUMERO_OT . "</td>" .
                            "<td>" . $i->NUMERO_SUB_ITEM . "</td>" .
                            "<td>" . $i->iDOT->creador->concatened . "</td>" .
                            "<td class=\"detail-report\">" . $i->NOMBRE_SUB_ITEM . "</td>" .
                            "<td>" . $i->NRO_COTIZACION . "</td>" .
                            "<td>" . $money->TIPO_MONEDA . "</td>" .
                            "<td>" . $this->getFormat($money->ID_TIPO_MONEDA, $i->COSTO_CONTRATISTA) . "</td>" .
                            "<td>" . $i->centroCosto->concatened . "</td>" .
                            "<td>" . @$i->iDCCC->concatened . "</td>" .
                            "<td>" . @$i->iDSCC->concatened . "</td>" .
                            "<td>" . @$i->iDSEC->concatened . "</td>" .
                            "<td>" . Yii::app()->dateFormatter->format('dd MMMM yyyy HH:mm', @$i->iDOT->FECHA_OT) . "</td>";
                    if ($class == 'rtdw')
                        $class = 'rtdg';
                    else
                        $class = 'rtdw';
                    $html.= "</tr></tbody>";
                }
                $html.= "</table></br>";
                $tabs[$contratista->concatened] = $html;
            }


        return $tabs;
    }

    public function getSubString($string, $length = 30) {
        //Si no se especifica la longitud por defecto es 50
        //Primero eliminamos las etiquetas html y luego cortamos el string
        $stringDisplay = substr(strip_tags($string), 0, $length);
        //Si el texto es mayor que la longitud se agrega puntos suspensivos
        if (strlen(strip_tags($string)) > $length)
            $stringDisplay .= ' ...';
        return $stringDisplay;
    }

    static function getFormat($type, $money) {


        switch ($type) {
            case 1:
                return number_format($money, 0, ',', '.');
                break;
            case 2:
                return number_format($money, 2, '.', ' ');
                break;
            default:
                return number_format($money, 2, ',', '.');
        }
    }

    private function fillAndLetter($sheet, $cordinate, $colorfill, $colorfont, $fontsize) {
        $sheet->getStyle($cordinate)->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => $colorfill)
                    ),
                    'font' => array(
                        'bold' => true,
                        'color' => array('rgb' => $colorfont,
                            'size' => $fontsize),
                    ),
        ));
    }

    private function setFormatDate($sheet, $cordenate, $date) {
        $unixTimestamp = strtotime($date);
        $excelDate = PHPExcel_Shared_Date::PHPToExcel($unixTimestamp);
        $sheet->getStyle($cordenate)
                ->getNumberFormat()->setFormatCode('dd-mmmm-yyyy hh:mm');
        $sheet->setCellValue($cordenate, $excelDate);
    }

    public function autosize($sheet, $lastColumn) {
        PHPExcel_Shared_Font::setAutoSizeMethod(PHPExcel_Shared_Font::AUTOSIZE_METHOD_EXACT);
        foreach (range('A', $lastColumn) as $columnID) {
            $sheet->getColumnDimension($columnID)
                    ->setAutoSize(true);
        }
    }

    /**
     * 
     * @param type $objPHPExcel
     * @param type $coordinates 
     * @param type $color
     * 
     *       
     */
    private function drawBorder($sheet, $coordinates, $color = '000000') {

        $column = $coordinates[0];
        $row = $coordinates[1];
        $endc = $coordinates[2];
        $endrow = $coordinates[3];
        for ($c = $column; $c <= $endc; $c++) {
            for ($r = $row; $r <= $endrow; $r++) {
                $sheet->getStyle($c . $r)->applyFromArray(
                        array(
                            'borders' => array(
                                'outline' => array(
                                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                                    'color' => array('rgb' => $color),
                                ),
                )));
            }
        }
    }

}
