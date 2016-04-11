<?php

/**
 * This is the model class for table "empresa".
 *
 * The followings are the available columns in table 'empresa':
 * @property integer $ID_EMPRESA
 * @property string $NOMBRE_EMPRESA
 * @property string $RUT_EMPRESA
 * @property string $CASA_MATRIZ
 * @property string $CIUDAD
 * @property string $FONO
 * @property string $FAX
 * @property string $PLANTA
 * @property string $URL_LOGO
 *
 * The followings are the available model relations:
 * @property Cargos[] $cargoses
 * @property Contratista[] $contratistas
 * @property Departamentos[] $departamentoses
 * @property OrdenTrabajo[] $ordenTrabajos
 * @property Personal[] $personals
 */
class Empresa extends CActiveRecord
{

	public $image;
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'empresa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NOMBRE_EMPRESA, RUT_EMPRESA', 'required'),
			array('ID_EMPRESA', 'numerical', 'integerOnly'=>true),
			array('NOMBRE_EMPRESA', 'length', 'max'=>150),
			array('RUT_EMPRESA', 'length', 'max'=>15),
			array('CASA_MATRIZ, CIUDAD, FONO, FAX, PLANTA', 'length', 'max'=>50),
			array('URL_LOGO', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_EMPRESA, NOMBRE_EMPRESA, RUT_EMPRESA, CASA_MATRIZ, CIUDAD, FONO, FAX, PLANTA, URL_LOGO', 'safe', 'on'=>'search'),
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
			'cargoses' => array(self::HAS_MANY, 'Cargos', 'ID_EMPRESA'),
			'contratistas' => array(self::HAS_MANY, 'Contratista', 'ID_EMPRESA'),
			'departamentoses' => array(self::HAS_MANY, 'Departamentos', 'ID_EMPRESA'),
			'ordenTrabajos' => array(self::HAS_MANY, 'OrdenTrabajo', 'ID_EMPRESA'),
			'personals' => array(self::HAS_MANY, 'Personal', 'ID_EMPRESA'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_EMPRESA' => 'Id Empresa',
			'NOMBRE_EMPRESA' => 'Nombre Empresa',
			'RUT_EMPRESA' => 'Rut Empresa',
			'CASA_MATRIZ' => 'Casa Matriz',
			'CIUDAD' => 'Ciudad',			
			'FONO' => 'Fono',
			'FAX' => 'Fax',
			'PLANTA' => 'Planta',
			'URL_LOGO' => 'Url Logo',
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
		$criteria->compare('NOMBRE_EMPRESA',$this->NOMBRE_EMPRESA,true);
		$criteria->compare('RUT_EMPRESA',$this->RUT_EMPRESA,true);
		$criteria->compare('CASA_MATRIZ',$this->CASA_MATRIZ,true);
		$criteria->compare('CIUDAD',$this->CIUDAD,true);
		$criteria->compare('FONO',$this->FONO,true);
		$criteria->compare('FAX',$this->FAX,true);
		$criteria->compare('PLANTA',$this->PLANTA,true);
		$criteria->compare('URL_LOGO',$this->URL_LOGO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Empresa the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

}
