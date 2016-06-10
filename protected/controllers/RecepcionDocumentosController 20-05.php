<?php

class RecepciondocumentosController extends Controller
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
				'actions'=>array('create','update','admin','delete','index','view','aprobarDocumentos','cambiarPendiente','consultarEstados','consultarEstadoDocumentos'),
				'expression'=>'$user->ADM() || $user->A1()',
			),	
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionConsultarEstadoDocumentos(){
		$id = $_POST['id_cont'];
		$sql = "SELECT ID_RECEPCION, NOMBRE_CONTRATISTA, NOMBRE_DOCUMENTO, FECHA_RECEPCION FROM (recepcion_documentos r INNER JOIN contratista c ON r.ID_CONTRATISTA=c.ID_CONTRATISTA) INNER JOIN documentos_contratista d ON r.ID_DOCUMENTO=d.ID_DOCUMENTO WHERE r.ESTADO=0 and r.FECHA_RECEPCION < CURDATE() AND c.ID_CONTRATISTA=".$id;
		$pendientes =  Yii::app()->db->createCommand($sql)->queryAll();

		$t = '';
		if(count($pendientes) > 0){
			$t.='<strong>Documentos Contratistas Pendientes</strong>';
			$t.='<ul>';
			foreach($pendientes as $item){
				$t.='<li>'.$item['NOMBRE_CONTRATISTA']." falta entregar ".$item['NOMBRE_DOCUMENTO'].", fecha de recepción programada: ".$item['FECHA_RECEPCION'].'</li>';
			}
			$t.='</ul>';
		}
		echo CJSON::encode($t);
	}

	public function actionConsultarEstados(){
		$sql = "SELECT ID_RECEPCION, NOMBRE_CONTRATISTA, NOMBRE_DOCUMENTO, FECHA_RECEPCION FROM (recepcion_documentos r INNER JOIN contratista c ON r.ID_CONTRATISTA=c.ID_CONTRATISTA) INNER JOIN documentos_contratista d ON r.ID_DOCUMENTO=d.ID_DOCUMENTO WHERE r.ESTADO=0 and r.FECHA_RECEPCION < CURDATE()";
		$pendientes =  Yii::app()->db->createCommand($sql)->queryAll();

		$t = '';
		if(count($pendientes) > 0){
			$t.='<strong>Documentos Contratistas Pendientes</strong>';
			$t.='<ul>';
			foreach($pendientes as $item){
				$t.='<li>'.$item['NOMBRE_CONTRATISTA']." falta entregar ".$item['NOMBRE_DOCUMENTO'].", fecha de recepción programada: ".$item['FECHA_RECEPCION'].'</li>';
			}
			$t.='</ul>';
		}
		echo CJSON::encode($t);
	}

	public function actionAprobarDocumentos(){
		$orden = explode(',', $_POST['theIds']);
        if(!empty($_POST['theIds'])){
	        foreach($orden as $doc){
	        	$model = RecepcionDocumentos::model()->findByPk($doc);
	        	$model->ESTADO = 1;
	        	$model->save();
	        }
	    }
	}
	
	public function actionCambiarPendiente(){
		$orden = explode(',', $_POST['theIds']);
        if(!empty($_POST['theIds'])){
	        foreach($orden as $doc){
	        	$model = RecepcionDocumentos::model()->findByPk($doc);
	        	$model->ESTADO = 0;
	        	$model->save();
	        }
	    }
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model_contratista = Contratista::model()->findByAttributes(array('ID_CONTRATISTA'=>$id));

		$sort = new CSort();
		// crear una nueva instancia de un data provider para cargar los documentos segun el contratista
	    $dpContratista=new CActiveDataProvider('RecepcionDocumentos',array(
	    	'sort'=>array(
	    		'defaultOrder'=>'FECHA_RECEPCION ASC',
	    		),
	    	));
	     $dpContratista->criteria = array('condition'=>'ID_CONTRATISTA='.$id);
		//$contratista = Recepciondocumentos::model()->findAllByAttributes(array('ID_CONTRATISTA'=>$id));

		$this->render('view',array(
		//	'model'=>$this->loadModel($id),
			'contratista'=>$dpContratista,
			 'model'=>$model_contratista,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new RecepcionDocumentos;
		$model_contratista = Contratista::model()->findAllByAttributes(array('AUTORIZADO'=>1));
		$model_documentos = DocumentosContratista::model()->findAll(array('select'=>'ID_DOCUMENTO, NOMBRE_DOCUMENTO', 'order'=>'ID_DOCUMENTO'));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RecepcionDocumentos']))
		{
			$fecha=$_POST['RecepcionDocumentos']['FECHA_RECEPCION'];
			//print_r($_POST['documento']);
			//die(print_r($_POST['documento']));
			//$model->attributes=$_POST['Recepciondocumentos'];
			$msg = "";
			foreach ($_POST['documento'] as $value) {
				$datos=explode(",", $value);
				$msg.=$datos[0]."-".$datos[1]."\n";
				$model=new Recepciondocumentos;
				$model->FECHA_RECEPCION=$fecha;
				$model->ID_CONTRATISTA=(int)$datos[0];
				$model->ID_DOCUMENTO=(int)$datos[1];
				$model->ESTADO=0;
				if($model->save()){
					Auditoria::model()->registrarAccion('', $model->ID_RECEPCION , $model->FECHA_RECEPCION.", ID contratista=".$model->ID_CONTRATISTA);
				}
			}
			$this->redirect(array('admin'));
		}
		$this->render('create',array(
			'model'=>$model,
			'model_contratista'=>$model_contratista,
			'model_documentos'=>$model_documentos,
		));
	}

	public function actionUpdate($id){
		$model=$this->loadModel($id);
		if(isset($_POST['RecepcionDocumentos']))
		{
			$model->attributes=$_POST['RecepcionDocumentos'];
			if($model->save())
				$this->redirect(array('admin'));
		}
		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	/*public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$model_contratista = Contratista::model()->findAllByAttributes(array('AUTORIZADO'=>1));
		$model_documentos = DocumentosContratista::model()->findAllByAttributes(array('ID_DOCUMENTO'=>$id));

		if(isset($_POST['Recepciondocumentos']))
		{
			$fecha=$_POST['Recepciondocumentos']['FECHA_RECEPCION'];
			//print_r($_POST['documento']);
			//die();
			//$model->attributes=$_POST['Recepciondocumentos'];

			$model2=new Recepciondocumentos;
			$model2->FECHA_RECEPCION=$fecha;
			$model2->ID_CONTRATISTA=$model_contratista;
			$model2->ID_DOCUMENTO=$model_documentos;
			$model2->ESTADO=$model->ESTADO;
			$model2->save();
			if($model->save())
			{
				Auditoria::model()->registrarAccion('', $model->ID_RECEPCION , $model->FECHA_RECEPCION.", ID contratista=".$model->ID_CONTRATISTA);
				$this->redirect(array('admin','id'=>$model2->ID_CONTRATISTA));
			}
				//$this->redirect(array('view','id'=>$model->ID_RECEPCION));
			
		}*/
		/*if(isset($_POST['Recepciondocumentos']))
		{
			$model->attributes=$_POST['Recepciondocumentos'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ID_RECEPCION));
		}*/
/*
		$this->render('update',array(
			'model'=>$model,
			'model_contratista'=>$model_contratista,
			'model_documentos'=>$model_documentos,
		));
	}*/

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model=$this->loadModel($id);
		Auditoria::model()->registrarAccion('', $model->ID_RECEPCION , $model->FECHA_RECEPCION.", ID contratista=".$model->ID_CONTRATISTA);
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
		$dataProvider=new CActiveDataProvider('RecepcionDocumentos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new RecepcionDocumentos('search');
		$detalle = RecepcionDocumentos::model()->findAll(array('select'=>'ID_CONTRATISTA,FECHA_RECEPCION,ID_DOCUMENTO', 'order'=>'FECHA_RECEPCION DESC, ID_CONTRATISTA, ID_DOCUMENTO'));
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Recepciondocumentos']))
			$model->attributes=$_GET['RecepcionDocumentos'];
		$this->render('admin',array(
			'model'=>$model,
			'detalle'=>$detalle,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Recepciondocumentos the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=RecepcionDocumentos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Recepciondocumentos $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='recepciondocumentos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
