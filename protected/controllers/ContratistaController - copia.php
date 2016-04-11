<?php

class ContratistaController extends Controller
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
			//CRUD
			array('allow',
				'actions'=>array('create','update','admin','delete','index','view','listarContratistas'),
				'expression'=>'$user->A1() ',
			),	
			array('deny',
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
		$model=new Contratista;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Contratista']))
		{
			$model->attributes=$_POST['Contratista'];
			if($model->save()){
				Auditoria::model()->registrarAccion('', $model->ID_CONTRATISTA , $model->NOMBRE_CONTRATISTA);
				$this->redirect(array('view','id'=>$model->ID_CONTRATISTA));
			}else{
				RegistroAcciones::model()->registrarAccion('Contratista','Error al crear');
				//$this->redirect(array('create'));
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

		if(isset($_POST['Contratista']))
		{
			$model->attributes=$_POST['Contratista'];
			if($model->save()){
				Auditoria::model()->registrarAccion('', $model->ID_CONTRATISTA , $model->NOMBRE_CONTRATISTA);
				$this->redirect(array('view','id'=>$model->ID_CONTRATISTA));
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
		$model=$this->loadModel($id);
		Auditoria::model()->registrarAccion('', $model->ID_CONTRATISTA , $model->NOMBRE_CONTRATISTA);
		$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Contratista');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Contratista('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Contratista']))
			$model->attributes=$_GET['Contratista'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionListarContratistas($term) {
		$criteria = new CDbCriteria;
		$criteria->condition = "GIRO_AREA like :term";
		$criteria->params = array(':term'=> '%'.$_GET['term'].'%');
		$criteria->limit = 20;
		$data = Contratista::model()->findAll($criteria);
		$arr = array();
		foreach ($data as $item) {
			$arr[] = array(
			'id' => $item->ID_CONTRATISTA,
			'value' => $item->GIRO_AREA,
			'label' => $item->GIRO_AREA,
			);
		}
		echo CJSON::encode($arr);
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Contratista the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Contratista::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Contratista $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='contratista-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
