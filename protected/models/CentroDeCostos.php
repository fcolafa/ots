<?php

/**
 * This is the model class for table "centro_de_costos".
 *
 * The followings are the available columns in table 'centro_de_costos':
 * @property integer $ID_CENTRO_COSTO
 * @property integer $ID_EMPRESA
 * @property integer $ID_CLIENTE
 * @property integer $NUMERO_CENTRO
 * @property string $NOMBRE_CENTRO_COSTO
 * @property string $DESCRIPCION_CENTRO_COSTO
 *
 * The followings are the available model relations:
 * @property Empresa $iDEMPRESA
 * @property InsumosOt[] $insumosOts
 */
class CentroDeCostos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'centro_de_costos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_EMPRESA, NUMERO_CENTRO, NOMBRE_CENTRO_COSTO', 'required'),
			array('ID_EMPRESA, ID_CLIENTE, NUMERO_CENTRO', 'numerical', 'integerOnly'=>true),
			array('NOMBRE_CENTRO_COSTO', 'length', 'max'=>250),
			array('DESCRIPCION_CENTRO_COSTO', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_CENTRO_COSTO, ID_EMPRESA, ID_CLIENTE, NUMERO_CENTRO, NOMBRE_CENTRO_COSTO, DESCRIPCION_CENTRO_COSTO', 'safe', 'on'=>'search'),
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
			'iDEMPRESA' => array(self::BELONGS_TO, 'Empresa', 'ID_EMPRESA'),
			'insumosOts' => array(self::HAS_MANY, 'InsumosOt', 'ID_CENTRO_COSTO'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_CENTRO_COSTO' => 'Id Centro Costo',
			'ID_EMPRESA' => 'Empresa',
			'ID_CLIENTE' => 'Cliente',
			'NUMERO_CENTRO' => 'Numero',
			'NOMBRE_CENTRO_COSTO' => 'Nombre',
			'DESCRIPCION_CENTRO_COSTO' => 'Descripcion',
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

		$criteria->compare('ID_CENTRO_COSTO',$this->ID_CENTRO_COSTO);
		$criteria->compare('ID_EMPRESA',$this->ID_EMPRESA);
		$criteria->compare('ID_CLIENTE',$this->ID_CLIENTE);
		$criteria->compare('NUMERO_CENTRO',$this->NUMERO_CENTRO);
		$criteria->compare('NOMBRE_CENTRO_COSTO',$this->NOMBRE_CENTRO_COSTO,true);
		$criteria->compare('DESCRIPCION_CENTRO_COSTO',$this->DESCRIPCION_CENTRO_COSTO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CentroDeCostos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
