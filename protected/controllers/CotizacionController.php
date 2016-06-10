<?php

class CotizacionController extends Controller
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
			//RU
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','update'),
				//'expression'=>'$user->U1()',
			),
			//CRU
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','index','view','approveCot'),
				//'expression'=>'$user->OP1() || $user->F2() || $user->M2()',
			),
			//CRUD todos los permisos otorgados a las cuentas indicadas
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete','index','view'),
				'expression'=>'$user->A1() || $user->A2()',
			),
			//CRUD todos los permisos otorgados por default a las cuentas tipo super administrador
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete','index','view'),
				'expression'=>'$user->SA()',
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
		$model=new Cotizacion;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Cotizacion']))
		{
			$model->attributes=$_POST['Cotizacion'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ID_COTIZACION));
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

		if(isset($_POST['Cotizacion']))
		{
			$model->attributes=$_POST['Cotizacion'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ID_COTIZACION));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	public function actionApproveCot($id)
	{
		$model=$this->loadModel($id);
                
                if($model->DEF_COT==1){
                    throw new CHttpException(501, 'Esta cotizacion ya ha sido aprobada');
                }
                   
                    
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Cotizacion']))
		{
			$model->attributes=$_POST['Cotizacion'];
                        $model->DEF_COT=1;
                        $criteria=new CDbCriteria();
                        $criteria->condition='DEF_COT=1 AND ID_OT='.$model->ID_OT;
                        $cot=  Cotizacion::model()->findAll($criteria);
                        if($cot)
                            foreach($cot as $c){
                                $c->DEF_COT=NULL;
                                $c->COMENTARIOS_COTIZACION=NULL;
                                $c->save();
                            }
                                    
			if($model->save())
				$this->redirect(array('OrdenTrabajo/view','id'=>$model->ID_OT));
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
		$dataProvider=new CActiveDataProvider('Cotizacion');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Cotizacion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Cotizacion']))
			$model->attributes=$_GET['Cotizacion'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Cotizacion the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Cotizacion::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Cotizacion $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cotizacion-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
