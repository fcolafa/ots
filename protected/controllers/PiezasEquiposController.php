<?php

class PiezasEquiposController extends Controller
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
				'expression'=>'$user->A1()',
			),
			//CRUD todos los permisos otorgados por default a las cuentas tipo super administrador
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create', 'createPartial', 'update', 'admin', 'delete', 'index', 'view', 'updateFT'),
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
		$model=new PiezasEquipos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PiezasEquipos']))
		{
			$model->attributes=$_POST['PiezasEquipos'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ID_PIEZA));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}



	/*** Create desde el form de equipos. */

	public function actionCreatePartial($id) {
        $model = new PiezasEquipos;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['PiezasEquipos']) && isset($_POST['submit_piezas'])) {
            $model->attributes = $_POST['PiezasEquipos'];

            $model->ID_EQUIPO = $id;
            $model->archivo = CUploadedFile::getInstance($model, 'IMAGEN_PIEZA');
            if ($model->save()):
            	if (!empty($model->archivo))
					$model->archivo->saveAs(Yii::app()->basePath.'/../archivos/equipos/'.$model->IMAGEN_PIEZA);
                echo CHtml::script("window.parent.$('#cru-dialog2').dialog('close'); window.parent.location.reload();");
            endif;

        }

        $this->renderPartial('_partialPiezas', array(
            'model' => $model,
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

		if(isset($_POST['PiezasEquipos']))
		{
			$model->attributes=$_POST['PiezasEquipos'];
			
			$model->archivo = CUploadedFile::getInstance($model, 'IMAGEN_PIEZA');
			if($model->save()):
				if (!empty($model->archivo))
					$model->archivo->saveAs(Yii::app()->basePath.'/../archivos/equipos/'.$model->IMAGEN_PIEZA);
				$this->redirect(array('view','id'=>$model->ID_PIEZA));
			endif;
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}



	/**
	 * Update desde Ficha Técnica Equipo.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdateFT($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PiezasEquipos']))
		{
			$model->attributes=$_POST['PiezasEquipos'];
			$model->archivo = CUploadedFile::getInstance($model, 'IMAGEN_PIEZA');
			if($model->save()):
				if (!empty($model->archivo))
					$model->archivo->saveAs(Yii::app()->basePath.'/../archivos/equipos/'.$model->IMAGEN_PIEZA);
				echo CHtml::script("window.parent.$('#cru-dialog').dialog('close'); window.parent.location.reload();");
			endif;
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
		$dataProvider=new CActiveDataProvider('PiezasEquipos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new PiezasEquipos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PiezasEquipos']))
			$model->attributes=$_GET['PiezasEquipos'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return PiezasEquipos the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=PiezasEquipos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param PiezasEquipos $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='piezas-equipos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
