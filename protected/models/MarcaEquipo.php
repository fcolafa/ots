<?php

/**
 * This is the model class for table "marca_equipo".
 *
 * The followings are the available columns in table 'marca_equipo':
 * @property integer $ID_MARCA_EQUIPO
 * @property string $NOMBRE_MARCA_EQUIPO
 *
 * The followings are the available model relations:
 * @property ModelEquipo[] $modelEquipos
 */
class MarcaEquipo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'marca_equipo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NOMBRE_MARCA_EQUIPO', 'required'),
			array('NOMBRE_MARCA_EQUIPO', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_MARCA_EQUIPO, NOMBRE_MARCA_EQUIPO', 'safe', 'on'=>'search'),
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
			'modelEquipos' => array(self::HAS_MANY, 'ModelEquipo', 'ID_MARCA_EQUIPO'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_MARCA_EQUIPO' => 'Id Marca Equipo',
			'NOMBRE_MARCA_EQUIPO' => 'Nombre Marca Equipo',
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

		$criteria->compare('ID_MARCA_EQUIPO',$this->ID_MARCA_EQUIPO);
		$criteria->compare('NOMBRE_MARCA_EQUIPO',$this->NOMBRE_MARCA_EQUIPO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MarcaEquipo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
