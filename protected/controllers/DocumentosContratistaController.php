<?php

class DocumentosContratistaController extends Controller
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
				'actions'=>array('create','update','admin','delete','index','view'),
				'expression'=>'$user->A1() || $user->JDP()',
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
		$model=new DocumentosContratista;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DocumentosContratista']))
		{
			$model->attributes=$_POST['DocumentosContratista'];
			if($model->save())
			{
				Auditoria::model()->registrarAccion('', $model->ID_DOCUMENTO , $model->NOMBRE_DOCUMENTO);
				$this->redirect(array('view','id'=>$model->ID_DOCUMENTO));
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

		if(isset($_POST['DocumentosContratista']))
		{
			$model->attributes=$_POST['DocumentosContratista'];
			if($model->save())
			{
				Auditoria::model()->registrarAccion('', $model->ID_DOCUMENTO , $model->NOMBRE_DOCUMENTO);
				$this->redirect(array('view','id'=>$model->ID_DOCUMENTO));
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
		$rec = RecepcionDocumentos::model()->findByAttributes(array('ID_DOCUMENTO'=>$id));
		$msg ="No se pudo eliminar ya que tiene ";

		if (count($rec) > 0) {
			$msg.= "recepciones asociadas";
		}

		try{
			$this->loadModel($id)->delete();
			Auditoria::model()->registrarAccion('', $model->ID_DOCUMENTO , $model->NOMBRE_DOCUMENTO);	
			if(!isset($_GET['ajax']))
		        Yii::app()->user->setFlash('success','Documento eliminado correctamente');
		    else
		        echo "<div class='alert alert-success'>Documento eliminado correctamente</div>";
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
		$dataProvider=new CActiveDataProvider('DocumentosContratista');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new DocumentosContratista('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DocumentosContratista']))
			$model->attributes=$_GET['DocumentosContratista'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return DocumentosContratista the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=DocumentosContratista::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param DocumentosContratista $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='DocumentosContratista-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
