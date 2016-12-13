<?php

/**
 * This is the model class for table "ticket_mensaje".
 *
 * The followings are the available columns in table 'ticket_mensaje':
 * @property integer $ID_TICKET_MENSAJE
 * @property string $TICKET_MENSAJE
 * @property integer $ID_TICKET
 * @property integer $ID_PERSONA_CREADOR
 * @property string $FECHA_MENSAJE
 *
 * The followings are the available model relations:
 * @property ArchivoTm[] $archivoTms
 * @property Asignacion[] $asignacions
 * @property Personal $iDPERSONACREADOR
 * @property Ticket $iDTICKET
 */
class TicketMensaje extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
        public $_verifyCode;
	public function tableName()
	{
		return 'ticket_mensaje';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TICKET_MENSAJE, ID_TICKET, ID_PERSONA_CREADOR, FECHA_MENSAJE', 'required','message'=>'Este Campo no puede estar en blanco'),
			array('ID_TICKET, ID_PERSONA_CREADOR', 'numerical', 'integerOnly'=>true),
                       array('_verifyCode', 'CaptchaExtendedValidator', 'allowEmpty' => !CCaptcha::checkRequirements()),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_TICKET_MENSAJE, TICKET_MENSAJE, ID_TICKET, ID_PERSONA_CREADOR, FECHA_MENSAJE', 'safe', 'on'=>'search'),
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
			'archivoTms' => array(self::HAS_MANY, 'ArchivoTm', 'ID_TICKET_MENSAJE'),
			'asignacions' => array(self::HAS_MANY, 'Asignacion', 'ID_TICKET_MENSAJE'),
			'iDPERSONACREADOR' => array(self::BELONGS_TO, 'Personal', 'ID_PERSONA_CREADOR'),
			'iDTICKET' => array(self::BELONGS_TO, 'Ticket', 'ID_TICKET'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_TICKET_MENSAJE' => 'Id Ticket Mensaje',
			'TICKET_MENSAJE' => 'Ticket Mensaje',
			'ID_TICKET' => 'Id Ticket',
			'ID_PERSONA_CREADOR' => 'Id Persona Creador',
			'FECHA_MENSAJE' => 'Fecha Mensaje',
                        '_verifyCode' => 'Codigo Verificación',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID_TICKET_MENSAJE',$this->ID_TICKET_MENSAJE);
		$criteria->compare('TICKET_MENSAJE',$this->TICKET_MENSAJE,true);
		$criteria->compare('ID_TICKET',$this->ID_TICKET);
		$criteria->compare('ID_PERSONA_CREADOR',$this->ID_PERSONA_CREADOR);
		$criteria->compare('FECHA_MENSAJE',$this->FECHA_MENSAJE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TicketMensaje the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
