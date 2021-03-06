<?php

class OrdenTrabajoController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            //R
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('viewPDF', 'view', 'admin', 'SelectCuentas', 'selectSubCentros', 'selectSecciones', 'viewAllInsumos', 'viewallticket', 'FastView', 'test'),
                'users' => array('@')
            //grupo 
            //'expression'=>'$user->U2()',
            ),
            //CRUD todos los permisos otorgados a las cuentas indicadas
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'viewOt', 'delete', 'aprobarOt', 'CambiarPendiente', 'aprobarOtView', 'Upload', 'rechazarOtView', 'reaprobarOtView'),
                'expression' => '$user->A1()|| $user->ADM() || $user->GG() || $user->GOP() || $user->JDP() || $user->LOG()|| $user->OP()',
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'expression' => '$user->A1()',
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionSelectCuentas() {
        $id_cc = $_POST['InsumosOT']['ID_CENTRO_COSTO'];
        $criteria = new CDbCriteria();
        $criteria->condition = "ID_CENTRO_COSTO=:id_cc";
        $criteria->params = array(':id_cc' => $id_cc);
        $criteria->order = 'NUMERO_CUENTA ASC';
        //$lista = SubCentroCosto::model()->findAll('ID_CENTRO_COSTO=:id_cc',array(':id_cc'=>$id_cc));
        $lista = Ccc::model()->findAll($criteria);
        $lista = CHtml::listData($lista, 'ID_CCC', 'concatened');
        echo CHtml::tag('option', array('value' => ''), 'Seleccione', true);
        foreach ($lista as $valor => $descripcion) {
            echo CHtml::tag('option', array('value' => $valor), CHtml::encode($descripcion), true);
        }
    }

    public function actionSetStatus() {

        $ots = OrdenTrabajo::model()->findAll();
        foreach ($ots as $ot) {
            if($ot->ELIMINADO!=1)
            $ot->ELIMINADO=0;
            if ($ot->VOBO_GERENTE_GRAL == 1 && $ot->RECHAZAR_OT != 1)
                $ot->ESTADO_OT = 1;
            elseif ($ot->RECHAZAR_OT == 1)
                $ot->ESTADO_OT = 2;
            else
                $ot->ESTADO_OT = 0;
            $ot->save();
        }
    }

    public function actionSelectSubCentros() {
        $id_ccc = $_POST['InsumosOT']['ID_CCC'];
        $criteria = new CDbCriteria();
        $criteria->condition = "ID_CCC=:id_ccc";
        $criteria->params = array(':id_ccc' => $id_ccc);
        $criteria->order = 'SCC_NUMERO';
        //$lista = SubCentroCosto::model()->findAll('ID_CENTRO_COSTO=:id_cc',array(':id_cc'=>$id_cc));
        $lista = Scc::model()->findAll($criteria);
        $lista = CHtml::listData($lista, 'ID_SCC', 'concatened');

        echo CHtml::tag('option', array('value' => ''), 'Seleccione', true);

        foreach ($lista as $valor => $descripcion) {
            echo CHtml::tag('option', array('value' => $valor), CHtml::encode($descripcion), true);
        }
    }

    public function actionSelectSecciones() {
        $id_sub_cc = $_POST['InsumosOT']['ID_SCC'];
        $criteria = new CDbCriteria();
        $criteria->condition = "ID_SCC=:id_sub_cc";
        $criteria->params = array(':id_sub_cc' => $id_sub_cc);
        $criteria->order = 'SEC_NUMERO';
        //$lista = SeccionCentroCosto::model()->findAll('ID_SUB_CENTRO_COSTO=:id_sub_cc',array(':id_sub_cc'=>$id_sub_cc));
        $lista = Sec::model()->findAll($criteria);
        $lista = CHtml::listData($lista, 'ID_SEC', 'concatened');

        echo CHtml::tag('option', array('value' => ''), 'Seleccione', true);

        foreach ($lista as $valor => $descripcion) {
            echo CHtml::tag('option', array('value' => $valor), CHtml::encode($descripcion), true);
        }
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionFastView($id) {
        $model = $this->loadModel($id);
        $error = false;
        if ((Yii::app()->user->OP()) && $model->USUARIO_CREADOR != Yii::app()->user->id)
            $error = true;

        $usuario = Personal::model()->findByPk($model->USUARIO_CREADOR);
        $persona = Personal::model()->findByPk($model->ASIGNADO != Yii::app()->user->id);

        if ((Yii::app()->user->GOP()) && $model->ID_EMPRESA != Yii::app()->getSession()->get('id_empresa') && $model->ASIGNADO != Yii::app()->user->id)
            $error = true;
        if (Yii::app()->user->JDP() && $model->ID_EMPRESA != Yii::app()->getSession()->get('id_empresa')
//                && $model->USUARIO_CREADOR != Yii::app()->user->id  
//                && @$persona->ID_DEPARTAMENTO!=@$usuario->ID_DEPARTAMENTO
//                && $model->ASIGNADO!=Yii::app()->user->id 
//                && @$persona->iDDEPARTAMENTO->NOMBRE_DEPARTAMENTO != 'Logística'
        )
            $error = true;

        if ($error)
            throw new CHttpException(404, 'Usted no esta autorizado para realizar esta acción...');
        $sub_items = InsumosOT::model()->findAll(array('condition' => 'ID_OT=' . $id, 'order' => 'CAST(NUMERO_SUB_ITEM AS DECIMAL) ASC'));
        $this->renderPartial('fastView', array('id' => $id, 'model' => $model, 'sub_items' => $sub_items), false, true);
    }

    public function actionView($id) {
        $model = $this->loadModel($id);
        $error = false;
        if (isset($_POST['send']) && isset($_POST['OrdenTrabajo'])) {
            $model->setScenario('send');
            $model->ASIGNADO = $_POST['OrdenTrabajo']['ASIGNADO'];
            if ($model->save()) {
                $this->sendMail($model, 'Orden de Trabajo requiere aprobacion', 'body_ot_message', 'op', 'La orden de trabajo cuyo Nº es ' . $model->NUMERO_OT . ' requiere de su aprobacion');
            }
        }
        if ((Yii::app()->user->OP()) && $model->USUARIO_CREADOR != Yii::app()->user->id)
            $error = true;

        $usuario = Personal::model()->findByPk($model->USUARIO_CREADOR);
        $persona = Personal::model()->findByPk($model->ASIGNADO != Yii::app()->user->id);

        if ((Yii::app()->user->GOP()) && $model->ID_EMPRESA != Yii::app()->getSession()->get('id_empresa') && $model->ASIGNADO != Yii::app()->user->id)
            $error = true;
        if (Yii::app()->user->JDP() && $model->ID_EMPRESA != Yii::app()->getSession()->get('id_empresa')
//                && $model->USUARIO_CREADOR != Yii::app()->user->id  
//                && @$persona->ID_DEPARTAMENTO!=@$usuario->ID_DEPARTAMENTO
//                && $model->ASIGNADO!=Yii::app()->user->id 
//                && @$persona->iDDEPARTAMENTO->NOMBRE_DEPARTAMENTO != 'Logística'
        )
            $error = true;

        if ($error)
            throw new CHttpException(404, 'Usted no esta autorizado para realizar esta acción...');
        $sub_items = InsumosOT::model()->findAll(array('condition' => 'ID_OT=' . $id, 'order' => 'CAST(NUMERO_SUB_ITEM AS DECIMAL) ASC'));
        $this->render('view', array(
            'model' => $model,
            'sub_items' => $sub_items,
        ));
    }

    public function actionViewPDF($id) {
        $model = $this->loadModel($id);
        Yii::import('ext.MPDF57.mpdf', true);
        $detalle = InsumosOT::model()->findAll(array('condition' => 'ID_OT=' . $id, 'order' => 'CAST(NUMERO_SUB_ITEM AS DECIMAL) ASC'));
        $mpdf = new mpdf();
        if ($model->VOBO_ADMIN != 1 || $model->VOBO_JEFE_DPTO != 1 || $model->VOBO_GERENTE_OP != 1 || $model->VOBO_GERENTE_GRAL != 1) {
            if ($model->RECHAZAR_OT == 1)
                $mpdf->SetWatermarkText('Documento Rechazado');
            else
                $mpdf->SetWatermarkText('documento pendiente de aprobación');
            $mpdf->showWatermarkText = true;
        }
        $mpdf->WriteHTML($this->renderPartial('ot_pdf', array('model' => $model, 'detalle' => $detalle), true));
        $mpdf->Output();
    }

    public function actionTest() {
        
    }

    public function actionNumOt() {
        $empresa = Empresa::model()->findAll();
        foreach ($empresa as $e) {
            echo "para " . $e->NOMBRE_EMPRESA . "<br>";
            $contador = 1;
            $criteria = new CDbCriteria();
            $criteria->condition = 'ID_EMPRESA=' . $e->ID_EMPRESA;
            $correlativo = Correlativo::model()->find($criteria);
            if (empty($correlativo)) {
                $correlativo = new Correlativo;
                $correlativo->ID_EMPRESA = $e->ID_EMPRESA;
                $correlativo->NUMERO_CORRELATIVO = $contador;
                $correlativo->save(false);
                echo "se creo nuevo correlativo n° " . $contador . "<br>";
            }
            $ordenTrabajo = OrdenTrabajo::model()->findAll($criteria);
            foreach ($ordenTrabajo as $ot) {
                if ($e->ID_EMPRESA == 1) {
                    $ot->NUMERO_OT = $ot->ID_OT;
                    $contador = $ot->ID_OT;
                } else
                    $ot->NUMERO_OT = $contador;
                $contador++;
                $ot->save(false);
            }
            $correlativo->NUMERO_CORRELATIVO = $contador;
            $correlativo->save(false);
            echo "se actualizo correlativo n° " . $contador . "<br>";
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new OrdenTrabajo;
        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);
        if (isset($_POST['OrdenTrabajo'])) {
            $model->attributes = $_POST['OrdenTrabajo'];
            if (empty($model->ID_EMPRESA) || $model->ID_EMPRESA == '')
                $model->ID_EMPRESA = Yii::app()->getSession()->get('id_empresa');

            $criteria = new CDbCriteria();
            $criteria->condition = 'ID_EMPRESA=' . $model->ID_EMPRESA;
            $correlativo = Correlativo::model()->find($criteria);
            $model->NUMERO_OT = $correlativo->NUMERO_CORRELATIVO;
            $model->ELIMINADO=0;
            $correlativo->NUMERO_CORRELATIVO++;
            $model->FECHA_OT = date('y-m-d');
            $model->USUARIO_CREADOR = Yii::app()->user->id;
            if ($model->USUARIO_CREADOR == 61)
                $model->VOBO_JEFE_DPTO = 61;
            $model->APROBADO_I25 = 0;
            if (isset($_POST['OrdenTrabajo']['_cot']))
                $model->_cot = $_POST['OrdenTrabajo']['_cot'];
            if ($model->save() && $correlativo->save()) {
                $tempFolder = Yii::getPathOfAlias('webroot') . '/archivos/temp/';
                $newFolder = Yii::getPathOfAlias('webroot') . '/archivos/cot/';
                if (!empty($model->_cot)) {
                    $folder = $newFolder . "/" . $model->ID_OT;
                    if (!file_exists($folder))
                        mkdir($folder, 0777, true);
                    foreach ($model->_cot as $file) {
                        if (file_exists($tempFolder . $file)) {
                            $cotfile = new Cotizacion;
                            $cotfile->ID_OT = $model->ID_OT;
                            $cotfile->NOMBRE_ARCHIVO = utf8_decode($file);
                            $cotfile->save();
                            copy($tempFolder . $cotfile->NOMBRE_ARCHIVO, $folder . "/" . $cotfile->NOMBRE_ARCHIVO);
                        }
                    }
                }
                //               $persona = Personal::model()->findByPk(Yii::app()->user->id);
//                $this->writeLog = true;
//                $this->logMessage = $persona->NOMBRE_PERSONA . ' ' . $persona->APELLIDO_PERSONA . ' ha creado la OT nº ' . $model->NUMERO_OT;
//                $this->afterAction();
                Auditoria::model()->registrarAccion('OT', $model->ID_OT, "NUMERO_OT:" . $model->NUMERO_OT . " Tipo de OT: " . $model->ID_TIPO_OT . " contratista: " . $model->ID_CONTRATISTA . ", solicita: " . $model->SOLICITANTE . ", fecha: " . $model->FECHA_OT);
                //$this->sendMail($model, 'Nueva Orden de Trabajo', 'body_ot_message', 'jdp', 'Se ha creado una nueva orden de trabajo cuyo Nº es ' . $model->ID_OT);
                $this->redirect(array('update', 'id' => $model->ID_OT));
            }
        }
        $this->render('create', array('model' => $model,));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {

        $model = $this->loadModel($id);
        if (!Yii::app()->user->A1() && ($model->VOBO_ADMIN == 1 || $model->VOBO_GERENTE_OP == 1 || $model->VOBO_GERENTE_GRAL == 1))
            throw new CHttpException(300, 'no se puede modificar debido que la orden de trabajo esta en proceso de aprobacion');

        if (!Yii::app()->user->A1() && (Yii::app()->user->JDP() && $model->USUARIO_CREADOR != Yii::app()->user->id))
            throw new CHttpException(404, 'Usted no esta autorizado para realizar esta acción.');

        $new_sub_item = new InsumosOT;
        $sub_items = InsumosOT::model()->findAll(array('condition' => 'ID_OT=' . $id, 'order' => 'CAST(NUMERO_SUB_ITEM AS DECIMAL) ASC'));


        $newfile = array();
        $criteria = new CDbCriteria();
        $criteria->condition = "ID_OT=" . $id;
        $cotfiles = Cotizacion::model()->findAll($criteria);

        if (!empty($cotfiles)) {
            foreach ($cotfiles as $value) {
                $newfile[$value->NOMBRE_ARCHIVO] = $value->NOMBRE_ARCHIVO;
            }
            $model->_cot = $newfile;
        }
        if (isset($_POST['OrdenTrabajo']) && isset($_POST['submit_ot'])) {
            $model->attributes = $_POST['OrdenTrabajo'];
            if ($model->RECHAZAR_OT == 1) {
                $model->USUARIO_RECHAZA = Yii::app()->user->getState('identificador');
            }
            if ($model->USUARIO_VOBO_GG == 1) {
                $model->APROBADO_I25 = 1;
            }

            if (isset($_POST['OrdenTrabajo']['_cot'])) {
                $finalcot = array_diff($newfile, $_POST['OrdenTrabajo']['_cot']);
                $newfiles = array_diff($_POST['OrdenTrabajo']['_cot'], $newfile);
            }
            if (empty($_POST['OrdenTrabajo']['_cot']))
                $finalcot = array_diff($newfile, array());
            if ($model->save()) {
                $tempFolder = Yii::getPathOfAlias('webroot') . '/archivos/temp/';
                $newFolder = Yii::getPathOfAlias('webroot') . '/archivos/cot/';
                if (empty($finalcot) && !empty($newfiles)) {
                    $folder = $newFolder . "/" . $model->ID_OT;
                    if (!file_exists($folder))
                        mkdir($folder, 0777, true);
                    foreach ($newfiles as $file) {
                        if (file_exists($tempFolder . $file)) {
                            $cotfile = new Cotizacion;
                            $cotfile->ID_OT = $model->ID_OT;
                            $cotfile->NOMBRE_ARCHIVO = $file;
                            $cotfile->COMENTARIOS_COTIZACION = null;
                            $cotfile->DEF_COT = 0;
                            if ($cotfile->save()) {
                                copy($tempFolder . $cotfile->NOMBRE_ARCHIVO, $folder . "/" . $cotfile->NOMBRE_ARCHIVO);
                            }
                        }
                    }
                } if (!empty($finalcot)) {
                    foreach ($finalcot as $fc) {
                        $dltcriteria = new CDbCriteria();
                        $dltcriteria->condition = "NOMBRE_ARCHIVO='" . $fc . "'";
                        $deletefile = Cotizacion::model()->find($dltcriteria);
                    }
                    if ($deletefile->delete()) {
                        $tempFolder = Yii::getPathOfAlias('webroot') . '/archivos/cot/' . $id . '/';
                        $dir = opendir($tempFolder);
                        foreach ($finalcot as $fcot) {
                            while ($f = readdir($dir)) {
                                if ($fcot == $f)
                                    unlink($tempFolder . $f);
                            }
                        }
                        closedir($dir);
                    }
                }
//                $persona = Personal::model()->findByPk(Yii::app()->user->id);
//                $this->writeLog = true;
//                $this->logMessage = $persona->NOMBRE_PERSONA . ' ' . $persona->APELLIDO_PERSONA . ' ha Modificado la OT nº ' . $model->NUMERO_OT;
//                $this->afterAction();
                Auditoria::model()->registrarAccion('OT', $model->ID_OT, "Numero OT:" . $model->NUMERO_OT . " Tipo de OT: " . $model->ID_TIPO_OT . ", Contratista: " . $model->ID_CONTRATISTA . ", solicita: " . $model->SOLICITANTE . ", fecha: " . $model->FECHA_OT . ", descripcion: " . $model->DESCRIPCION_OT);
                $this->redirect(array('view', 'id' => $model->ID_OT));
            }
        }
        if (isset($_POST['InsumosOT']) && isset($_POST['sub_item_ot'])) {
            $new_sub_item->attributes = $_POST['InsumosOT'];
            $new_sub_item->ID_OT = $id;
            if ($new_sub_item->save()) {

                Auditoria::model()->registrarAccion('OT', $new_sub_item->ID_OT, "Se agrega item: " . $new_sub_item->ID_INSUMOS_OT . ", numero subItem: " . $new_sub_item->NUMERO_SUB_ITEM);
                $this->redirect(array('update', 'id' => $model->ID_OT));
            }
        }


        $this->render('update', array(
            'model' => $model,
            'new_sub_item' => $new_sub_item,
            'sub_items' => $sub_items,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        
        $model = $this->loadModel($id);
        Auditoria::model()->registrarAccion('OT', $model->ID_OT, "NUMERO_OT:" . $model->NUMERO_OT . " contratista: " . $model->ID_CONTRATISTA . ", solicita: " . $model->SOLICITANTE . ", fecha: " . $model->FECHA_OT);
        
        $model->ELIMINADO=1;
        $model->save();
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        //$model->delete();
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('OrdenTrabajo');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $dataProviderDetalle = new CActiveDataProvider('InsumosOT');
        $dataProviderDetalle->criteria = array('condition' => 'ID_OT=-1');
        if (Yii::app()->request->isAjaxRequest AND isset($_GET[0])) {
            // el update del CGridView hecho en Ajax produce un ajaxRequest sobre el mismo
            $idOt = $_GET[0];
            Yii::log("\nAJAX_REQUEST\nPROVOCADO_POR_EL_UPDATE_AL_CGRIDVIEW"
                    . "\nidInforme seleccionada es=" . $idOt
                    , "info");
            // actualizas el criteria del data provider para ajustarlo a lo que se pide:
            $dataProviderDetalle->criteria = array('condition' => 'ID_OT=' . $idOt);
            // para responderle al request ajax debes hacer un ECHO con el JSON del dataprovider
            echo CJSON::encode($dataProviderDetalle);
        }

        $model = new OrdenTrabajo('search');
        $model->unsetAttributes(); // clear any default values

        if (isset($_GET['OrdenTrabajo']))
            $model->attributes = $_GET['OrdenTrabajo'];

        $this->render('admin', array(
            'model' => $model,
            'dP_detalle' => $dataProviderDetalle,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return OrdenTrabajo the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = OrdenTrabajo::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    static function getFormat($type, $money) {


        switch ($type) {
            case 'PESOS CL':
                return number_format($money, 0, ',', '.');
                break;
            case 'USD':
                return number_format($money, 2, '.', ' ');
                break;
            default:
                return number_format($money, 2, ',', '.');
        }
    }

    public function actionViewOt() {
        $id = $_POST['id_ot'];
        $model = $this->loadModel($id);
        //$model = $this->loadModel(18);
        //echo CJSON::encode($model);

        $iva = $model->APLICA_IVA == 1 ? "Si" : "No";
        $supervisor = $model->supervisor->NOMBRE_PERSONA;
        $tipo_ot = $model->tipo_de_ot->NOMBRE_TIPO_OT;
        $sql = "select NOMBRE_PERSONA from personal p inner join usuarios u on p.ID_PERSONA=u.ID_PERSONA where u.ID_USUARIO=" . Yii::app()->user->getState('identificador');

        $aprJDP = "";
        if ($model->VOBO_JEFE_DPTO == 1) {
            $aprJDP = date("d-m-Y", strtotime($model->FECHA_VOBO_JDPTO)) . " " . $model->USUARIO_VOBO_JDPTO;
        }
        $aprADM = "";
        if ($model->VOBO_ADMIN == 1) {
            $aprADM = date("d-m-Y", strtotime($model->FECHA_VOBO_ADMIN)) . " " . $model->USUARIO_VOBO_ADMIN;
        }
        $aprGOP = "";
        if ($model->VOBO_GERENTE_OP == 1) {
            $aprGOP = date("d-m-Y", strtotime($model->FECHA_VOBO_GOP)) . " " . $model->USUARIO_VOBO_GOP;
        }
        $aprGG = "";
        if ($model->VOBO_GERENTE_GRAL == 1) {
            $aprGG = date("d-m-Y", strtotime($model->FECHA_VOBO_GG)) . " " . $model->USUARIO_VOBO_GG;
        }
        $p = Personal::model()->findBySql($sql);

        $t = '<div>' .
                '<b>Id Ot: </b>' . $model->ID_OT . '<br>' .
                '<b>Valor Moneda: </b>' . $model->VALOR_MONEDA . '<br>' .
                '<b>Tipo Ot: </b>' . $tipo_ot . '<br>' .
                '<b>Supervisor: </b>' . $supervisor . '<br>' .
                '<b>Fecha Ejecución: </b>' . date("d-m-Y", strtotime($model->FECHA_EJECUCION)) . '<br>' .
                '<b>Aplica Iva: </b>' . $iva . '<br>' .
                //	'<b>Aprob. J: Dpto: </b>'.$p->NOMBRE_PERSONA." ".$aprJDP.'<br>'.
                '<b>Aprob. Adm.: </b>' . $aprADM . '<br>' .
                '<b>Aprob. G. Op.: </b>' . $aprGOP . '<br>' .
                '<b>Aprob. G. Gral.: </b>' . $aprGG . '<br>' .
                '</div>';
        echo CJSON::encode($t);
    }

//	public function actionAprobarOt(){
//		$id = $_POST['idOt'];
//		$model = $this->loadModel($id);
//		if (Yii::app()->user->JDP()) {
//			$model->VOBO_JEFE_DPTO = 1;
//			$model->FECHA_VOBO_JDPTO = date('Y-m-d'); 
//			$model->USUARIO_VOBO_JDPTO = Yii::app()->user->getState('idUsuario');
//		}elseif (Yii::app()->user->ADM()) {
//			$model->VOBO_ADMIN = 1;
//			$model->FECHA_VOBO_ADMIN = date('Y-m-d'); 
//			$model->USUARIO_VOBO_ADMIN = Yii::app()->user->getState('idUsuario');
//		}elseif (Yii::app()->user->GOP()) {
//			$model->VOBO_GERENTE_OP = 1;
//			$model->FECHA_VOBO_GOP = date('Y-m-d'); 
//			$model->USUARIO_VOBO_GOP = Yii::app()->user->getState('idUsuario');
//		}elseif (Yii::app()->user->GG()) {
//			$model->VOBO_GERENTE_GRAL = 1;
//			$model->FECHA_VOBO_GG = date('Y-m-d'); 
//			$model->USUARIO_VOBO_GG = Yii::app()->user->getState('idUsuario');
//		}
//               // $criteria= new CDbCriteria();
//               // $criteria->condition=
//              $insumos= InsumosOT::model()->findAllByAttributes(array('ID_OT'=>$id));
//                if($model->VOBO_JEFE_DPTO==1&&$model->VOBO_ADMIN==1){
//                    $total =0;
//                    foreach($insumos as $ins){
//                        $total+=$ins->COSTO_CONTRATISTA;
//                    }
//                    if ($total<=2500){
//                       $model->APROBADO_I25=1;
//                    }
//                        
//                }
//                    
//		if (Yii::app()->user->GG() || Yii::app()->user->GOP() || Yii::app()->user->ADM() || Yii::app()->user->JDP() ) {
//			if($model->save())
//                            echo true;
//			else
//                            echo false;
//		}
//		
//	}
    /**
     * Performs the AJAX validation.
     * @param OrdenTrabajo $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'orden-trabajo-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionRechazarOtView($id) {
        $model = $this->loadModel($id);
        if (isset($_POST['OrdenTrabajo'])) {
            $model->attributes = $_POST['OrdenTrabajo'];
            $model->RECHAZAR_OT = 1;
            $model->ESTADO_OT = 2;
            $model->USUARIO_RECHAZA = Yii::app()->user->getState('identificador');
            $nombre = '';
            if (!empty($model->USUARIO_RECHAZA)) {
                $persona = Personal::model()->findByPK($model->USUARIO_RECHAZA);
                $nombre = ' y ha sido anulada por ' . $persona->NOMBRE_PERSONA . ' ' . $persona->APELLIDO_PERSONA;
            }
            if ($model->save()) {
                $this->sendMail($model, 'Orden de Trabajo Rechazada', 'body_ot_message', 'reject', 'Se ha rechazado la orden de trabajo cuyo Nº es ' . $model->ID_OT . $nombre);
                $this->redirect(array('view', 'id' => $model->ID_OT));
            }
        }
        $this->render('createRechazioOT', array('model' => $model));
    }

    public function actionReaprobarOtView($id) {
        $model = $this->loadModel($id);
        $nombre = '';
        if (!empty($model->USUARIO_RECHAZA)) {
            $persona = Personal::model()->findByPK($model->USUARIO_RECHAZA);
            $nombre = ' y que habia sido rechazada por ' . $persona->NOMBRE_PERSONA . ' ' . $persona->APELLIDO_PERSONA;
        }
        $model->ESTADO_OT = 0;
        $model->RECHAZAR_OT = 0;
        $model->USUARIO_RECHAZA = Yii::app()->user->getState('identificador');
        $model->MOTIVO_RECHAZO = '';
        if ($model->save()) {
            if (Yii::app()->user->JDP())
                $this->sendMail($model, 'Orden de Trabajo modificada', 'body_ot_message', 'adm', 'Se ha modificado y reaprobado la orden de trabajo cuyo Nº es ' . $model->NUMERO_OT . $nombre);
            elseif (Yii::app()->user->ADM())
                $this->sendMail($model, 'Orden de Trabajo modificada', 'body_ot_message', 'gop', 'Se ha modificado y reaprobado la orden de trabajo cuyo Nº es ' . $model->NUMERO_OT . $nombre);
            elseif (Yii::app()->user->GOP())
                $this->sendMail($model, 'Orden de Trabajo modificada', 'body_ot_message', 'gg', 'Se ha modificado y reaprobado la orden de trabajo cuyo Nº es ' . $model->NUMERO_OT . $nombre);
            elseif (Yii::app()->user->GG())
                $this->sendMail($model, 'Orden de Trabajo modificada', 'body_ot_message', 'success', 'Se ha modificado y reaprobado la orden de trabajo cuyo Nº es ' . $model->NUMERO_OT . $nombre);
            $this->redirect(array('view', 'id' => $model->ID_OT));
        }
    }

    public function actionAprobarOtView($id) {

        $model = OrdenTrabajo::model()->findByPk($id);

        if (!empty($model)) {
            if (Yii::app()->user->JDP() && $model->VOBO_JEFE_DPTO != 1 && Yii::app()->getSession()->get('id_empresa') == $model->ID_EMPRESA) {

                $model->USUARIO_VOBO_JDPTO = Usuarios::model()->GetID(Yii::app()->user->id);
                $model->FECHA_VOBO_JDPTO = date("y-m-d H:i:s");
                $model->VOBO_JEFE_DPTO = 1;
                if ($model->ID_EMPRESA == 1)
                    $this->sendMail($model, 'Orden de Trabajo Aprobada', 'body_ot_message', 'adm', 'Se ha aprobado una orden de trabajo cuyo Nº es ' . $model->NUMERO_OT);
                else
                    $this->sendMail($model, 'Orden de Trabajo Aprobada', 'body_ot_message', 'gop', 'Se ha aprobado una orden de trabajo cuyo Nº es ' . $model->NUMERO_OT);
            } elseif (Yii::app()->user->ADM() && $model->RECHAZAR_OT == 0 && $model->VOBO_ADMIN != 1) {

                if ($model->VOBO_JEFE_DPTO != 1) {
                    $model->VOBO_JEFE_DPTO = 1;
                    $model->FECHA_VOBO_JDPTO = date("y-m-d H:i:s");
                    $model->USUARIO_VOBO_JDPTO = Yii::app()->user->getState('idUsuario');
                }
                if ($model->VOBO_GERENTE_OP != 1 && $model->ID_EMPRESA != 1) {
                    $model->VOBO_GERENTE_OP = 1;
                    $model->FECHA_VOBO_GOP = date("y-m-d H:i:s");
                    $model->USUARIO_VOBO_GOP = Yii::app()->user->getState('idUsuario');
                }
                $model->VOBO_ADMIN = 1;
                $model->FECHA_VOBO_ADMIN = date("y-m-d H:i:s");
                $model->USUARIO_VOBO_ADMIN = Yii::app()->user->getState('idUsuario');
                if ($model->ID_EMPRESA == 1)
                    $this->sendMail($model, 'Orden de Trabajo Aprobada', 'body_ot_message', 'gop', 'Se ha aprobado una orden de trabajo cuyo Nº es ' . $model->NUMERO_OT);
                else
                    $this->sendMail($model, 'Orden de Trabajo Aprobada', 'body_ot_message', 'gg', 'Se ha aprobado una orden de trabajo cuyo Nº es ' . $model->NUMERO_OT);
            } elseif (Yii::app()->getSession()->get('id_empresa') == $model->ID_EMPRESA && Yii::app()->user->GOP() && $model->VOBO_GERENTE_OP != 1 && (($model->ID_EMPRESA == 1 && $model->VOBO_ADMIN == 1) || $model->ID_EMPRESA != 1)) {
                if ($model->ID_EMPRESA != 1 && $model->VOBO_JEFE_DPTO != 1) {
                    $model->VOBO_JEFE_DPTO = 1;
                    $model->FECHA_VOBO_JDPTO = date("y-m-d H:i:s");
                    $model->USUARIO_VOBO_JDPTO = Yii::app()->user->getState('idUsuario');
                }
                $model->VOBO_GERENTE_OP = 1;
                $model->FECHA_VOBO_GOP = date("y-m-d H:i:s");
                $model->USUARIO_VOBO_GOP = Yii::app()->user->getState('idUsuario');
                if ($model->ID_EMPRESA == 1)
                    $this->sendMail($model, 'Orden de Trabajo Aprobada', 'body_ot_message', 'gg', 'Se ha aprobado una orden de trabajo cuyo Nº es ' . $model->NUMERO_OT);
                else
                    $this->sendMail($model, 'Orden de Trabajo Aprobada', 'body_ot_message', 'adm', 'Se ha aprobado una orden de trabajo cuyo Nº es ' . $model->NUMERO_OT);
            } elseif (Yii::app()->user->GG() && $model->VOBO_ADMIN == 1 && $model->VOBO_GERENTE_GRAL != 1) {
                $model->VOBO_GERENTE_GRAL = 1;
                $model->FECHA_VOBO_GG = date("y-m-d H:i:s");
                $model->USUARIO_VOBO_GG = Yii::app()->user->getState('idUsuario');
                $model->APROBADO_I25 = 1;
                $model->ESTADO_OT = 1;
                $this->sendMail($model, 'Orden de Trabajo Aprobada totalmente', 'body_ot_message', 'success', 'Se ha aprobado completamente la orden de trabajo cuyo Nº es ' . $model->NUMERO_OT);
            } elseif (Yii::app()->user->LOG() && $model->RECHAZAR_OT == 0 && $model->VOBO_JEFE_DPTO != 1) {

                $this->sendMail($model, 'Orden de Trabajo requiere aprobacion', 'body_ot_message', 'log', 'La orden de trabajo cuyo Nº es ' . $model->NUMERO_OT . ' requiere de su aprobacion');
            }
            $model->save();
        }
        $this->redirect(array('admin'));
    }

    public function actionAprobarOT() {
        $ids = '';
        if (!empty($_POST['theIds1']))
            $ids.=',' . $_POST['theIds1'];
        if (!empty($_POST['theIds2']))
            $ids.=',' . $_POST['theIds2'];;
        if (!empty($_POST['theIds3']))
            $ids.=',' . $_POST['theIds3'];
        $orden = explode(',', $ids);
        if (!empty($orden)) {
            foreach ($orden as $ot) {
                $model = OrdenTrabajo::model()->findByPk($ot);
                if ($model) {
                    if (Yii::app()->user->JDP() && $model->VOBO_JEFE_DPTO != 1 && Yii::app()->getSession()->get('id_empresa') == $model->ID_EMPRESA) {
                        $model->VOBO_JEFE_DPTO = 1;
                        $model->FECHA_VOBO_JDPTO = date("y-m-d H:i:s");
                        $model->USUARIO_VOBO_JDPTO = Yii::app()->user->getState('idUsuario');
                        if ($model->ID_EMPRESA == 1)
                            $this->sendMail($model, 'Orden de Trabajo Aprobada', 'body_ot_message', 'adm', 'Se ha aprobado una orden de trabajo cuyo Nº es ' . $model->NUMERO_OT);
                        else
                            $this->sendMail($model, 'Orden de Trabajo Aprobada', 'body_ot_message', 'gop', 'Se ha aprobado una orden de trabajo cuyo Nº es ' . $model->NUMERO_OT);
                    } elseif (Yii::app()->user->ADM() && $model->RECHAZAR_OT == 0 && $model->VOBO_ADMIN != 1) {

                        if ($model->VOBO_JEFE_DPTO != 1) {
                            $model->VOBO_JEFE_DPTO = 1;
                            $model->FECHA_VOBO_JDPTO = date("y-m-d H:i:s");
                            $model->USUARIO_VOBO_JDPTO = Yii::app()->user->getState('idUsuario');
                        }
                        if ($model->VOBO_GERENTE_OP != 1 && $model->ID_EMPRESA != 1) {
                            $model->VOBO_GERENTE_OP = 1;
                            $model->FECHA_VOBO_GOP = date("y-m-d H:i:s");
                            $model->USUARIO_VOBO_GOP = Yii::app()->user->getState('idUsuario');
                        }
                        $model->VOBO_ADMIN = 1;
                        $model->FECHA_VOBO_ADMIN = date("y-m-d H:i:s");
                        $model->USUARIO_VOBO_ADMIN = Yii::app()->user->getState('idUsuario');
                        if ($model->ID_EMPRESA == 1)
                            $this->sendMail($model, 'Orden de Trabajo Aprobada', 'body_ot_message', 'gop', 'Se ha aprobado una orden de trabajo cuyo Nº es ' . $model->NUMERO_OT);
                        else
                            $this->sendMail($model, 'Orden de Trabajo Aprobada', 'body_ot_message', 'gg', 'Se ha aprobado una orden de trabajo cuyo Nº es ' . $model->NUMERO_OT);
                    } elseif (Yii::app()->getSession()->get('id_empresa') == $model->ID_EMPRESA && Yii::app()->user->GOP() && $model->VOBO_GERENTE_OP != 1 && (($model->ID_EMPRESA == 1 && $model->VOBO_ADMIN == 1) || $model->ID_EMPRESA != 1)) {
                        if ($model->ID_EMPRESA != 1 && $model->VOBO_JEFE_DPTO != 1) {
                            $model->VOBO_JEFE_DPTO = 1;
                            $model->FECHA_VOBO_JDPTO = date("y-m-d H:i:s");
                            $model->USUARIO_VOBO_JDPTO = Yii::app()->user->getState('idUsuario');
                        }
                        $model->VOBO_GERENTE_OP = 1;
                        $model->FECHA_VOBO_GOP = date("y-m-d H:i:s");
                        $model->USUARIO_VOBO_GOP = Yii::app()->user->getState('idUsuario');
                        if ($model->ID_EMPRESA == 1)
                            $this->sendMail($model, 'Orden de Trabajo Aprobada', 'body_ot_message', 'gg', 'Se ha aprobado una orden de trabajo cuyo Nº es ' . $model->NUMERO_OT);
                        else
                            $this->sendMail($model, 'Orden de Trabajo Aprobada', 'body_ot_message', 'adm', 'Se ha aprobado una orden de trabajo cuyo Nº es ' . $model->NUMERO_OT);
                        //$this->sendMail($model, 'Orden de Trabajo Aprobada', 'body_ot_message', 'gg', 'Se ha aprobado una orden de trabajo cuyo Nº es ' . $model->NUMERO_OT);
                    } elseif (Yii::app()->user->GG() && $model->VOBO_ADMIN == 1 && $model->VOBO_GERENTE_GRAL != 1) {
                        $model->VOBO_GERENTE_GRAL = 1;
                        $model->FECHA_VOBO_GG = date("y-m-d H:i:s");
                        $model->USUARIO_VOBO_GG = Yii::app()->user->getState('idUsuario');
                        $model->APROBADO_I25 = 1;
                        $model->ESTADO_OT = 1;
                        $this->sendMail($model, 'Orden de Trabajo Aprobada totalmente', 'body_ot_message', 'success', 'Se ha aprobado completamente la orden de trabajo cuyo Nº es ' . $model->NUMERO_OT);
                    } elseif (Yii::app()->user->LOG() && $model->RECHAZAR_OT == 0 && $model->VOBO_JEFE_DPTO != 1) {
                        $this->sendMail($model, 'Orden de Trabajo requiere aprobacion', 'body_ot_message', 'log', 'La orden de trabajo cuyo Nº es ' . $model->NUMERO_OT . ' requiere de su aprobacion');
                    }
                    $model->save();
                }
            }
        }
        $this->redirect(array('admin'));
    }

    public function actionCambiarPendiente() {

        $orden = explode(',', $_POST['theIds']);
        if (!empty($_POST['theIds'])) {
            foreach ($orden as $ot) {
                $model = OrdenTrabajo::model()->findByPk($ot);
                if (Yii::app()->user->JDP() && $model->VOBO_ADMIN != 1) {
                    $model->VOBO_JEFE_DPTO = NULL;
                    $model->FECHA_VOBO_JDPTO = NULL;
                    $model->USUARIO_VOBO_JDPTO = NULL;
                } elseif (Yii::app()->user->ADM() && ($model->VOBO_GERENTE_OP != 1)) {
                    $model->VOBO_ADMIN = NULL;
                    $model->FECHA_VOBO_ADMIN = NULL;
                    $model->USUARIO_VOBO_ADMIN = NULL;
                } elseif (Yii::app()->user->GOP() && $model->VOBO_GERENTE_GRAL != 1) {
                    $model->VOBO_GERENTE_OP = NULL;
                    $model->FECHA_VOBO_GOP = NULL;
                    $model->USUARIO_VOBO_GOP = NULL;
                } elseif (Yii::app()->user->GG() && $model->VOBO_GERENTE_GRAL != 1) {
                    $model->VOBO_GERENTE_GRAL = NULL;
                    $model->FECHA_VOBO_GG = NULL;
                    $model->USUARIO_VOBO_GG = NULL;
                    $model->APROBADO_I25 = 0;
                    $model->ESTADO_OT = 0;
                }
//      Yii::app()->user->setFlash('error',Yii::t('validation','Can not delete this item because it have elements asociated it'));
//                    $manifest->delete();
//                    $this->redirect(array('admin'));   
                $model->save();
            }
        }
        $this->redirect(array('admin'));
    }

    public function getFirma($id) {
        $usuario = Usuarios::model()->findByPk($id);
        $url = "<br><br><br><br>";
        if ($usuario) {
            $persona = Personal::model()->findByPk($usuario->ID_PERSONA);
            if (!empty($persona->URL_FIRMA))
                $img = Yii::app()->baseUrl . '/archivos/firmas/' . $persona->URL_FIRMA;
            else
                $img = Yii::app()->theme->baseUrl . '/img/icons/blackApprove.png';

            $url = '<div class="firma"><br><img src="' . $img . '" /><br><p>' . $persona->NOMBRE_PERSONA . ' ' . $persona->APELLIDO_PERSONA . '</p><br></div>';
        }
        return $url;
    }

    public function getFirmas($model) {

        $table = '<table width="100%">
        <tr>
            <td width="40%" class="bordered h7 text-center" valign="top" rowspan="4">
            V°B° Jefe Depto. <br> ' . $this->getFirma($model->USUARIO_VOBO_JDPTO) . '</td>
            <td class="bordered h7" colspan="3" width="60%">Autorizado por:</td>
        </tr>';
        if ($model->ID_EMPRESA == 1) {
            $table.='<tr>
            <td width="20%" class="bordered">' . $this->getFirma($model->USUARIO_VOBO_ADMIN) . '</td>
            <td width="20%" class="bordered">' . $this->getFirma($model->USUARIO_VOBO_GOP) . '</td>
            <td width="20%" class="bordered">' . $this->getFirma($model->USUARIO_VOBO_GG) . '</td>
        </tr>
        <tr>
            <td width="20%" class="bordered h7 text-center"> ' . OrdenTrabajo::model()->getAttributeLabel('VOBO_ADMIN') . '</td>
            <td width="20%" class="bordered h7 text-center">' . OrdenTrabajo::model()->attributeLabels($model->ID_EMPRESA)['VOBO_GERENTE_OP'] . '</td>
            <td width="20%" class="bordered h7 text-center">' . OrdenTrabajo::model()->getAttributeLabel('VOBO_GERENTE_GRAL') . '</td>
        </tr>';
        } else {
            $table.='
             <tr>
            <td width="20%" class="bordered">' . $this->getFirma($model->USUARIO_VOBO_GOP) . '</td>
            <td width="20%" class="bordered">' . $this->getFirma($model->USUARIO_VOBO_ADMIN) . '</td>
            <td width="20%" class="bordered">' . $this->getFirma($model->USUARIO_VOBO_GG) . '</td>
        </tr> 
            <tr>
            <td width="20%" class="bordered h7 text-center">' . OrdenTrabajo::model()->attributeLabels($model->ID_EMPRESA)['VOBO_GERENTE_OP'] . '</td>
            <td width="20%" class="bordered h7 text-center">' . OrdenTrabajo::model()->getAttributeLabel('VOBO_ADMIN') . '</td>
            <td width="20%" class="bordered h7 text-center">' . OrdenTrabajo::model()->getAttributeLabel('VOBO_GERENTE_GRAL') . '</td>
        </tr>';
        }
        $table.= '<tr>
            <td width="20%" class="bordered h7 text-center"> Monto hasta USD 2.500</td><td width="40%" class="bordered h7 text-center" colspan="2">Monto sobre USD 2.500</td>
            </tr>
        </table>';

        echo $table;
    }

    public function getSupervisor() {
        $criteria = new CDbCriteria();
        $criteria->condition = "ES_SUPERVISOR=1 AND ID_EMPRESA =" . Yii::app()->getSession()->get('id_empresa').' AND DEBAJA<>1';
        $criteria->order = 'NOMBRE_PERSONA ASC, APELLIDO_PERSONA  ASC';
        $personal = Personal::model()->findAll($criteria);

        $supervisor = array();
        foreach ($personal as $persona) {
            $usuario = Usuarios::model()->findByPK($persona->ID_PERSONA);
            if (@$usuario->COD_TIPO_USUARIO != 'A1')
                $supervisor[$persona->ID_PERSONA] = $persona->NOMBRE_PERSONA . ' ' . $persona->APELLIDO_PERSONA;
        }
        return $supervisor;
    }

    public function getCC() {
        $cc = CentroDeCostos::model()->findAll();
        $ccfinal = array('' => 'Seleccione');


        return $ccfinal;
    }

    public function getDepto() {
        $criteria = new CDbCriteria();
        $criteria->condition = "ID_EMPRESA=" . Yii::app()->getSession()->get('id_empresa');
        $dpto = CHtml::listData(Departamentos::model()->findAll($criteria), 'ID_DEPARTAMENTO', 'NOMBRE_DEPARTAMENTO');
        return $dpto;
    }

    public function actionUpload() {
        $tempFolder = Yii::getPathOfAlias('webroot') . '/archivos/temp/';
        Yii::import("ext.EFineUploader.qqFileUploader");
        $uploader = new qqFileUploader();
        $uploader->allowedExtensions = array('pdf', 'jpg', 'jpeg', 'png');
        $uploader->sizeLimit = 7 * 1024 * 1024; //maximum file size in bytes
        $uploader->chunksFolder = $tempFolder;
        $result = $uploader->handleUpload($tempFolder);

        $result['filename'] = $uploader->getUploadName();
        $result['folder'] = $tempFolder;
        $uploadedFile = $tempFolder . $result['filename'];
        header("Content-Type: text/plain");
        $result = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        echo $result;
        Yii::app()->end();
    }

    public function actionDeleteOldFile($tempFolder = null, $token) {
        $cont = 0;
        if ($token == "PDS4WaMD") {
            if ($tempFolder == null)
                $tempFolder = Yii::getPathOfAlias('webroot') . '/images/temp/';

            $dir = opendir($tempFolder);
            while ($f = readdir($dir)) {
                if ((time() - filemtime($tempFolder . $f) >= 3600 * 4 * 2) and ! (is_dir($tempFolder . $f)))
                    unlink($tempFolder . $f);
            }
            closedir($dir);
        }
    }

    private function sendMail($model, $subject, $view, $type = null, $content = null) {

        $mail = Yii::app()->Smtpmail;
        $mail->SMTPDebug = 2;
        $mail->CharSet = 'UTF-8';
        $mail->SetFrom('desarrollo@pcgeek.cl', 'Sistema Aprobacion de Documentos');
        $mail->Subject = $subject;
        $mail->MsgHTML(Yii::app()->controller->renderPartial($view, array('model' => $model, 'subject' => $subject, 'content' => $content), true));

        if ($type == 'adm' || $type == 'gop' || $type == 'gg' || $type == 'log') {
            $criteria = new CDbCriteria();
            switch ($type) {
                case 'adm':
                    $criteria->condition = "COD_TIPO_USUARIO='ADM' AND (TODAS_LAS_EMPRESAS=1 OR ID_EMPRESA=" . $model->ID_EMPRESA . ")";
                    break;
                case 'gop':
                    $criteria->condition = "COD_TIPO_USUARIO='GOP' AND (TODAS_LAS_EMPRESAS=1 OR ID_EMPRESA=" . $model->ID_EMPRESA . ")";
                    break;
                case 'gg':
                    $criteria->condition = "COD_TIPO_USUARIO='GG' AND (TODAS_LAS_EMPRESAS=1 OR ID_EMPRESA=" . $model->ID_EMPRESA . ")";
                    break;
                case 'log':
                    $criteria->with = array('iDPERSONA.iDDEPARTAMENTO');
                    $criteria->together = true;
                    $criteria->condition = "COD_TIPO_USUARIO='JDP' and iDDEPARTAMENTO.NOMBRE_DEPARTAMENTO='Logística' ";
                    break;
            }
            $users = Usuarios::model()->findAll($criteria);
            foreach ($users as $u) {
                $personal = Personal::model()->findByPk($u->ID_PERSONA);
                if (!empty($personal->EMAIL))
                    $mail->AddAddress($personal->EMAIL, $subject);
            }
        }elseif ($type == 'success' || $type == 'reject' || $type == 'jdp') {
            $personal = Personal::model()->findByPk($model->USUARIO_CREADOR);
            if ($type == 'success') {
                $otacriteria = new CDbCriteria();
                $otacriteria->condition = "COD_TIPO_USUARIO='OTA' AND ID_EMPRESA=" . $model->ID_EMPRESA;
                $otauser = Usuarios::model()->findAll($otacriteria);
                foreach ($otauser as $ota) {
                    $otapersonal = Personal::model()->findByPk($ota->ID_PERSONA);
                    if (!empty($otapersonal->EMAIL))
                        $mail->AddAddress($otapersonal->EMAIL, $subject);
                }
            }

            $mail->AddAddress($personal->EMAIL, $subject);
        }
        if (!$mail->Send())
            Yii::app()->user->setFlash('error', Yii::t('validation', 'Error al enviar correo Electronico'));
        else
            Yii::app()->user->setFlash('success', Yii::t('validation', 'Notificación enviada por Correo Electronico'));
    }

    public function getOTMessages($id) {
        $criteria = new CDbCriteria();
        $criteria->condition = "ID_OT=" . $id . " AND TIPO_MENSAJE='mensaje'";
        $message = Consulta::model()->findAll($criteria);
        foreach ($message as $m) {
            $user = Personal::model()->findByPK($m->ID_PERSONA);
            $link = "";
            $asigned = "<b><p class='namem'>" . $user->NOMBRE_PERSONA . " " . $user->APELLIDO_PERSONA . ":</b></p>";
            $approve = "";
            $class = "OTMessage";


            $approve = CHtml::link("Responder", Yii::app()->createUrl("consulta/create", array("id" => $id, "message" => $m->ID_CONSULTA)));
            echo '<div class="' . $class . '"><div class="fecham">
                                <div class="mes">' . Yii::app()->dateFormatter->format("MMM", strtotime($m->FECHA_CONSULTA)) . '</div>                        
                                <div class="dia">' . Yii::app()->dateFormatter->format("d", strtotime($m->FECHA_CONSULTA)) . '</div>
                                <div class="año">' . Yii::app()->dateFormatter->format("y", strtotime($m->FECHA_CONSULTA)) . '</div>' .
            '<div class="hora">' . Yii::app()->dateFormatter->format("hh:mm", strtotime($m->FECHA_CONSULTA)) . '</div></div>' .
            $asigned . '<p class="consulta"><br>' . $m->CONSULTA . '</p>' . $link . '<div class="btn btn-warning">' . $approve . '</div></div>';

            echo "<br>";

            $subcriteria = new CDbCriteria();
            $subcriteria->condition = "ID_CONSULTADO=" . $m->ID_CONSULTA;
            $respuesta = Consulta::model()->findAll($subcriteria);
            foreach ($respuesta as $r) {
                $user = Personal::model()->findByPK($r->ID_PERSONA);
                $link = "";
                $asigned = "<b><p class='namem'>" . $user->NOMBRE_PERSONA . " " . $user->APELLIDO_PERSONA . ":</b></p>";
                $class = "OTresponse";
                $approve = "";
                // $approve=CHtml::link("Responder",Yii::app()->createUrl("consulta/create",array("id"=>$id,"message"=>$r->ID_CONSULTA)));
                echo '<div class="' . $class . '"><div class="fecham">
                                <div class="mes">' . Yii::app()->dateFormatter->format("MMM", strtotime($r->FECHA_CONSULTA)) . '</div>                        
                                <div class="dia">' . Yii::app()->dateFormatter->format("d", strtotime($r->FECHA_CONSULTA)) . '</div>
                                <div class="año">' . Yii::app()->dateFormatter->format("y", strtotime($r->FECHA_CONSULTA)) . '</div>' .
                '<div class="hora">' . Yii::app()->dateFormatter->format("hh:mm", strtotime($r->FECHA_CONSULTA)) . '</div></div>' .
                $asigned . '<p class="consulta"><br>' . $r->CONSULTA . '</p>' . '</div><br>';


                // $repprove=CHtml::link("Reprobar medida Correctiva",Yii::app()->createUrl("ticket/repprove",array("id"=>$m->id_ticket_message)), array('confirm' => 'Esta Seguro que desea reprobar la medida correctiva propuesta?'));
            }
        }
    }

    public function getDatePicker($model) {
        $date = $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'FECHA_OT',
            'language' => 'es',
            'model' => $model,
            'attribute' => 'FECHA_OT',
            'flat' => false,
            'options' => array(
                'showAnim' => 'fold',
                'constrainInput' => true,
                'currentText' => 'Now',
                'altField' => 'FECHA_OT',
                'altFormat' => 'dd-mm-yy',
                'dateFormat' => 'yy-mm-dd',
                'htmlOptions' => array(
                    'style' => 'height:20px;'
                ),
            ),
                ), true);
        return $date;
    }

    public function getAsignado() {
        $criteria = new CDbCriteria();
        $criteria->with = array('iDUSUARIO');
        $criteria->together = true;
        $criteria->condition = 't.ID_EMPRESA=' . Yii::app()->getSession()->get('id_empresa') . ' AND iDUSUARIO.COD_TIPO_USUARIO="JDP"';

        $asignado = CHtml::listData(Personal::model()->findAll($criteria), 'ID_PERSONA', 'concatened');
        return $asignado;
    }

    public function actionviewAllInsumos($id) {

        $criteria = new CDbCriteria();
        $criteria->condition = "ID_OT=" . $id;
        $insumos = InsumosOT::model()->findAll($criteria);
        return $insumos;
    }

    public function actionViewallticket() {
        // write a code here.....
    }

}
