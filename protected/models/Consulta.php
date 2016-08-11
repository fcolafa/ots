<?php

/**
 * This is the model class for table "consulta".
 *
 * The followings are the available columns in table 'consulta':
 * @property integer $ID_CONSULTA
 * @property string $CONSULTA
 * @property string $FECHA_CONSULTA
 * @property string $TIPO_MENSAJE
 * @property integer $ID_PERSONA
 * @property integer $ID_OT
 * @property integer $ID_CONSULTADO
 *
 * The followings are the available model relations:
 * @property Consulta $iDCONSULTADO
 * @property Consulta[] $consultas
 * @property OrdenTrabajo $iDOT
 * @property Personal $iDPERSONA
 */
class Consulta extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'consulta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(' CONSULTA, ID_PERSONA, ID_OT', 'required'),
			array('ID_CONSULTA, ID_PERSONA, ID_OT, ID_CONSULTADO', 'numerical', 'integerOnly'=>true),
			array('TIPO_MENSAJE', 'length', 'max'=>15),
			array('FECHA_CONSULTA', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_CONSULTA, CONSULTA, FECHA_CONSULTA, TIPO_MENSAJE, ID_PERSONA, ID_OT, ID_CONSULTADO', 'safe', 'on'=>'search'),
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
			'iDCONSULTADO' => array(self::BELONGS_TO, 'Consulta', 'ID_CONSULTADO'),
			'consultas' => array(self::HAS_MANY, 'Consulta', 'ID_CONSULTADO'),
			'iDOT' => array(self::BELONGS_TO, 'OrdenTrabajo', 'ID_OT'),
			'iDPERSONA' => array(self::BELONGS_TO, 'Personal', 'ID_PERSONA'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_CONSULTA' => 'Id Consulta',
			'CONSULTA' => 'Consulta',
			'FECHA_CONSULTA' => 'Fecha Consulta',
			'TIPO_MENSAJE' => 'Tipo Mensaje',
			'ID_PERSONA' => 'Id Persona',
			'ID_OT' => 'Id Ot',
			'ID_CONSULTADO' => 'Id Consultado',
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

		$criteria->compare('ID_CONSULTA',$this->ID_CONSULTA);
		$criteria->compare('CONSULTA',$this->CONSULTA,true);
		$criteria->compare('FECHA_CONSULTA',$this->FECHA_CONSULTA,true);
		$criteria->compare('TIPO_MENSAJE',$this->TIPO_MENSAJE,true);
		$criteria->compare('ID_PERSONA',$this->ID_PERSONA);
		$criteria->compare('ID_OT',$this->ID_OT);
		$criteria->compare('ID_CONSULTADO',$this->ID_CONSULTADO);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Consulta the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
