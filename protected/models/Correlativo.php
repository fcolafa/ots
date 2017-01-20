<?php

/**
 * This is the model class for table "correlativo".
 *
 * The followings are the available columns in table 'correlativo':
 * @property integer $ID_CORRELATIVO
 * @property integer $NUMERO_CORRELATIVO
 * @property integer $ID_EMPRESA
 *
 * The followings are the available model relations:
 * @property Empresa $iDEMPRESA
 */
class Correlativo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'correlativo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_CORRELATIVO, NUMERO_CORRELATIVO, ID_EMPRESA', 'required'),
			array('ID_CORRELATIVO, NUMERO_CORRELATIVO, ID_EMPRESA', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_CORRELATIVO, NUMERO_CORRELATIVO, ID_EMPRESA', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_CORRELATIVO' => 'Id Correlativo',
			'NUMERO_CORRELATIVO' => 'Numero Correlativo',
			'ID_EMPRESA' => 'Id Empresa',
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

		$criteria->compare('ID_CORRELATIVO',$this->ID_CORRELATIVO);
		$criteria->compare('NUMERO_CORRELATIVO',$this->NUMERO_CORRELATIVO);
		$criteria->compare('ID_EMPRESA',$this->ID_EMPRESA);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Correlativo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
