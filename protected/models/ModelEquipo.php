<?php

/**
 * This is the model class for table "model_equipo".
 *
 * The followings are the available columns in table 'model_equipo':
 * @property integer $ID_MODELO_EQUIPO
 * @property integer $ID_MARCA_EQUIPO
 * @property string $NOMBRE_MODELO_EQUIPO
 *
 * The followings are the available model relations:
 * @property Equipo[] $equipos
 * @property MarcaEquipo $iDMARCAEQUIPO
 */
class ModelEquipo extends CActiveRecord
{
	public $marca_modelo;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'model_equipo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_MARCA_EQUIPO, NOMBRE_MODELO_EQUIPO', 'required'),
			array('ID_MARCA_EQUIPO', 'numerical', 'integerOnly'=>true),
			array('NOMBRE_MODELO_EQUIPO', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_MODELO_EQUIPO, ID_MARCA_EQUIPO, NOMBRE_MODELO_EQUIPO, marca_modelo', 'safe', 'on'=>'search'),
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
			'equipos' => array(self::HAS_MANY, 'Equipo', 'ID_MODELO_EQUIPO'),
			'marcaEquipos' => array(self::BELONGS_TO, 'MarcaEquipo', 'ID_MARCA_EQUIPO'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_MODELO_EQUIPO' => 'Id Modelo Equipo',
			'ID_MARCA_EQUIPO' => 'Marca Equipo',
			'NOMBRE_MODELO_EQUIPO' => 'Modelo Equipo',
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

		$criteria->with = array('marcaEquipos'); 
		$criteria->compare('ID_MODELO_EQUIPO',$this->ID_MODELO_EQUIPO);
		$criteria->compare('ID_MARCA_EQUIPO',$this->ID_MARCA_EQUIPO);
		$criteria->compare('NOMBRE_MODELO_EQUIPO',$this->NOMBRE_MODELO_EQUIPO,true);

		$criteria->compare('marcaEquipos.NOMBRE_MARCA_EQUIPO', $this->marca_modelo, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ModelEquipo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


}
