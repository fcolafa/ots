<?php

class DepartamentosController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
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
	public function accessRules()
	{
		return array(
			//CRUD todos los permisos otorgados por default a las cuentas tipo super administrador
			array('allow',
				'actions'=>array('listarDepartamento','getDepartamentos'),
				'expression'=>'$user->ADM()||$user->JDP()|| $user->GOP()|| $user->GG()||$user->LOG()',
				),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete','index','view','listarDepartamento','getDepartamentos'),
				'expression'=>'$user->A1()',
			),

			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Departamentos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Departamentos']))
		{
			$model->attributes=$_POST['Departamentos'];
			if($model->save()){
				Auditoria::model()->registrarAccion('', $model->ID_DEPARTAMENTO , $model->NOMBRE_DEPARTAMENTO);	
				$this->redirect(array('view','id'=>$model->ID_DEPARTAMENTO));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Departamentos']))
		{
			$model->attributes=$_POST['Departamentos'];
			if($model->save()){
				Auditoria::model()->registrarAccion('', $model->ID_DEPARTAMENTO , $model->NOMBRE_DEPARTAMENTO);	
				$this->redirect(array('view','id'=>$model->ID_DEPARTAMENTO));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$ots = OrdenTrabajo::model()->findByAttributes(array('ID_DEPARTAMENTO'=>$id));
		$msg ="No se pudo eliminar ya que tiene ";

		if (count($ots) > 0) {
			$msg.= "Orden de Trabajo asociados";
		}

		try{
			$this->loadModel($id)->delete();
			Auditoria::model()->registrarAccion('', $model->ID_DEPARTAMENTO , $model->NOMBRE_DEPARTAMENTO);	
			if(!isset($_GET['ajax']))
		        Yii::app()->user->setFlash('success','Departamento eliminado correctamente');
		    else
		        echo "<div class='alert alert-success'>Departamento eliminado correctamente</div>";
		}catch(CDbException $e){
		    if(!isset($_GET['ajax']))
		        Yii::app()->user->setFlash('error',$msg);
		    else
		        echo "<div class='alert alert-danger'>".$msg."</div>";
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Departamentos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Departamentos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Departamentos']))
			$model->attributes=$_GET['Departamentos'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Departamentos the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Departamentos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Departamentos $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='departamentos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionGetDepartamentos()
	{
		$id_solicitante = $_POST['OrdenTrabajo']['SOLICITANTE'];
		$persona = Personal::model()->findByPk($id_solicitante);
		$lista = Departamentos::model()->findAll('ID_DEPARTAMENTO=:id_dep',
				array(':id_dep'=>$persona->ID_DEPARTAMENTO));
		$lista = CHtml::listData($lista,'ID_DEPARTAMENTO', 'NOMBRE_DEPARTAMENTO');

		foreach ($lista as $valor => $descripcion) {
			echo CHtml::tag('option', array('value'=>$valor), CHtml::encode($descripcion), true);
		}
	}
}
