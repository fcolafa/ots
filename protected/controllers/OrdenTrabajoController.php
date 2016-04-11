<?php

class OrdenTrabajoController extends Controller
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
				'actions'=>array('index','view','admin'),
				//grupo 
				//'expression'=>'$user->U2()',
			),
			//CRUD todos los permisos otorgados a las cuentas indicadas
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','viewPDF','viewOt','delete','aprobarOt','CambiarPendiente'),
				'expression'=>'$user->A1() || $user->ADM() || $user->GG() || $user->GOP() || $user->JDP()',
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
		$sub_items = InsumosOT::model()->findAll(array('condition'=>'ID_OT='.$id, 'order'=>'NUMERO_SUB_ITEM'));
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'sub_items' =>	 $sub_items,
		));
	}


	public function actionViewPDF($id)
	{
		Yii::import('ext.MPDF57.mpdf', true);

		$detalle = InsumosOT::model()->findAll(array('condition'=>'ID_OT='.$id, 'order'=>'CAST(NUMERO_SUB_ITEM AS UNSIGNED), NOMBRE_SUB_ITEM'));
		//$this->render('ot_pdf',array('model' => $this->loadModel($id),'detalle' => $detalle));

		$mpdf = new mpdf();
		$mpdf->WriteHTML($this->renderPartial('ot_pdf',array('model' => $this->loadModel($id),'detalle' => $detalle),true));
		$mpdf->Output();
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new OrdenTrabajo;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['OrdenTrabajo']))
		{
			$model->attributes=$_POST['OrdenTrabajo'];
			$model->FECHA_OT = date('Y-m-d');
			$model->USUARIO_CREADOR = Yii::app()->user->getState('identificador');
                        $model->APROBADO_I25=0;
			if($model->save())
			{
				Auditoria::model()->registrarAccion('OT', $model->ID_OT ,"contratista: ".$model->ID_CONTRATISTA.", solicita: ".$model->SOLICITANTE.", fecha: ".$model->FECHA_OT);
				$this->redirect(array('update','id'=>$model->ID_OT));
			}
		}

		$this->render('create',array( 'model'=>$model,));

	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);
		$new_sub_item = new InsumosOT;
		$sub_items = InsumosOT::model()->findAll(array('condition'=>'ID_OT='.$id, 'order'=>'NUMERO_SUB_ITEM'));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['OrdenTrabajo']) && isset($_POST['submit_ot']))
		{
			$model->attributes = $_POST['OrdenTrabajo'];
			if( $model->RECHAZAR_OT == 1 ){
				$model->USUARIO_RECHAZA = Yii::app()->user->getState('identificador');
			}
			if($model->save())
			{
				Auditoria::model()->registrarAccion('OT', $model->ID_OT ,"contratista: ".$model->ID_CONTRATISTA.", solicita: ".$model->SOLICITANTE.", fecha: ".$model->FECHA_OT);
				$this->redirect(array('view','id'=>$model->ID_OT));
			}
		}


		if(isset($_POST['InsumosOT']) && isset($_POST['sub_item_ot']))
		{
			$new_sub_item->attributes = $_POST['InsumosOT'];
			$new_sub_item->ID_OT = $id;
			if($new_sub_item->save())
				$this->redirect(array('update','id'=>$model->ID_OT));
		}


		$this->render('update',array(
			'model'=>$model,
			'new_sub_item'=>$new_sub_item,
			'sub_items'=>$sub_items,
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
		Auditoria::model()->registrarAccion('OT', $model->ID_OT ,"contratista: ".$model->ID_CONTRATISTA.", solicita: ".$model->SOLICITANTE.", fecha: ".$model->FECHA_OT);

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		$model->delete();
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('OrdenTrabajo');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$dataProviderDetalle=new CActiveDataProvider('InsumosOT');
	    $dataProviderDetalle->criteria = array('condition'=>'ID_OT=-1');

		if(Yii::app()->request->isAjaxRequest AND isset($_GET[0])){
	      // el update del CGridView hecho en Ajax produce un ajaxRequest sobre el mismo
	      $idOt = $_GET[0]; 
	      Yii::log("\nAJAX_REQUEST\nPROVOCADO_POR_EL_UPDATE_AL_CGRIDVIEW"
	        ."\nidInforme seleccionada es=".$idOt
	      ,"info");
	      // actualizas el criteria del data provider para ajustarlo a lo que se pide:
	      $dataProviderDetalle->criteria = array('condition'=>'ID_OT='.$idOt);
	      // para responderle al request ajax debes hacer un ECHO con el JSON del dataprovider
	      echo CJSON::encode($dataProviderDetalle);
	    }

		$model=new OrdenTrabajo('search');
		$model->unsetAttributes(); // clear any default values
		
		if(isset($_GET['OrdenTrabajo']))
			$model->attributes=$_GET['OrdenTrabajo'];

		$this->render('admin',array(
			'model'=>$model,
			'dP_detalle'=>$dataProviderDetalle,
		));
	}
      

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return OrdenTrabajo the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=OrdenTrabajo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function actionViewOt()
	{
		$id = $_POST['id_ot'];
		$model = $this->loadModel($id);
		//$model = $this->loadModel(18);
		//echo CJSON::encode($model);

		$iva = $model->APLICA_IVA==1?"Si":"No";
		$supervisor = $model->supervisor->NOMBRE_PERSONA;
		$tipo_ot = $model->tipo_de_ot->NOMBRE_TIPO_OT;
		$sql = "select NOMBRE_PERSONA from personal p inner join usuarios u on p.ID_PERSONA=u.ID_PERSONA where u.ID_USUARIO=".Yii::app()->user->getState('identificador');
		
		$aprJDP = "";
		if ($model->VOBO_JEFE_DPTO == 1) {
			$aprJDP = date("d-m-Y", strtotime($model->FECHA_VOBO_JDPTO))." ".$model->USUARIO_VOBO_JDPTO;
		}
		$aprADM = "";
		if ($model->VOBO_ADMIN == 1) {
			$aprADM = date("d-m-Y", strtotime($model->FECHA_VOBO_ADMIN))." ".$model->USUARIO_VOBO_ADMIN;
		}
		$aprGOP = "";
		if ($model->VOBO_GERENTE_OP == 1) {
			$aprGOP = date("d-m-Y", strtotime($model->FECHA_VOBO_GOP))." ".$model->USUARIO_VOBO_GOP;
		}
		$aprGG = "";
		if ($model->VOBO_GERENTE_GRAL == 1) {
			$aprGG = date("d-m-Y", strtotime($model->FECHA_VOBO_GG))." ".$model->USUARIO_VOBO_GG;
		}
		$p = Personal::model()->findBySql($sql);

		$t = '<div>'.
				'<b>Id Ot: </b>'.$model->ID_OT.'<br>'.
				'<b>Valor Moneda: </b>'.$model->VALOR_MONEDA.'<br>'.
				'<b>Tipo Ot: </b>'.$tipo_ot.'<br>'.
				'<b>Supervisor: </b>'.$supervisor.'<br>'.
				'<b>Fecha Ejecución: </b>'.date("d-m-Y", strtotime($model->FECHA_EJECUCION)).'<br>'.
				'<b>Aplica Iva: </b>'.$iva.'<br>'.
			//	'<b>Aprob. J: Dpto: </b>'.$p->NOMBRE_PERSONA." ".$aprJDP.'<br>'.
				'<b>Aprob. Adm.: </b>'.$aprADM.'<br>'.
				'<b>Aprob. G. Op.: </b>'.$aprGOP.'<br>'.
				'<b>Aprob. G. Gral.: </b>'.$aprGG.'<br>'.
			'</div>';
		echo CJSON::encode($t);
	}

//	public function actionAprobarOt(){
//		$id = $_POST['idOt'];
//		$model = $this->loadModel($id);
//		if (Yii::app()->user->JDP()) {
//			$model->VOBO_JEFE_DPTO = 1;
//			$model->FECHA_VOBO_JDPTO = date('Y-m-d'); 
//			$model->USUARIO_VOBO_JDPTO = Yii::app()->user->getState('idUsuario');
//		}elseif (Yii::app()->user->ADM()) {
//			$model->VOBO_ADMIN = 1;
//			$model->FECHA_VOBO_ADMIN = date('Y-m-d'); 
//			$model->USUARIO_VOBO_ADMIN = Yii::app()->user->getState('idUsuario');
//		}elseif (Yii::app()->user->GOP()) {
//			$model->VOBO_GERENTE_OP = 1;
//			$model->FECHA_VOBO_GOP = date('Y-m-d'); 
//			$model->USUARIO_VOBO_GOP = Yii::app()->user->getState('idUsuario');
//		}elseif (Yii::app()->user->GG()) {
//			$model->VOBO_GERENTE_GRAL = 1;
//			$model->FECHA_VOBO_GG = date('Y-m-d'); 
//			$model->USUARIO_VOBO_GG = Yii::app()->user->getState('idUsuario');
//		}
//               // $criteria= new CDbCriteria();
//               // $criteria->condition=
//              $insumos= InsumosOT::model()->findAllByAttributes(array('ID_OT'=>$id));
//                if($model->VOBO_JEFE_DPTO==1&&$model->VOBO_ADMIN==1){
//                    $total =0;
//                    foreach($insumos as $ins){
//                        $total+=$ins->COSTO_CONTRATISTA;
//                    }
//                    if ($total<=2500){
//                       $model->APROBADO_I25=1;
//                    }
//                        
//                }
//                    
//		if (Yii::app()->user->GG() || Yii::app()->user->GOP() || Yii::app()->user->ADM() || Yii::app()->user->JDP() ) {
//			if($model->save())
//                            echo true;
//			else
//                            echo false;
//		}
//		
//	}
	/**
	 * Performs the AJAX validation.
	 * @param OrdenTrabajo $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='orden-trabajo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionAprobarOT(){
        
        $orden = explode(',', $_POST['theIds']);
        if(!empty($_POST['theIds'])){

        
            foreach($orden as $ot){
               $model= OrdenTrabajo::model()->findByPk($ot);
               if(Yii::app()->user->JDP()) {
			$model->VOBO_JEFE_DPTO = 1;
			$model->FECHA_VOBO_JDPTO = date('Y-m-d'); 
			$model->USUARIO_VOBO_JDPTO = Yii::app()->user->getState('idUsuario');
		}elseif (Yii::app()->user->ADM()&&$model->VOBO_JEFE_DPTO==1) {
			$model->VOBO_ADMIN = 1;
			$model->FECHA_VOBO_ADMIN = date('Y-m-d'); 
			$model->USUARIO_VOBO_ADMIN = Yii::app()->user->getState('idUsuario');
		}elseif (Yii::app()->user->GOP()&&$model->VOBO_ADMIN==1) {
			$model->VOBO_GERENTE_OP = 1;
			$model->FECHA_VOBO_GOP = date('Y-m-d'); 
			$model->USUARIO_VOBO_GOP = Yii::app()->user->getState('idUsuario');
		}elseif (Yii::app()->user->GG()&&$model->VOBO_GERENTE_OP==1) {
			$model->VOBO_GERENTE_GRAL = 1;
			$model->FECHA_VOBO_GG = date('Y-m-d'); 
			$model->USUARIO_VOBO_GG = Yii::app()->user->getState('idUsuario');
		}
 //                  Yii::app()->user->setFlash('error',Yii::t('validation','Can not delete this item because it have elements asociated it'));
//                    $manifest->delete();
//                    $this->redirect(array('admin'));
                
               $model->save();
            }
    }
        $this->redirect(array('admin'));
    
        
    }
    
       public function actionCambiarPendiente(){
        
        $orden = explode(',', $_POST['theIds']);
        if(!empty($_POST['theIds'])){
            foreach($orden as $ot){
               $model= OrdenTrabajo::model()->findByPk($ot);
               if(Yii::app()->user->JDP()&&$model->VOBO_ADMIN!=1) {
			$model->VOBO_JEFE_DPTO = NULL;
			$model->FECHA_VOBO_JDPTO = NULL; 
			$model->USUARIO_VOBO_JDPTO = NULL;
		}elseif (Yii::app()->user->ADM()&&($model->VOBO_GERENTE_OP!=1)) {
			$model->VOBO_ADMIN = NULL;
			$model->FECHA_VOBO_ADMIN = NULL; 
			$model->USUARIO_VOBO_ADMIN = NULL;
		}elseif (Yii::app()->user->GOP()&&$model->VOBO_GERENTE_GRAL !=1) {
			$model->VOBO_GERENTE_OP = NULL;
			$model->FECHA_VOBO_GOP = NULL; 
			$model->USUARIO_VOBO_GOP = NULL;
		}elseif (Yii::app()->user->GG()) {
			$model->VOBO_GERENTE_GRAL = NULL;
			$model->FECHA_VOBO_GG = NULL; 
			$model->USUARIO_VOBO_GG = NULL;
		}
//                    Yii::app()->user->setFlash('error',Yii::t('validation','Can not delete this item because it have elements asociated it'));
//                    $manifest->delete();
//                    $this->redirect(array('admin'));   
               $model->save();
            }
    }
        $this->redirect(array('admin'));
    
        
    }


}
