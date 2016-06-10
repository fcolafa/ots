<?php

class SiteController extends Controller
{

	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('orderInformation'),
				'expression'=>'$user->A1()',
			),
		);
	}
	/**
	 * Declares class-based actions.
	 */

	//public $layout = '/layouts/column2';
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
         public function getNumberOT(){
            $model=new OrdenTrabajo('search');
            $number=count($model->search());
            return $number;
        }      


	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// $pres = $this->obtainPto();
		// $cc = $this->obtainCC();
		// $dolar = $this->obtainDolar();
            
		$this->render('index');
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

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				//$this->redirect(Yii::app()->user->returnUrl);
				$this->redirect(array('site/index/'));
		}
                if(!Yii::app()->user->isGuest){
                        $this->redirect(array('site/index/'));
                }
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		Yii::app()->getSession()->remove('empresa_usuario');
		$this->redirect(Yii::app()->homeUrl);
	}


	private function obtainDolar()
	{
		/* Obtiene información para la tabla de Presupuestos */
		$sql = 'SELECT * FROM presupuesto where VALOR_DOLAR IS NULL OR VALOR_DOLAR = 0';
		$pptos = Presupuesto::model()->findAllBySql($sql);

      $newPres = array();
      $count = 0;

        if(!empty($pptos))
        {
            $dataProvider=new CArrayDataProvider($pptos, array(
                'id'=>'dolar-provider',
                'pagination'=>array(
                    'pageSize'=>10,
                ),
            ));
        
		   		foreach ($pptos as $key)
		   		{
		        	$cliente = EmpresaPresupuesto::model()->findByPk($key->RUT_EMPRESA_PRESUPUESTO);
		        	if (count($cliente) > 0) $cliente = $cliente->NOMBRE_EMPRESA_PRESUPUESTO; else $cliente="";
		        	$newPres[$count] = array('ID'=>$key->ID_PRESUPUESTO,'Numero'=>$key->NUMERO_PRESUPUESTO, 'Nombre'=>$key->NOMBRE_PRESUPUESTO,'Cliente'=>$cliente);
		        	$count++;
		      }
		    }
        return $newPres;
	}


	private function obtainPto()
	{
		//$meses = array(1=>'Ene',2=>'Feb',3=>'Mar',4=>'Abr',5=>'May',6=>'Jun',7=>'Jul',8=>'Ago',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dic');
		$meses = array(1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre');

		/* Obtiene información para la tabla de Presupuestos */
		$sql = 'SELECT p.ID_PRESUPUESTO, p.NUMERO_PRESUPUESTO, p.NOMBRE_PRESUPUESTO, p.RUT_EMPRESA_PRESUPUESTO, p.FECHA, c.COSTO_TOTAL AS VALOR_DOLAR FROM presupuesto p LEFT JOIN presupuesto_costo_total c ON p.ID_PRESUPUESTO = c.ID_PRESUPUESTO ORDER BY FECHA DESC LIMIT 0 , 10;';
    $pptos = Presupuesto::model()->findAllBySql($sql);
      if(!empty($pptos))
      {
          $dataProvider=new CArrayDataProvider($pptos, array(
              'id'=>'pres-provider',
              'pagination'=>array(
                  'pageSize'=>10,
              ),
          ));
      }
      $newPres = array();
      $count = 0;

   		foreach ($pptos as $key)
   		{
        	if(!empty($key->VALOR_DOLAR) && ($key->VALOR_DOLAR > 0 ))
        	{
        		$costo = number_format($key->VALOR_DOLAR, 0, ",", ".");
        	}
        	else
        		$costo = 0;

   			$mes = substr($key->FECHA, 5, 2)+0;
   			$fecha = ltrim(substr($key->FECHA, 8),'0')." ".$meses[$mes]." ".substr($key->FECHA, 0, 4);
        $cliente = $key->rUTEMPPRESUPUESTO->NOMBRE_EMPRESA_PRESUPUESTO;
        
        	$newPres[$count] = array('ID'=>$key->ID_PRESUPUESTO,'Numero'=>$key->NUMERO_PRESUPUESTO, 'Nombre'=>$key->NOMBRE_PRESUPUESTO,'Cliente'=>$cliente,'Fecha'=>$fecha,'Costo'=>$costo);
        	$count++;
      }
      return $newPres;
	}

	private function obtainCC()
	{
		$meses = array(1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre');

		/* Obtiene información para la tabla de Centro de Costos */
		$sql = 'SELECT * FROM centro_de_costos ORDER BY ID_CENTRO_COSTO DESC LIMIT 0 , 10;';
        $rawData=Yii::app()->db->createCommand($sql)->queryAll();
        if(!empty($rawData))
        {
            $dataProvider=new CArrayDataProvider($rawData, array(
                'id'=>'cc-provider',
                'pagination'=>array(
                    'pageSize'=>10,
                ),
            ));
        }
        $newCC = array();
        $count = 0;
   		foreach ($dataProvider->rawData as $key => $value)
   		{
   			/* Busqueda del Costo */
   			$sql1 = 'SELECT ID_CENTRO_COSTO, COSTO_TOTAL FROM centro_de_costos_costo_total WHERE ID_CENTRO_COSTO = '.$dataProvider->rawData[$key]['ID_CENTRO_COSTO'].';';
        	$rawData1=Yii::app()->db->createCommand($sql1)->queryAll();
        	if(!empty($rawData1))
        	{
        		$dataProvider1 = new CArrayDataProvider($rawData1);

        		$costo = number_format($dataProvider1->rawData[0]['COSTO_TOTAL'], 0, ",", ".");
        	}
        	else
   				$costo = 0;
        	$cliente = EmpresaPresupuesto::model()->findByPk($dataProvider->rawData[$key]['ID_CLIENTE']);
        	if (count($cliente) > 0) $cliente = $cliente->NOMBRE_EMPRESA_PRESUPUESTO; else $cliente = "";
        	$newCC[$count] = array('ID'=>$dataProvider->rawData[$key]['ID_CENTRO_COSTO'],'Nombre'=>$dataProvider->rawData[$key]['NOMBRE_CENTRO_COSTO'],'Cliente'=>$cliente,'Costo'=>$costo);
        	$count++;
        }
        return $newCC;
	}
}