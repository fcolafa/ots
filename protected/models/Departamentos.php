<?php

/**
 * This is the model class for table "departamentos".
 *
 * The followings are the available columns in table 'departamentos':
 * @property integer $ID_DEPARTAMENTO
 * @property integer $ID_EMPRESA
 * @property string $NOMBRE_DEPARTAMENTO
 * @property string $DESCRIPCION_DEPARTAMENTO
 *
 * The followings are the available model relations:
 * @property Empresa $iDEMPRESA
 * @property OrdenTrabajo[] $ordenTrabajos
 * @property Personal[] $personals
 */
class Departamentos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'departamentos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_EMPRESA, NOMBRE_DEPARTAMENTO', 'required'),
			array('ID_DEPARTAMENTO, ID_EMPRESA', 'numerical', 'integerOnly'=>true),
			array('NOMBRE_DEPARTAMENTO', 'length', 'max'=>250),
			array('DESCRIPCION_DEPARTAMENTO', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_DEPARTAMENTO, ID_EMPRESA, NOMBRE_DEPARTAMENTO, DESCRIPCION_DEPARTAMENTO', 'safe', 'on'=>'search'),
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
			'ordenTrabajos' => array(self::HAS_MANY, 'OrdenTrabajo', 'ID_DEPARTAMENTO'),
			'personals' => array(self::HAS_MANY, 'Personal', 'ID_DEPARTAMENTO'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_DEPARTAMENTO' => 'Id Departamento',
			'ID_EMPRESA' => 'Empresa',
			'NOMBRE_DEPARTAMENTO' => 'Nombre Departamento',
			'DESCRIPCION_DEPARTAMENTO' => 'Descripcion Departamento',
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

		$criteria->compare('ID_EMPRESA', Yii::app()->getSession()->get('id_empresa') );
		$criteria->compare('ID_EMPRESA',$this->ID_EMPRESA);
		$criteria->compare('NOMBRE_DEPARTAMENTO',$this->NOMBRE_DEPARTAMENTO,true);
		$criteria->compare('DESCRIPCION_DEPARTAMENTO',$this->DESCRIPCION_DEPARTAMENTO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Departamentos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
