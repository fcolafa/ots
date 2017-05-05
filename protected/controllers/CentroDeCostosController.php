<?php

class CentroDeCostosController extends Controller {

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
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'admin', 'view'),
                'expression' => '$user->A1()||$user->ADM()',
            ),
            array('allow',
                'actions' => array('GetCentroDeCostos'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('*'),
                'expression' => '$user->A1()',
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new CentroDeCostos;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['CentroDeCostos'])) {
            $model->attributes = $_POST['CentroDeCostos'];
            $model->ID_EMPRESA = 2;
            $model->ID_CLIENTE = 0;
            if ($model->save()) {
                $cc = new Ccc;
                $cc->NOMBRE_CUENTA = $model->NUMERO_CENTRO;
                $cc->NUMERO_CUENTA = $model->NUMERO_CENTRO;
                $cc->ID_CENTRO_COSTO = $model->ID_CENTRO_COSTO;
                if ($cc->save(false)) {
                    $secciones = [
                        10 => 'Generales',
                        20 => 'Estructuras',
                        30 => 'Piping',
                        40 => 'Electricidad y Electrónica',
                        50 => 'Carpintería',
                        60 => 'Mecánica y Propulsión',
                        70 => 'Miscelaneos',
                        80 => 'Pinturas',
                        90 => 'Maniobras',
                    ];
                    foreach ($secciones as $key => $value) {
                        $scc = new Scc;
                        $scc->SCC_NUMERO = $key;
                        $scc->SCC_DESCRIPCION = $value;
                        $scc->ID_CCC = $cc->ID_CCC;
                        $scc->save(false);
                    }

//                        $secciones = [
//                        10 => 'Generales',
//                        20 => 'Estructuras',
//                        30 => 'Piping',
//                        40 => 'Electricidad y Electrónica',
//                        50 => 'Carpintería',
//                        60 => 'Mecánica y Propulsión',
//                        70 => 'Miscelaneos',
//                        80 => 'Pinturas',
//                        90 => 'Maniobras',
//                        ];
//                        foreach($secciones as $key=>$value){
//                            $sec=new Sec;
//                            $sec->SEC_NUMERO=$key;
//                            $sec->SEC_DESCRIPCION=$value;
//                            $sec->ID_SCC=$scc->ID_SCC;
//                            $sec->save(false);
//                        }
                }
                Auditoria::model()->registrarAccion('', $model->ID_CENTRO_COSTO, $model->NOMBRE_CENTRO_COSTO);
                $this->redirect(array('view', 'id' => $model->ID_CENTRO_COSTO));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionAddScc() {
        $criteria = new CDbCriteria();
        $criteria->condition = "NUMERO_CENTRO <> '45' AND NUMERO_CENTRO <> '48' AND ID_EMPRESA=2";
        $centrosc = CentroDeCostos::model()->findAll($criteria);
        foreach ($centrosc as $cc) {
            $cri2 = new CDbCriteria();
            $cri2->condition = "ID_CENTRO_COSTO=" . $cc->ID_CENTRO_COSTO;
            $cc = Ccc::model()->findAll($cri2);
            foreach ($cc as $cuentas) {
                $secciones = [
                    10 => 'Generales',
                    20 => 'Estructuras',
                    30 => 'Piping',
                    40 => 'Electricidad y Electrónica',
                    50 => 'Carpintería',
                    60 => 'Mecánica y Propulsión',
                    70 => 'Miscelaneos',
                    80 => 'Pinturas',
                    90 => 'Maniobras',
                ];
                $cri3 = new CDbCriteria();
                $cri3->condition = 'ID_CCC=' . $cuentas->ID_CCC;
                //Scc::model()->deleteAll($cri3);                
                foreach ($secciones as $key => $value) {
                    $scc = new Scc;
                    $scc->SCC_NUMERO = $key;
                    $scc->SCC_DESCRIPCION = $value;
                    $scc->ID_CCC = $cuentas->ID_CCC;
                    $scc->save(false);
                }
            }
        }
        echo "Centros de costos modificados";
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['CentroDeCostos'])) {
            $model->attributes = $_POST['CentroDeCostos'];
            if ($model->save()) {
                Auditoria::model()->registrarAccion('', $model->ID_CENTRO_COSTO, $model->NOMBRE_CENTRO_COSTO);
                $this->redirect(array('view', 'id' => $model->ID_CENTRO_COSTO));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $ccc = Ccc::model()->findByAttributes(array('ID_CENTRO_COSTO' => $id));
        $msg = "No se pudo eliminar ya que tiene ";

        if (count($ccc) > 0) {
            $msg.= "Cuenta centro costo asociado";
        }

        try {
            $this->loadModel($id)->delete();
            Auditoria::model()->registrarAccion('', $model->ID_CENTRO_COSTO, $model->NOMBRE_CENTRO_COSTO);
            if (!isset($_GET['ajax']))
                Yii::app()->user->setFlash('success', 'Centro de Costo eliminado correctamente');
            else
                echo "<div class='alert alert-success'>Centro de Costo eliminado correctamente</div>";
        } catch (CDbException $e) {
            if (!isset($_GET['ajax']))
                Yii::app()->user->setFlash('error', $msg);
            else
                echo "<div class='alert alert-danger'>" . $msg . "</div>";
        }


        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('CentroDeCostos');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new CentroDeCostos('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['CentroDeCostos']))
            $model->attributes = $_GET['CentroDeCostos'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return CentroDeCostos the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = CentroDeCostos::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CentroDeCostos $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'centro-de-costos-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGetCentroDeCostos() {
        //$id_emp = $_POST['OrdenTrabajo']['ID_EMPRESA'];
        $id_emp = $_POST['id_emp'];
        $criteria = new CDbCriteria();
        $criteria->condition = "ID_EMPRESA=" . $id_emp;
        $criteria->order = 'NUMERO_CENTRO ASC';
        $cc = CentroDeCostos::model()->findAll($criteria);
        $cc = CHtml::listData($cc, 'ID_CENTRO_COSTO', 'concatened');
        $t = '';
        $t.='<option value="0">Seleccionar todos</option>';
        foreach ($cc as $valor => $descripcion) {
            $t.='<option value="' . $valor . '">' . $descripcion . '</option>';
            //echo CHtml::tag('option', array('value'=>$valor), CHtml::encode($descripcion), true);
        }
        //print_r($contratistas);
        echo CJSON::encode($t);
    }

}
