<?php

class CargosController extends Controller {

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
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'index', 'view', 'getCargos'),
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
        $model = new Cargos;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Cargos'])) {
            $model->attributes = $_POST['Cargos'];
            if (empty($model->ID_EMPRESA) || $model->ID_EMPRESA == '')
                $model->ID_EMPRESA = Yii::app()->getSession()->get('id_empresa');
            if ($model->save()) {
                Auditoria::model()->registrarAccion('', $model->ID_CARGO, $model->NOMBRE_CARGO);
                $this->redirect(array('view', 'id' => $model->ID_CARGO));
            }
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

        if (isset($_POST['Cargos'])) {
            $model->attributes = $_POST['Cargos'];
            if ($model->save()) {

                Auditoria::model()->registrarAccion('', $model->ID_CARGO, $model->NOMBRE_CARGO);
                $this->redirect(array('view', 'id' => $model->ID_CARGO));
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
        $personas = Personal::model()->findByAttributes(array('ID_CARGO' => $id));

        $msg = "No se pudo eliminar ya que tiene ";

        if (count($personas) > 0) {
            $msg.= "personas asociados";
        }
        try {
            $this->loadModel($id)->delete();
            Auditoria::model()->registrarAccion('', $model->ID_CARGO, $model->NOMBRE_CARGO);
            if (!isset($_GET['ajax']))
                Yii::app()->user->setFlash('success', 'Cargo eliminado correctamente');
            else
                echo "<div class='alert alert-success'>Cargo eliminado correctamente</div>";
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
        $dataProvider = new CActiveDataProvider('Cargos');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Cargos('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Cargos']))
            $model->attributes = $_GET['Cargos'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Cargos the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Cargos::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Cargos $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'cargos-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGetCargos() {
        $idep = 0;
        if (isset($_POST['Cargos']))
            $idep = $_POST['Cargos']['ID_EMPRESA'];
        if (isset($_POST['id_emp']))
            $idep = $_POST['id_emp'];;
        $criteria = new CDbCriteria();
        $criteria->condition = 'ID_EMPRESA=' . $idep;
        $lista = Cargos::model()->findAll($criteria);
        $lista = CHtml::listData($lista, 'ID_CARGO', 'NOMBRE_CARGO');
        if (isset($_POST['id_emp'])) {
            $t = '';
            foreach ($lista as $valor => $descripcion) {
                $t.='<option value="' . $valor . '">' . $descripcion . '</option>';
                //echo CHtml::tag('option', array('value'=>$valor), CHtml::encode($descripcion), true);
            }
            //print_r($contratistas);
            echo CJSON::encode($t);
        } else {
                echo CHtml::tag('option',array('empty'=>'Seleccione Cargo'));
            foreach ($lista as $valor => $descripcion) {
                echo CHtml::tag('option', array('value' => $valor), CHtml::encode($descripcion), true);
            }
        }
    }

}
