<?php

class TipoUsuarioController extends Controller
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete','index','view'),
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
		$model=new TipoUsuario;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TipoUsuario']))
		{
			$model->attributes=$_POST['TipoUsuario'];
			if($model->save())
			{
				Auditoria::model()->registrarAccion('', 0 , $model->COD_TIPO_USUARIO.", nombre=".$model->NOMBRE_TIPO_USUARIO);
				$this->redirect(array('admin'));
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
	public function actionUpdate($ids)
	{
		$model=$this->loadModel($ids);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TipoUsuario']))
		{
			$model->attributes=$_POST['TipoUsuario'];
			if($model->save())
			{
				Auditoria::model()->registrarAccion('', 0 , $model->COD_TIPO_USUARIO.", nombre=".$model->NOMBRE_TIPO_USUARIO);
				$this->redirect(array('admin'));
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
	public function actionDelete($ids)
	{
		$usuarios = Usuarios::model()->findAllByAttributes(array('COD_TIPO_USUARIO'=>$ids));

		$msg ="No se pudo eliminar ya que tiene ";

		if (count($usuarios) > 0) {
			$msg.= "personas asociados";
		}
		try{
			//$model = TipoUsuario::model()->findByAttributes(array('COD_TIPO_USUARIO'=>$ids));
			$model=$this->loadModel($ids);
			$model->delete();
			Auditoria::model()->registrarAccion('', 0 , $model->COD_TIPO_USUARIO.", nombre=".$model->NOMBRE_TIPO_USUARIO);
			if(!isset($_GET['ajax']))
		        Yii::app()->user->setFlash('success','Tipo Usuario eliminado correctamente');
		    else
		        echo "<div class='alert alert-success'>Tipo Usuario eliminado correctamente</div>";
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
		$dataProvider=new CActiveDataProvider('TipoUsuario');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TipoUsuario('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TipoUsuario']))
			$model->attributes=$_GET['TipoUsuario'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TipoUsuario the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TipoUsuario::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TipoUsuario $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tipo-usuario-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
