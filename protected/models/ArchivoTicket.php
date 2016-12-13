<?php

/**
 * This is the model class for table "archivo_ticket".
 *
 * The followings are the available columns in table 'archivo_ticket':
 * @property integer $ID_ARCHIVO_TICKET
 * @property string $NOMBRE_ARCHIVO
 * @property integer $ID_TICKET
 *
 * The followings are the available model relations:
 * @property Ticket $iDTICKET
 */
class ArchivoTicket extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'archivo_ticket';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NOMBRE_ARCHIVO, ID_TICKET', 'required'),
			array('ID_TICKET', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_ARCHIVO_TICKET, NOMBRE_ARCHIVO, ID_TICKET', 'safe', 'on'=>'search'),
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
			'iDTICKET' => array(self::BELONGS_TO, 'Ticket', 'ID_TICKET'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_ARCHIVO_TICKET' => 'Id Archivo Ticket',
			'NOMBRE_ARCHIVO' => 'Nombre Archivo',
			'ID_TICKET' => 'Id Ticket',
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

		$criteria->compare('ID_ARCHIVO_TICKET',$this->ID_ARCHIVO_TICKET);
		$criteria->compare('NOMBRE_ARCHIVO',$this->NOMBRE_ARCHIVO,true);
		$criteria->compare('ID_TICKET',$this->ID_TICKET);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ArchivoTicket the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
