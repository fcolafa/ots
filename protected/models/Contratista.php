<?php

/**
 * This is the model class for table "contratista".
 *
 * The followings are the available columns in table 'contratista':
 * @property integer $ID_CONTRATISTA
 * @property integer $ID_EMPRESA
 * @property string $NOMBRE_CONTRATISTA
 * @property string $RUT_CONTRATISTA
 * @property string $DIRECCION_CONTRATISTA
 * @property string $CIUDAD_CONTRATISTA
 * @property string $TELEFONO_CONTRATISTA
 * @property string $GIRO_AREA
 * @property string $ENCARGADO
 * @property integer $AUTORIZADO
 *
 * The followings are the available model relations:
 * @property Empresa $iDEMPRESA
 * @property OrdenTrabajo[] $ordenTrabajos
 * @property RecepcionDocumentos[] $recepcionDocumentoses
 */
class Contratista extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contratista';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_EMPRESA, NOMBRE_CONTRATISTA, RUT_CONTRATISTA', 'required'),
			array('ID_EMPRESA, AUTORIZADO', 'numerical', 'integerOnly'=>true),
			array('NOMBRE_CONTRATISTA, DIRECCION_CONTRATISTA, CIUDAD_CONTRATISTA, ENCARGADO', 'length', 'max'=>150),
			array('RUT_CONTRATISTA', 'length', 'max'=>15),
			array('TELEFONO_CONTRATISTA, GIRO_AREA', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_CONTRATISTA, ID_EMPRESA, NOMBRE_CONTRATISTA, RUT_CONTRATISTA, DIRECCION_CONTRATISTA, CIUDAD_CONTRATISTA, TELEFONO_CONTRATISTA, GIRO_AREA, ENCARGADO, AUTORIZADO', 'safe', 'on'=>'search'),
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
			'empresa' => array(self::BELONGS_TO, 'Empresa', 'ID_EMPRESA'),
			'orden_trabajo' => array(self::HAS_MANY, 'OrdenTrabajo', 'ID_CONTRATISTA'),
			'recepcion_documentos' => array(self::HAS_MANY, 'RecepcionDocumentos', 'ID_CONTRATISTA'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_CONTRATISTA' => 'Id Contratista',
			'ID_EMPRESA' => 'Id Empresa',
			'NOMBRE_CONTRATISTA' => 'Nombre Contratista',
			'RUT_CONTRATISTA' => 'Rut Contratista',
			'DIRECCION_CONTRATISTA' => 'Direccion Contratista',
			'CIUDAD_CONTRATISTA' => 'Ciudad Contratista',
			'TELEFONO_CONTRATISTA' => 'Telefono Contratista',
			'GIRO_AREA' => 'Giro Area',
			'ENCARGADO' => 'Encargado',
			'AUTORIZADO' => 'Autorizado',
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

		$criteria->compare('ID_CONTRATISTA',$this->ID_CONTRATISTA);
		$criteria->compare('ID_EMPRESA', Yii::app()->getSession()->get('id_empresa') );
		$criteria->compare('NOMBRE_CONTRATISTA',$this->NOMBRE_CONTRATISTA,true);
		$criteria->compare('RUT_CONTRATISTA',$this->RUT_CONTRATISTA,true);
		$criteria->compare('DIRECCION_CONTRATISTA',$this->DIRECCION_CONTRATISTA,true);
		$criteria->compare('CIUDAD_CONTRATISTA',$this->CIUDAD_CONTRATISTA,true);
		$criteria->compare('TELEFONO_CONTRATISTA',$this->TELEFONO_CONTRATISTA,true);
		$criteria->compare('GIRO_AREA',$this->GIRO_AREA,true);
		$criteria->compare('ENCARGADO',$this->ENCARGADO,true);
		$criteria->compare('AUTORIZADO',$this->AUTORIZADO);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Contratista the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
