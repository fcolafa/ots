<?php

class OTController extends Controller
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
			//RU
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','viewPDF','admin'),
				'expression'=>'$user->AN() || $user->GE() || $user->GC() || $user->JA() || $user->PR()',
			),
			//CRUD todos los permisos otorgados a las cuentas indicadas
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete','index','view','viewPDF','listarContratistas','listarDepartamento','listarCentros','listarSolicitante', 'listarPresupuestos','generar'),
				'expression'=>'$user->A1() || $user->JP() || $user->SG()',
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
		$detalle = InsumosOt::model()->findAll(array('condition'=>'ID_OT='.$id, 'order'=>'NRO_ITEM, CAST(NUMERO_SUB_ITEM AS UNSIGNED)'));

		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'detalle'=>$detalle,
		));
	}


	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionViewPDF($id)
	{
		Yii::import('ext.MPDF57.mpdf', true);

		$detalle = InsumosOt::model()->findAll(array('condition'=>'ID_OT='.$id, 'order'=>'NRO_ITEM, CAST(NUMERO_SUB_ITEM AS UNSIGNED)'));
		//$this->render('ot_pdf',array('model' => $this->loadModel($id),'detalle' => $detalle));

		$mpdf = new mpdf();
		$mpdf->WriteHTML($this->renderPartial('ot_pdf',array('model' => $this->loadModel($id),'detalle' => $detalle),true));
		$mpdf->Output();

	}


	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionGenerar($id=0)
	{
		$model = new Ot;
		$detalle_ppto = array();
		if ($id > 0){ // si viene desde presupuesto cargo las ot
			$model->ID_PRESUPUESTO = $id;
			$detalle_ppto = SubItemPresupuesto::model()->with('iDITEMPRESUPUESTO')->findAll(array('condition'=>'iDITEMPRESUPUESTO.ID_PRESUPUESTO='.$id, 'order'=>'ID_CONTRATISTA, iDITEMPRESUPUESTO.NRO_ITEM, CAST(NUMERO_SUB_ITEM AS UNSIGNED)'));
		}

		if (isset($_POST['Ot'])) { // si viene desde form generar consulto se genera la vista previa o se guardan las ots
			if (isset($_POST['view_presup'])) { // generar vista previa
				$id = $_POST['Ot']['ID_PRESUPUESTO'];
				$model->ID_PRESUPUESTO = $id;
				$detalle_ppto = SubItemPresupuesto::model()->with('iDITEMPRESUPUESTO')->findAll(array('condition'=>'iDITEMPRESUPUESTO.ID_PRESUPUESTO='.$id, 'order'=>'ID_CONTRATISTA, iDITEMPRESUPUESTO.NRO_ITEM, CAST(NUMERO_SUB_ITEM AS UNSIGNED)'));

			}
			if (isset($_POST['genera_ot']) && isset($_POST['Ordenes'])) { //guardar las ot
				foreach ($_POST['Ordenes'] as $value) { //['ID_PRESUPUESTO']  ['ID_CONTRATISTA']
	    		if (($value['ID_PRESUPUESTO'] > 0) && ($value['ID_CONTRATISTA'] > 0)) {
	    			$id = $value['ID_PRESUPUESTO'];
	    			$ot_contratista = SubItemPresupuesto::model()->with('iDITEMPRESUPUESTO')->findAll(array('condition'=>'iDITEMPRESUPUESTO.ID_PRESUPUESTO='.$id.' AND ID_CONTRATISTA='.$value['ID_CONTRATISTA'], 'order'=>'iDITEMPRESUPUESTO.NRO_ITEM, CAST(NUMERO_SUB_ITEM AS UNSIGNED)'));
	    			if (count($ot_contratista) > 0){	//creo la ot

	    				$nro_ot = Ot::model()->findBySql("SELECT MAX(CAST(NUMERO_OT AS UNSIGNED)) AS NUMERO_OT FROM ot WHERE ID_PRESUPUESTO = ".$id );
	    				if (count($nro_ot) > 0){
	    					$nro = $nro_ot->NUMERO_OT + 1 ;
	    					if ($nro < 10):
	    						$nro = "00".$nro;
	    					elseif ($nro < 100):
	    						$nro = "0".$nro;
	    					endif;
	    				}else{
								$nro = "001";
	    				}	    				
	    				$model = new Ot;
	    				$model->attributes = $value;
	    				$model->FECHA_OT = date("Y-m-d");
	    				$model->NUMERO_OT = $nro;
	    				$model->save();
		    			foreach ($ot_contratista as $sub_item) {
		    				$detalle = new InsumosOt;
		    				$detalle->ID_OT = $model->ID_OT;
		    				$detalle->ID_SUB_ITEM_PPTO = $sub_item->ID_SUB_ITEM_PPTO;
		    				$detalle->NRO_ITEM = $sub_item->iDITEMPRESUPUESTO->NRO_ITEM;
		    				$detalle->NUMERO_SUB_ITEM = $sub_item->NUMERO_SUB_ITEM;
		    				$detalle->NOMBRE_SUB_ITEM = $sub_item->NOMBRE_SUB_ITEM;
		    				$detalle->UNIDAD_DE_MEDIDA = $sub_item->UNIDAD_DE_MEDIDA;
		    				$detalle->CANTIDAD = $sub_item->CANTIDAD;
		    				$detalle->COSTO_CONTRATISTA = $sub_item->COSTO_CONTRATISTA;
		    				$detalle->TOTAL_CONTRATISTA = $sub_item->TOTAL_CONTRATISTA;
		    				$detalle->save();
		    			}
		    		}
	    		}
	    	}

				$this->redirect(array('index', 'ppto'=>$id));
			}
		}

		$this->render('generar',array(
			'idPpto'=>$id,
			'model'=>$model,
			'detalle_ppto'=>$detalle_ppto,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Ot;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Ot']))
		{
			$model->attributes=$_POST['Ot'];
			if($model->save()){
				//Auditoria::model()->registrarAccion('', $model->ID_OT ,"contratista " $model->ID_CONTRATISTA.", solicita ".$model->SOLICITANTE.", fecha " $model->FECHA_OT);
				$this->redirect(array('view','id'=>$model->ID_OT));

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

		if(isset($_POST['Ot']))
		{
			$model->attributes=$_POST['Ot'];
			if($model->save()){
				//Auditoria::model()->registrarAccion('', $model->ID_OT ,"contratista " $model->ID_CONTRATISTA.", solicita ".$model->SOLICITANTE.", fecha " $model->FECHA_OT);
				$this->redirect(array('view','id'=>$model->ID_OT));
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
		//Auditoria::model()->registrarAccion('', $model->ID_OT ,"contratista " $model->ID_CONTRATISTA.", solicita ".$model->SOLICITANTE.", fecha " $model->FECHA_OT);
		$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			RegistroAcciones::model()->registrarAccion('Ot','Borrar');
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($ppto=0)
	{

		if ($ppto == 0):
			$dataProvider=new CActiveDataProvider('Ot',array(
	            'sort'=>array('defaultOrder'=>'ID_OT DESC')));
		else:
			$dataProvider=new CActiveDataProvider('Ot',array(
	            'sort'=>array('defaultOrder'=>'ID_OT DESC'),
	            'criteria'=>array('condition'=>'ID_PRESUPUESTO='.$ppto,)
	            ));
		endif;
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Ot('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Ot']))
			$model->attributes=$_GET['Ot'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionListarContratistas($term) {
		$criteria = new CDbCriteria;
		$criteria->condition = "NOMBRE_EMPRESA_CONTRATISTA like :term";
		$criteria->params = array(':term'=> '%'.$_GET['term'].'%');
		$criteria->limit = 20;
		$data = Contratista::model()->findAll($criteria);
		$arr = array();
		foreach ($data as $item) {
			$arr[] = array(
			'id' => $item->ID_CONTRATISTA,
			'value' => $item->NOMBRE_EMPRESA_CONTRATISTA,
			'label' => $item->NOMBRE_EMPRESA_CONTRATISTA,
			);
		}
		echo CJSON::encode($arr);
	}


	public function actionListarDepartamento($term) {
		$criteria = new CDbCriteria;
		$criteria->condition = "NOMBRE_DEPARTAMENTO like :term";
		$criteria->params = array(':term'=> '%'.$_GET['term'].'%');
		$criteria->limit = 20;
		$data = Departamentos::model()->findAll($criteria);
		$arr = array();
		foreach ($data as $item) {
			$arr[] = array(
			'id' => $item->ID_DEPARTAMENTO,
			'value' => $item->NOMBRE_DEPARTAMENTO,
			'label' => $item->NOMBRE_DEPARTAMENTO,
			);
		}
		echo CJSON::encode($arr);
	}

	public function actionListarCentros($term) {
		$criteria = new CDbCriteria;
		$criteria->condition = "NOMBRE_CENTRO_COSTO like :term";
		$criteria->params = array(':term'=> '%'.$_GET['term'].'%');
		$criteria->limit = 20;
		$data = CentroDeCostos::model()->findAll($criteria);
		$arr = array();
		foreach ($data as $item) {
			$arr[] = array(
			'id' => $item->ID_CENTRO_COSTO,
			'value' => $item->ID_CENTRO_COSTO,
			'label' => $item->NOMBRE_CENTRO_COSTO,
			);
		}
		echo CJSON::encode($arr);
	}


	public function actionListarPresupuestos($term) {
		$criteria = new CDbCriteria;
		$criteria->condition = "NOMBRE_PRESUPUESTO like :term";
		$criteria->params = array(':term'=> '%'.$_GET['term'].'%');
		$criteria->limit = 20;
		$data = Presupuesto::model()->findAll($criteria);
		$arr = array();
		foreach ($data as $item) {
			$arr[] = array(
			'id' => $item->ID_PRESUPUESTO,
			'value' => $item->ID_PRESUPUESTO,
			'label' => $item->NOMBRE_PRESUPUESTO,
			);
		}
		echo CJSON::encode($arr);
	}



	public function actionListarSolicitante($term) 
	{
		$criteria = new CDbCriteria;
		$criteria->condition = "SOLICITANTE like :term";
		$criteria->params = array(':term'=> '%'.$_GET['term'].'%');
		$criteria->limit = 20;
		$data = Ot::model()->findAll($criteria);
		$arr = array();
		foreach ($data as $item) {
			$arr[] = array(
				'id'    => $item->SOLICITANTE,
				'value' => $item->SOLICITANTE,
				'label' => $item->SOLICITANTE,
			);
		}
		echo CJSON::encode($arr);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Ot the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Ot::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Ot $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ot-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function loadNameContratista($id)
	{
		$model=Contratista::model()->findByPk($id);
		$name = $model->NOMBRE_EMPRESA_CONTRATISTA;
		return $name;
	}
}
