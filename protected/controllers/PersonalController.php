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
				'actions'=>array('create','update','admin','delete','index','view','viewPersonal','updatePersonal','upload','resetPersonal'),
				'expression'=>'$user->A1()',
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('viewPersonal'),
				'users'=>array('@'),
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
            if(Yii::app()->user->id!=$id)
                      throw new CHttpException(404, 'Usted no esta autorizado para realizar esta acción.');
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

		if(isset($_POST['Personal']) )
		{
			$model->attributes=$_POST['Personal'];
                        $model->_firma=CUploadedFile::getInstance($model,'_firma');
                        if(isset($_POST['Personal']['_firma']))
                            $model->_firma=$_POST['Personal']['_firma'];
                        $valid = $model->validate();
                        if(isset($_POST['Usuarios'])){
                            $usuario->attributes=$_POST['Usuarios'];
                            $valid = ( $model->ES_USUARIO==1 )? $usuario->validate(): $valid;
                        }
			//$usuario->setScenario('creacion');
                        if(isset($_POST['NivelAprobacion'])){
                            $nivelAprov->attributes=$_POST['NivelAprobacion'];		 	
                            $valid = ( $model->APRUEBA_DOCS==1 )? $nivelAprov->validate(): $valid;
                        }
				
				if($model->save()){
                                   
                                  $tempFolder=Yii::getPathOfAlias('webroot').'/archivos/temp/firmas/'; 
                                  if(!file_exists($tempFolder))
                                    mkdir($tempFolder,0777,true); 
                                    $newFolder=Yii::getPathOfAlias('webroot').'/archivos/firmas/'; 
                                    $file=$model->_firma;
                                  if(!empty($file)){
                                    $perfile=  $this->loadModel($model->ID_PERSONA);
                                    $info = pathinfo($tempFolder.$model->_firma);
                                    $ext = $info['extension'];
                                    $perfile->URL_FIRMA=$model->ID_PERSONA.'.'.$ext;
                                    if($perfile->save(false))
                                    copy($tempFolder.$model->_firma,$newFolder.$model->ID_PERSONA.'.'.$ext); 
                                  }
                                 
                             
                                  Auditoria::model()->registrarAccion('', null ,"Nueva persona: ".$model->RUT_PERSONA.", Es usuario: ".$model->ES_USUARIO.", Aprueba Docs: ".$model->APRUEBA_DOCS);
				if ($model->APRUEBA_DOCS==1 ) {
					$nivelAprov->save();
					$usuario_aprobacion = new UsuarioAprobacion;
					$usuario_aprobacion->ID_USUARIO = $usuario->ID_USUARIO;
					$usuario_aprobacion->ID_NIVEL_APROB = $nivelAprov->ID_NIVEL_APROB;
					$usuario_aprobacion->save();
                                }
                                if ($model->ES_USUARIO==1) {
					$usuario->ID_PERSONA = $model->ID_PERSONA;
					$pass=$this->generatePass();
                                        $usuario->_PASSANTIGUA = md5($pass);
                                        $usuario->CONTRASENA = md5($pass);
                                        $usuario->_RPT_CONTRASENA = md5($pass);
                                        $usuario->FECHA_CREACION_USUARIO= date("y/m/d H:i:s");
                                        $usuario->PRIMER_LOGIN=1;
					$usuario->ID_EMPRESA = $model->ID_EMPRESA;
					if($usuario->save()){
                                            $this->sendMail($usuario,$pass,$model->EMAIL);
                                       
                                       
                                        }
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
    public function actionResetPersonal($id){
        $personal=  $this->loadModel($id);
        $criteria=new CDbCriteria();
        $criteria->condition="ID_PERSONA=".$personal->ID_PERSONA;
        $usuario= Usuarios::model()->find($criteria);
        if($usuario){
            $pass=$this->generatePass();
            $usuario->CONTRASENA = md5($pass);
            if($usuario->save()){
                $this->sendMail($usuario,$pass,$personal->EMAIL);
            //$usuario->_RPT_CONTRASENA = md5($pass);
            }
        
        } 
        $this->redirect(array('view','id'=>$personal->ID_PERSONA));
    }    
    public function actionUpdatePersonal($id){
            $model= $this->loadModel($id);
            $criteria = new CDbCriteria;  
            $criteria->condition ='ID_PERSONA='.$id;
            $usuario=  Usuarios::model()->find($criteria);
            $usuario->scenario = 'updPersonal';    
             if(Yii::app()->user->id!=$id)
                       throw new CHttpException(404, 'Usted no esta autorizado para realizar esta acción.');
                $usuario->_PASSANTIGUA ='';
                $usuario->CONTRASENA ='';
                $usuario->_RPT_CONTRASENA ='';
                
            if(isset($_POST['Personal'],$_POST['Usuarios'])){
                $model->attributes=$_POST['Personal'];
                $usuario->attributes=$_POST['Usuarios'];
                if(isset($_POST['Personal']['_firma']))
                        $model->_firma=$_POST['Personal']['_firma'];
                 
                
                if ($model->ES_USUARIO==1 && $usuario->validate()) {
                    if(!empty($usuario->CONTRASENA) && ($usuario->CONTRASENA != '')){
                            $md5Pass = md5($usuario->CONTRASENA);
                            $usuario->CONTRASENA = $md5Pass;
                    }
                            $usuario->ID_PERSONA = $model->ID_PERSONA;
					//$usuario->CONTRASENA = md5($usuario->CONTRASENA);
			$usuario->save();		
                    }
                                
                    $tempFolder=Yii::getPathOfAlias('webroot').'/archivos/temp/firmas/'; 
                    if(!file_exists($tempFolder))
                        mkdir($tempFolder,0777,true); 
                    $newFolder=Yii::getPathOfAlias('webroot').'/archivos/firmas/'; 
                     $file=$model->_firma;
                                  if(!empty($file)){
                                    $info = pathinfo($tempFolder.$model->_firma);
                                    $ext = $info['extension'];
                                    $model->URL_FIRMA=$id.'.'.$ext;
                                    copy($tempFolder.$model->_firma,$newFolder.$id.'.'.$ext); 
                                  }
                                  
                if($model->save()){          
                    $this->redirect(array('viewPersonal','id'=>$model->ID_PERSONA));
                }
                
                $usuario->_PASSANTIGUA ='';
                $usuario->CONTRASENA ='';
                $usuario->_RPT_CONTRASENA ='';
                
            }
            $this->render('updatePersonal',array(
			'model'=>$model,
                        'usuario'=>$usuario,
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
		if ($model->ES_USUARIO) {
			if ($model->APRUEBA_DOCS) {
				$sql = "SELECT * FROM (usuario_aprobacion ua INNER JOIN nivel_aprobacion na ON ua.ID_NIVEL_APROB=na.ID_NIVEL_APROB) INNER JOIN tipo_documento td ON na.ID_TIPO_DOC=td.ID_TIPO_DOC where ua.ID_USUARIO=".$usuario->ID_USUARIO;
				$aprobados	= NivelAprobacion::model()->findAllBySql($sql);
			}
		}
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Personal'], $_POST['Usuarios'], $_POST['NivelAprobacion']) && isset($_POST['modificar_personal']))
		{		
			$model->attributes=$_POST['Personal'];
			$pwd = $usuario->CONTRASENA;
			$usuario->attributes=$_POST['Usuarios'];
			//die(print_r($pwd."  ".$usuario->CONTRASENA));
			$usuario->setScenario('actualizacion');
		 	$nivelAprov->attributes=$_POST['NivelAprobacion'];

		 	$valid = $model->validate();
		 	$valid = ( $model->ES_USUARIO==1 )? $usuario->validate(): $valid;
		 	//$valid = ( $model->APRUEBA_DOCS==1 )? $nivelAprov->validate(): $valid;

			if( $valid )
			{	
				$model->save();
				Auditoria::model()->registrarAccion('', null ,"Nueva persona: ".$model->RUT_PERSONA.", Es usuario: ".$model->ES_USUARIO.", Aprueba Docs: ".$model->APRUEBA_DOCS);
				if ($model->ES_USUARIO==1) {
					if(isset($usuario->CONTRASENA) && ($usuario->CONTRASENA != '')){
						$md5Pass = md5($usuario->CONTRASENA);
						$usuario->CONTRASENA = $md5Pass;
					}else {
						$usuario->CONTRASENA = $pwd;
					}
					$usuario->ID_PERSONA = $model->ID_PERSONA;
					//$usuario->CONTRASENA = md5($usuario->CONTRASENA);
					$usuario->save();
				}
				/*if ($model->APRUEBA_DOCS==1 ) {
					$nivelAprov->save();
					$usuario_aprobacion = new UsuarioAprobacion;
					$usuario_aprobacion->ID_USUARIO = $usuario->ID_USUARIO;
					$usuario_aprobacion->ID_NIVEL_APROB = $nivelAprov->ID_NIVEL_APROB;
					$usuario_aprobacion->save();
				}*/
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
		$user_creador = OrdenTrabajo::model()->findByAttributes(array('USUARIO_CREADOR'=>$id));
		$solicitante = OrdenTrabajo::model()->findByAttributes(array('SOLICITANTE'=>$id));
		$supervisor = OrdenTrabajo::model()->findByAttributes(array('SUPERVISOR'=>$id));
		$usuario = Usuarios::model()->findByAttributes(array('ID_PERSONA'=>$id));

		$msg ="No se pudo eliminar ya que está se encuentra como ";

		if (count($user_creador) > 0) {
			$msg.= "creador de una Ot ";
		}elseif (count($solicitante) > 0) {
			$msg.= "solicitante de una Ot ";
		}elseif (count($supervisor) > 0) {
			$msg.= "supervisor de una Ot";
		}elseif (count($usuario) > 0){
			$msg.= "usuario en el sistema";
		}
		
		try{
			$this->loadModel($id)->delete();
			Auditoria::model()->registrarAccion('', $model->ID_PERSONA , "Se elimina persona ".$model->NOMBRE_PERSONA);
			if(!isset($_GET['ajax']))
		        Yii::app()->user->setFlash('success','Persona eliminada correctamente');
		    else
		        echo "<div class='alert alert-success'>Persona eliminada correctamente</div>";
		}catch(CDbException $e){
		    if(!isset($_GET['ajax']))
		        Yii::app()->user->setFlash('error',$msg);
		    else
		        echo "<div class='alert alert-danger'>".$msg."</div>";
		}

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
        private function sendMail($model, $pass,$email)
	{
	
                $mail=Yii::app()->Smtpmail;
                $mail->SMTPDebug = 2;
                $mail->CharSet = 'UTF-8';
                $mail->SetFrom('desarollo@pcgeek.cl', 'Sistema Aprobación de Documentos');
                $mail->Subject = 'Datos de Cuenta';
                $mail->MsgHTML(Yii::app()->controller->renderPartial('body', array('model'=>$model,'pass'=>$pass,'email'=>$email),true));
                $mail->AddAddress($email, 'Test');
                if(!$mail->Send()) {
                    Yii::app()->user->setFlash('error',Yii::t('validation','Error al enviar correo Electronico'));
                }else {
                    Yii::app()->user->setFlash('success',Yii::t('validation','Datos de usuario enviados por correo Electronico'));
                } 
	}
          private function generatePass(){
            $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
            $pass = "";
            for($i=0;$i<8;$i++) {
            $pass .= substr($str,rand(0,62),1);
            }
            return $pass;
          }
             public function actionUpload()
            {
                $tempFolder=Yii::getPathOfAlias('webroot').'/archivos/temp/firmas/';         
                Yii::import("ext.EFineUploader.qqFileUploader");
                $uploader = new qqFileUploader();
                $uploader->allowedExtensions = array('pdf','jpg','jpeg','png');
                $uploader->sizeLimit = 5 * 1024 * 1024;//maximum file size in bytes
                $uploader->chunksFolder = $tempFolder;
                $result = $uploader->handleUpload($tempFolder);
                $result['filename'] = $uploader->getUploadName();
                $result['folder'] = $tempFolder;
                $uploadedFile=$tempFolder.$result['filename'];
                header("Content-Type: text/plain");
                $result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
                echo $result;
                Yii::app()->end();
            }
}
 