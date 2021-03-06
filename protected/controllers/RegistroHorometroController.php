<?php

class RegistroHorometroController extends Controller
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
		$model=new RegistroHorometro;
		$model_equipos = Equipo::model()->findAll();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RegistroHorometro']))
		{ 
			$x=0;
			foreach ($_POST['RegistroHorometro'] as $value):
				// Yii::log("cant =".$x." id_equipo ".$value['ID_EQUIPO']." horom ".$value['HOROMETRO']." user ".Yii::app()->user->user_Id,"warning");
				if (($value['HOROMETRO'] > 0) && ($value['ID_EQUIPO'] > 0)):
					$horom = new RegistroHorometro;
					$horom->ID_EQUIPO = $value['ID_EQUIPO'];
					$horom->FECHA_REGISTRO = $value['FECHA_REGISTRO'];
					$horom->HOROMETRO = $value['HOROMETRO'];
					$horom->OBSERVACION = $value['OBSERVACION'];
					if ($horom->save())
						$x++;
				endif;
			endforeach;
			Yii::log("cant =".$x,"warning");
				$this->redirect(array('RegistroHorometro/admin'));
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

		if(isset($_POST['RegistroHorometro']))
		{
			$model->attributes=$_POST['RegistroHorometro'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ID_REGISTRO_HOROM));
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
		$dataProvider=new CActiveDataProvider('RegistroHorometro');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new RegistroHorometro('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['RegistroHorometro']))
			$model->attributes=$_GET['RegistroHorometro'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return RegistroHorometro the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=RegistroHorometro::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param RegistroHorometro $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='registro-horometro-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
