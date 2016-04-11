<?php

/**
 * This is the model class for table "auditoria".
 *
 * The followings are the available columns in table 'auditoria':
 * @property integer $ID_AUDITORIA
 * @property string $FECHA_AUDITORIA
 * @property string $USUARIO_AUDITORIA
 * @property string $ACCION_AUDITORIA
 * @property string $CONTROLADOR_AUDITORIA
 * @property string $TIPO_DOCUMENTO_AUDITORIA
 * @property integer $NRO_DOCUMENTO_AUDITORIA
 * @property string $DETALLE_AUDITORIA
 *
 * The followings are the available model relations:
 * @property Usuarios $uSUARIOAUDITORIA
 */
class Auditoria extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'auditoria';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('USUARIO_AUDITORIA', 'required'),
			array('NRO_DOCUMENTO_AUDITORIA', 'numerical', 'integerOnly'=>true),
			array('ACCION_AUDITORIA, CONTROLADOR_AUDITORIA, USUARIO_AUDITORIA', 'length', 'max'=>20),
			array('TIPO_DOCUMENTO_AUDITORIA', 'length', 'max'=>5),
			array('DETALLE_AUDITORIA', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_AUDITORIA, FECHA_AUDITORIA, USUARIO_AUDITORIA, ACCION_AUDITORIA, CONTROLADOR_AUDITORIA, TIPO_DOCUMENTO_AUDITORIA, NRO_DOCUMENTO_AUDITORIA, DETALLE_AUDITORIA', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'uSUARIOAUDITORIA' => array(self::BELONGS_TO, 'Usuarios', 'USUARIO_AUDITORIA'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_AUDITORIA' => 'Id Auditoria',
			'FECHA_AUDITORIA' => 'Fecha Auditoria',
			'USUARIO_AUDITORIA' => 'Usuario Auditoria',
			'ACCION_AUDITORIA' => 'Accion Auditoria',
			'CONTROLADOR_AUDITORIA' => 'Controlador Auditoria',
			'TIPO_DOCUMENTO_AUDITORIA' => 'Tipo Documento Auditoria',
			'NRO_DOCUMENTO_AUDITORIA' => 'Nro Documento Auditoria',
			'DETALLE_AUDITORIA' => 'Detalle Auditoria',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */


	public function registrarAccion($tipo, $numero, $detalle)
	{
		$registro = new Auditoria;
		$registro->USUARIO_AUDITORIA = Yii::app()->user->name;
		$registro->ACCION_AUDITORIA = Yii::app()->controller->action->id;
		$registro->CONTROLADOR_AUDITORIA = Yii::app()->controller->id;
		$registro->TIPO_DOCUMENTO_AUDITORIA = $tipo;
		$registro->NRO_DOCUMENTO_AUDITORIA = $numero;
		$registro->DETALLE_AUDITORIA = $detalle;
		if($registro->save()){
		}else{
			Yii::log("error al registrar auditoria=".Yii::app()->user->name."-".Yii::app()->controller->action->id."-".Yii::app()->controller->id."-".$tipo."-".$numero."-".$detalle ,"warning");
		}
	}


	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID_AUDITORIA',$this->ID_AUDITORIA);
		$criteria->compare('FECHA_AUDITORIA',$this->FECHA_AUDITORIA,true);
		$criteria->compare('USUARIO_AUDITORIA',$this->USUARIO_AUDITORIA,true);
		$criteria->compare('ACCION_AUDITORIA',$this->ACCION_AUDITORIA,true);
		$criteria->compare('CONTROLADOR_AUDITORIA',$this->CONTROLADOR_AUDITORIA,true);
		$criteria->compare('TIPO_DOCUMENTO_AUDITORIA',$this->TIPO_DOCUMENTO_AUDITORIA,true);
		$criteria->compare('NRO_DOCUMENTO_AUDITORIA',$this->NRO_DOCUMENTO_AUDITORIA);
		$criteria->compare('DETALLE_AUDITORIA',$this->DETALLE_AUDITORIA,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Auditoria the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


// Envia correos de aviso por eventos importantes del sistema
	//Auditoria::enviarMail($name, $subject);
	public function enviarMail($name, $subject)
	{
		$ok = true;

		$correo = Usuario::model()->findByAttributes(array('NOMBRE_USUARIO'=>$name));
		if(!is_null($correo->CORREO)){
			$mail=Yii::app()->Smtpmail;
			$mail->SMTPDebug = 2;
			$mail->SetFrom('sistemahys@pcgeek.cl', 'Sistema Web HyS');//pass: sistema
			$mail->Subject = $subject;
			$mail->MsgHTML(Yii::app()->controller->renderPartial('render', array(),true));
			//$mail->Body = $this->renderPartial('view', array('model' => $model), true);
			//$mail->Body = $mess;

			$mail->AddAddress($correo->CORREO, $name);
		}

    if(!$mail->Send()) {
        die ("Mailer Error: " . $mail->ErrorInfo);
    }else {
        die ( "Message sent!");
    }


		/*Yii::import('ext.PHPMailer.*');

			$mail = new PHPMailer(true);
			$mail->IsSMTP(); 
			try {

				$mail->Host = 'localhost';				
				$mail->SMTPDebug = 2;
				$mail->SMTPAuth = true;	
				$mail->SMTPSecure = 'SSL';	 //tsl
				$mail->Host = 'smtp.gmail.com';
				$mail->Port = '465';				//569
				$mail->Username = 'dalvarado@pcgeek.cl';
				$mail->Password = 'gastongay';

				$mail->SetFrom('dalvarado@pcgeek.cl', 'Danielillo');
				$mail->Subject = 'Mensaje de prueba';
				$mail->AltBody = 'vea este msge en un visor de correo';
				$mail->MsgHTML('<h1>Esto es un test</h1>');
				$mail->AddAddress('tucorreo@gmail.com', 'Daniel San');
				$mail->Send();
    		die("Mensaje enviado");
    	} catch (PHPMailerException $e) {
    		die ($e->errorMessage());
    	} catch (Exception $e) {
    		die ($e->getMessage());
    	}
			die("xao");*/



/*		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf8_bin"; 
		$headers .= "From: dalvarado@pcgeek.cl\r\n"; 

		$para = 'informatico.alvarado@gmail.com';
		$asunto = 'Información sistema web';
		$mensaje = '<h2> Este es un ejemplo</h2>';

		if (mail($para, $asunto, $mensaje, $headers))
		die("okis"); else die("dokis");*/

		return $ok;

	}

}
