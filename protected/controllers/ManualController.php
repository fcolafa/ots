<?php

class ManualController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index','creacionOt','aprobacion','creacionUsuario','contratistas','documentosContratista','recepcionDocumentos'), 
                'users' => array('*'),
            ),
            // deny all other actions
            array('deny',
                'users' => array('*'),
            ),
        );
    }

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	public function actionCreacionOt(){
		$this->renderPartial('creacionOt');	
	}

	public function actionAprobacion(){
		$this->renderPartial('aprobacion');	
	}

	public function actionCreacionUsuario(){
		$this->renderPartial('creacionUsuario');	
	}

	public function actionContratistas(){
		$this->renderPartial('contratistas');	
	}

	public function actionDocumentosContratista(){
		$this->renderPartial('documentosContratista');	
	}

	public function actionRecepcionDocumentos(){
		$this->renderPartial('recepcionDocumentos');	
	}
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}



}