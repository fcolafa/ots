<?php

class PersonalController extends Controller
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete','index','view','viewPersonal','updatePersonal'),
				'expression'=>'$user->A1() || $user->JDP()',
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
	public function actionViewPersonal($id)
	{
		$this->render('viewPersonal',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Personal;
		$usuario = new Usuarios;
		$nivelAprov = new NivelAprobacion;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Personal'], $_POST['Usuarios'], $_POST['NivelAprobacion'] ) )
		{
			$model->attributes=$_POST['Personal'];
			$usuario->attributes=$_POST['Usuarios'];
		 	$nivelAprov->attributes=$_POST['NivelAprobacion'];

		 	$valid = $model->validate();
		 	$valid = ( $model->ES_USUARIO==1 )? $usuario->validate(): $valid;
		 	$valid = ( $model->APRUEBA_DOCS==1 )? $nivelAprov->validate(): $valid;

			if( $valid )
			{	
				$model->save();
				if ($model->ES_USUARIO==1) {
					$usuario->ID_PERSONA = $model->ID_PERSONA;
					$usuario->CONTRASENA = md5($usuario->CONTRASENA);
					$usuario->ID_EMPRESA = $model->ID_EMPRESA;
					$usuario->save();
				}
				if ($model->APRUEBA_DOCS==1 ) {
					$nivelAprov->save();
					$usuario_aprobacion = new UsuarioAprobacion;
					$usuario_aprobacion->ID_USUARIO = $usuario->ID_USUARIO;
					$usuario_aprobacion->ID_NIVEL_APROB = $nivelAprov->ID_NIVEL_APROB;
					$usuario_aprobacion->save();
				}
				$this->redirect(array('view','id'=>$model->ID_PERSONA));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'usuario'=>$usuario,
			'aprovacion'=>$nivelAprov,
		));
	}
        public function actionUpdatePersonal($id){
           
        
             $model= $this->loadModel($id);
             if(Yii::app()->user->id!=$id)
                       throw new CHttpException(404, 'Usted no esta autorizado para realizar esta acción.');
            if(isset($_POST['Personal'])){
                $model->attributes=$_POST['Personal'];
                if($model->save())
                    $this->redirect(array('viewPersonal','id'=>$model->ID_PERSONA));
                    
            }
            $this->render('updatePersonal',array(
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
		$model = $this->loadModel($id);
		$usuario = ($model->ES_USUARIO)? Usuarios::model()->findByAttributes(array('ID_PERSONA'=>$id)): new Usuarios;
		$nivelAprob = new NivelAprobacion;
		$aprobados	= array();
		if ($model->APRUEBA_DOCS) {
			$sql = "SELECT * FROM (usuario_aprobacion ua INNER JOIN nivel_aprobacion na ON ua.ID_NIVEL_APROB=na.ID_NIVEL_APROB) INNER JOIN tipo_documento td ON na.ID_TIPO_DOC=td.ID_TIPO_DOC where ua.ID_USUARIO=".$usuario->ID_USUARIO;
			$aprobados	= NivelAprobacion::model()->findAllBySql($sql);
		}
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Personal'], $_POST['Usuarios'], $_POST['NivelAprobacion']) && isset($_POST['modificar_personal']))
		{		
			$model->attributes=$_POST['Personal'];
			$usuario->attributes=$_POST['Usuarios'];
		 	$nivelAprov->attributes=$_POST['NivelAprobacion'];

		 	$valid = $model->validate();
		 	$valid = ( $model->ES_USUARIO==1 )? $usuario->validate(): $valid;
		 	$valid = ( $model->APRUEBA_DOCS==1 )? $nivelAprov->validate(): $valid;

			if( $valid )
			{	
				$model->save();
				if ($model->ES_USUARIO==1) {
					$pwd = $usuario->CONTRASENA;
					if(isset($usuario->CONTRASENA) && ($usuario->CONTRASENA != '')){
						$md5Pass = md5($usuario->CONTRASENA);
						$usuario->CONTRASENA = $md5Pass;
					}else{
						$usuario->CONTRASENA = $pwd;
					}
					$usuario->ID_PERSONA = $model->ID_PERSONA;
					$usuario->CONTRASENA = md5($usuario->CONTRASENA);
					$usuario->save();
				}
				if ($model->APRUEBA_DOCS==1 ) {
					$nivelAprov->save();
					$usuario_aprobacion = new UsuarioAprobacion;
					$usuario_aprobacion->ID_USUARIO = $usuario->ID_USUARIO;
					$usuario_aprobacion->ID_NIVEL_APROB = $nivelAprov->ID_NIVEL_APROB;
					$usuario_aprobacion->save();
				}
				$this->redirect(array('view','id'=>$model->ID_PERSONA));
			}
		}	

		if (isset($_POST['NivelAprobacion']) && isset($_POST['nuevo_documento'])) {
			$ap = new NivelAprobacion;
		 	$ap->attributes=$_POST['NivelAprobacion'];

			if($ap->validate()){
				$ap->save();
				$usuario_aprobacion = new UsuarioAprobacion;
				$usuario_aprobacion->ID_USUARIO = $usuario->ID_USUARIO;
				$usuario_aprobacion->ID_NIVEL_APROB = $ap->ID_NIVEL_APROB;
				$usuario_aprobacion->save();
			}
			$this->redirect(array('update','id'=>$model->ID_PERSONA));
		}		

		if ($usuario != null) {
			$usuario->CONTRASENA = "";
		}

		$this->render('update',array(
			'model'=>$model,
			'usuario'=>$usuario,
			'aprovacion'=>$nivelAprob,
			'aprobados'=>$aprobados,
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
		Auditoria::model()->registrarAccion('', $model->ID_PERSONA , $model->NOMBRE_PERSONA);
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
		$dataProvider=new CActiveDataProvider('Personal');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Personal('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Personal']))
			$model->attributes=$_GET['Personal'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Personal the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Personal::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Personal $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='personal-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
 