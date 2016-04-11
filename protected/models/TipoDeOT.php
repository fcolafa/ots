<?php

/**
 * This is the model class for table "tipo_de_ot".
 *
 * The followings are the available columns in table 'tipo_de_ot':
 * @property integer $ID_TIPO_OT
 * @property string $NOMBRE_TIPO_OT
 * @property string $DESCRIPCION_TIPO_OP
 *
 * The followings are the available model relations:
 * @property OrdenTrabajo[] $ordenTrabajos
 */
class TipoDeOT extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tipo_de_ot';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_TIPO_OT, NOMBRE_TIPO_OT', 'required'),
			array('ID_TIPO_OT', 'numerical', 'integerOnly'=>true),
			array('NOMBRE_TIPO_OT', 'length', 'max'=>20),
			array('DESCRIPCION_TIPO_OP', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_TIPO_OT, NOMBRE_TIPO_OT, DESCRIPCION_TIPO_OP', 'safe', 'on'=>'search'),
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
			'ordenTrabajos' => array(self::HAS_MANY, 'OrdenTrabajo', 'ID_TIPO_OT'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_TIPO_OT' => 'Id Tipo Ot',
			'NOMBRE_TIPO_OT' => 'Nombre Tipo Ot',
			'DESCRIPCION_TIPO_OP' => 'Descripcion Tipo Op',
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

		$criteria->compare('ID_TIPO_OT',$this->ID_TIPO_OT);
		$criteria->compare('NOMBRE_TIPO_OT',$this->NOMBRE_TIPO_OT,true);
		$criteria->compare('DESCRIPCION_TIPO_OP',$this->DESCRIPCION_TIPO_OP,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TipoDeOT the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
