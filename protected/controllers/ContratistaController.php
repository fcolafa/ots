<?php

class ContratistaController extends Controller {

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
                'actions' => array('index', 'view'),
            //grupo 
            //'expression'=>'$user->U2()',
            ),
            //RU
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'create', 'view', 'update', 'admin'),
                'expression' => '$user->A1() || $user->JDP() || $user->LOG()|| $user->ADM()||$user->OP()',
            ),
            //CRUD todos los permisos otorgados a las cuentas indicadas
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'index', 'view'),
                'expression' => '$user->A1() || $user->JDP() || $user->LOG()||$user->OP()',
            ),
            //CRUD todos los permisos otorgados por default a las cuentas tipo super administrador
            /* array('allow', // allow authenticated user to perform 'create' and 'update' actions
              'actions'=>array('create','update','admin','delete','index','view'),
              'expression'=>'$user->SA()',
              ), */
            array('allow', // deny all users
                'actions' => array('getContratistas'),
                'users' => array('@'),
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
        $model = new Contratista;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Contratista'])) {
            $model->attributes = $_POST['Contratista'];
            $model->NOMBRE_CONTRATISTA = mb_convert_case($model->NOMBRE_CONTRATISTA, MB_CASE_TITLE, "UTF-8");
            $model->CIUDAD_CONTRATISTA = mb_convert_case($model->CIUDAD_CONTRATISTA, MB_CASE_TITLE, "UTF-8");
            if (empty($model->ID_EMPRESA) || $model->ID_EMPRESA == '')
                $model->ID_EMPRESA = Yii::app()->getSession()->get('id_empresa');
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->ID_CONTRATISTA));
        }

        $this->render('create', array(
            'model' => $model,
        ));
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

        if (isset($_POST['Contratista'])) {
            $model->attributes = $_POST['Contratista'];
            $model->NOMBRE_CONTRATISTA = mb_convert_case($model->NOMBRE_CONTRATISTA, MB_CASE_TITLE, "UTF-8");
            $model->CIUDAD_CONTRATISTA = mb_convert_case($model->CIUDAD_CONTRATISTA, MB_CASE_TITLE, "UTF-8");
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->ID_CONTRATISTA));
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
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Contratista');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Contratista('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Contratista']))
            $model->attributes = $_GET['Contratista'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Contratista the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Contratista::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Contratista $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'contratista-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGetContratistas() {
        //$id_emp = $_POST['OrdenTrabajo']['ID_EMPRESA'];
        $id_emp = $_POST['id_emp'];
        if (isset($_POST['all']))
            $all = $_POST['all'];
        $criteria = new CDbCriteria();
        $criteria->condition = "ID_EMPRESA=" . $id_emp;
        $criteria->order = 'NOMBRE_CONTRATISTA ASC';
        $criteria->addCondition('ID_CONTRATISTA<>105');
        $contratistas = Contratista::model()->findAll($criteria);
        $contratistas = CHtml::listData($contratistas, 'ID_CONTRATISTA', 'concatened');
        $t = '';
        if (isset($_POST['all'])&& $all == 1)
            $t.='<option value="0">Seleccionar todos</option>';
        foreach ($contratistas as $valor => $descripcion) {
            $t.='<option value="' . $valor . '">' . $descripcion . '</option>';
            //echo CHtml::tag('option', array('value'=>$valor), CHtml::encode($descripcion), true);
        }
        //print_r($contratistas);
        echo CJSON::encode($t);
    }

}
