<?php

class InsumosOtController extends Controller
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
			//CRUD todos los permisos otorgados a las cuentas indicadas
			/*array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('admin','index','view', 'listarSubItems'),
				'expression'=>'$user->A1() || $user->JDP() || $user->GG() || $user->GOP() || $user->ADM()',
			),*/
			//CRUD todos los permisos otorgados por default a las cuentas tipo super administrador
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update','delete','listarSubItems'),
				'expression'=>'$user->A1() || $user->JDP() || $user->ADM()',
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
		$model=new InsumosOT;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['InsumosOT']))
		{
			$model->attributes=$_POST['InsumosOT'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ID_INSUMOS_OT));
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
		//die(print_r($_POST['InsumosOt']['ID_INSUMOS_OT']));
		if(isset($_POST['InsumosOT']))
		{
			$model->attributes=$_POST['InsumosOT'];
			if($model->save())
                            $this->redirect(array('ordenTrabajo/update','id'=>$model->ID_OT));
				//$this->redirect(array('view','id'=>$model->ID_INSUMOS_OT));
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
            $model=  $this->loadModel($id);
            $idot=$model->ID_OT;
            $model->delete();
            echo '<script type="text/javascript">window.location.href="/ordenTrabajo/update/"'.$id.'; </script>';
            //if(!isset($_GET['ajax']))
            //$this->redirect('ordenTrabajo/update',array('id'=>$idot));  
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
             //      echo json_encode(array('redirect'=>$this->createUrl('/ordenTrabajo/update',array('id'=>$idot))));
        }
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('InsumosOt');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new InsumosOT('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['InsumosOt']))
			$model->attributes=$_GET['InsumosOt'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}


	public function actionListarSubItems($term) {
		$criteria = new CDbCriteria;
		$criteria->condition = "NOMBRE_SUB_ITEM like :term";
		$criteria->params = array(':term'=> '%'.$_GET['term'].'%');
              
		$criteria->limit = 20;
		$data = InsumosOT::model()->findAll($criteria);
		$arr = array();
		foreach ($data as $item) {
			$arr[] = array(
			'id' => $item->ID_INSUMOS_OT,
			'value' => $item->NOMBRE_SUB_ITEM,
			'label' => $item->NOMBRE_SUB_ITEM,
			);
		}
		echo CJSON::encode($arr);
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return InsumosOt the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=InsumosOT::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param InsumosOt $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='insumos-ot-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
