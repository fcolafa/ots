<?php

class EquipoController extends Controller
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
				//'expression'=>'$user->U2()',
			),
			//CRUD todos los permisos otorgados por default a las cuentas tipo super administrador
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
		$model = new Equipo;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Equipo']))
		{
			$model->attributes=$_POST['Equipo'];
			
			$model->archivo = CUploadedFile::getInstance($model, 'IMAGEN_EQUIPO');
			if($model->save()):
				if (!empty($model->archivo))
					$model->archivo->saveAs(Yii::app()->basePath.'/../archivos/equipos/'.$model->IMAGEN_EQUIPO);
					//RegistroAcciones::model()->registrarAccion('Presupuesto', 'Crear');
				$this->redirect(array('update','id'=>$model->ID_EQUIPO));

			endif;
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

		$new_piezas = new PiezasEquipos;
		$piezas = PiezasEquipos::model()->findAll(array('condition' => 'ID_EQUIPO=' . $id));

		if (isset($_POST['PiezasEquipos']) && isset($_POST['submit_piezas'])) {
            $new_piezas->attributes = $_POST['PiezasEquipos'];
            $new_piezas->ID_EQUIPO = $id;
            $new_piezas->archivo = CUploadedFile::getInstance($new_piezas, 'IMAGEN_PIEZA');
            if ($new_piezas->save()):
            	if (!empty($new_piezas->archivo))
					$new_piezas->archivo->saveAs(Yii::app()->basePath.'/../archivos/equipos/'.$new_piezas->IMAGEN_PIEZA);
                $this->redirect(array('update', 'id' => $model->ID_EQUIPO));
            endif;
        }

		if(isset($_POST['Equipo']))
		{
			$model->attributes=$_POST['Equipo'];
			$model->archivo = CUploadedFile::getInstance($model, 'IMAGEN_EQUIPO');
			if($model->save()):
				if (!empty($model->archivo))
					$model->archivo->saveAs(Yii::app()->basePath.'/../archivos/equipos/'.$model->IMAGEN_EQUIPO);
				$this->redirect(array('update','id'=>$model->ID_EQUIPO));
			endif;
		}

		$this->render('update',array(
			'model'=>$model,
            'piezas' => $piezas,
            'new_piezas' => $new_piezas,
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
		$dataProvider=new CActiveDataProvider('Equipo');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new RegistroEquipo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Equipo']))
			$model->attributes=$_GET['Equipo'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Equipo the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Equipo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Equipo $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='equipo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
