<?php

/**
 * This is the model class for table "cargos".
 *
 * The followings are the available columns in table 'cargos':
 * @property integer $ID_CARGO
 * @property integer $ID_EMPRESA
 * @property integer $DEPENDENCIA_CARGO
 * @property string $NOMBRE_CARGO
 * @property string $DESCRIPCION_CARGO
 *
 * The followings are the available model relations:
 * @property Empresa $iDEMPRESA
 * @property Personal[] $personals
 */
class Cargos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cargos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_EMPRESA, NOMBRE_CARGO', 'required'),
			array('ID_EMPRESA, DEPENDENCIA_CARGO', 'numerical', 'integerOnly'=>true),
			array('NOMBRE_CARGO', 'length', 'max'=>100),
			array('DESCRIPCION_CARGO', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_CARGO, ID_EMPRESA, DEPENDENCIA_CARGO, NOMBRE_CARGO, DESCRIPCION_CARGO', 'safe', 'on'=>'search'),
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
			'personal' => array(self::HAS_MANY, 'Personal', 'ID_CARGO'),
			'cargos' => array(self::HAS_ONE, 'Cargos', array('DEPENDENCIA_CARGO'=>'ID_CARGO')),
			'cargos2' => array(self::HAS_ONE, 'Cargos', array('ID_CARGO'=>'DEPENDENCIA_CARGO')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_CARGO' => 'Id Cargo',
			'ID_EMPRESA' => 'Empresa',
			'DEPENDENCIA_CARGO' => 'Dependencia Cargo',
			'NOMBRE_CARGO' => 'Nombre Cargo',
			'DESCRIPCION_CARGO' => 'Descripcion Cargo',
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

		$criteria->compare('ID_CARGO',$this->ID_CARGO);
		$criteria->compare('ID_EMPRESA', Yii::app()->getSession()->get('id_empresa') );
		$criteria->compare('DEPENDENCIA_CARGO',$this->DEPENDENCIA_CARGO);
		$criteria->compare('NOMBRE_CARGO',$this->NOMBRE_CARGO,true);
		$criteria->compare('DESCRIPCION_CARGO',$this->DESCRIPCION_CARGO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cargos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
