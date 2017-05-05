<?php

class RegistroMantencionController extends Controller
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
			//R
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				//grupo 
				'expression'=>'$user->A1()',
			),

			//CRUD todos los permisos otorgados a las cuentas indicadas
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete','index','view'),
				'expression'=>'$user->A1() || $user->MNT()',
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
		$model=new RegistroMantencion;
		$model_equipos = Equipo::model()->findAll();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RegistroMantencion']))
		{ 
			$x=0;
			foreach ($_POST['RegistroMantencion'] as $value):
				 Yii::log("cant =".$x." id_equipo ".$value['ID_EQUIPO']." fecha ".$value['FECHA_REGISTRO']." horom_m ".$value['REGISTRO_MARCADO'],"warning");
				if (($value['REGISTRO_MARCADO'] > 0) && ($value['ID_EQUIPO'] > 0)):
					$mant = new RegistroMantencion;
					$mant->ID_EQUIPO = $value['ID_EQUIPO'];
					$mant->FECHA_REGISTRO = $value['FECHA_REGISTRO'];
					$mant->REGISTRO_MARCADO = $value['REGISTRO_MARCADO'];
					$mant->COMENTARIO_REGISTRO = $value['COMENTARIO_REGISTRO'];
					if ($mant->save())
						$x++;
				endif;
			endforeach;
			Yii::log("cant =".$x,"warning");
				$this->redirect(array('RegistroMantencion/admin'));
		}

		$this->render('create',array(
			'model'=>$model,
			'model_equipos'=>$model_equipos,
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

		if(isset($_POST['RegistroMantencion']))
		{
			$model->attributes=$_POST['RegistroMantencion'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ID_REGISTRO));
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('RegistroMantencion');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new RegistroMantencion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['RegistroMantencion']))
			$model->attributes=$_GET['RegistroMantencion'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return RegistroMantencion the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=RegistroMantencion::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param RegistroMantencion $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='registro-mantencion-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
