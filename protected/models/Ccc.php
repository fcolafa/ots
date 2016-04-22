<?php

/**
 * This is the model class for table "ccc".
 *
 * The followings are the available columns in table 'ccc':
 * @property integer $ID_CCC
 * @property string $NUMERO_CUENTA
 * @property string $NOMBRE_CUENTA
 * @property integer $ID_CENTRO_COSTO
 *
 * The followings are the available model relations:
 * @property CentroDeCostos $iDCENTROCOSTO
 * @property InsumosOt[] $insumosOts
 * @property Scc[] $sccs
 */
class Ccc extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ccc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_CCC, ID_CENTRO_COSTO', 'required'),
			array('ID_CCC, ID_CENTRO_COSTO', 'numerical', 'integerOnly'=>true),
			array('NUMERO_CUENTA', 'length', 'max'=>45),
			array('NOMBRE_CUENTA', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_CCC, NUMERO_CUENTA, NOMBRE_CUENTA, ID_CENTRO_COSTO', 'safe', 'on'=>'search'),
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
			'iDCENTROCOSTO' => array(self::BELONGS_TO, 'CentroDeCostos', 'ID_CENTRO_COSTO'),
			'insumosOts' => array(self::HAS_MANY, 'InsumosOt', 'ID_CCC'),
			'sccs' => array(self::HAS_MANY, 'Scc', 'ID_CCC'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_CCC' => 'Id Ccc',
			'NUMERO_CUENTA' => 'Numero Cuenta',
			'NOMBRE_CUENTA' => 'Nombre Cuenta',
			'ID_CENTRO_COSTO' => 'Id Centro Costo',
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

		$criteria->compare('ID_CCC',$this->ID_CCC);
		$criteria->compare('NUMERO_CUENTA',$this->NUMERO_CUENTA,true);
		$criteria->compare('NOMBRE_CUENTA',$this->NOMBRE_CUENTA,true);
		$criteria->compare('ID_CENTRO_COSTO',$this->ID_CENTRO_COSTO);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ccc the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
