<?php

/**
 * This is the model class for table "recepciondocumentos".
 *
 * The followings are the available columns in table 'recepciondocumentos':
 * @property integer $ID_RECEPCION
 * @property string $FECHA_RECEPCION
 * @property integer $ESTADO
 * @property integer $ID_CONTRATISTA
 * @property integer $ID_DOCUMENTO
 *
 * The followings are the available model relations:
 * @property Documentocontratista $iDDOCUMENTOS
 * @property Contratista $iDCONTRATISTAS
 */
class Recepciondocumentos extends CActiveRecord
{
	public $contratista;
	public $documento;
	public $estado;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'recepcion_documentos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FECHA_RECEPCION', 'required'),
			array('ESTADO, ID_CONTRATISTA, ID_DOCUMENTO', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_RECEPCION, FECHA_RECEPCION, ESTADO, ID_CONTRATISTA, ID_DOCUMENTO,contratista,documento', 'safe', 'on'=>'search'),
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
			'iDDOCUMENTOS' => array(self::BELONGS_TO, 'DocumentosContratista', 'ID_DOCUMENTO'),
			'iDCONTRATISTAS' => array(self::BELONGS_TO, 'Contratista', 'ID_CONTRATISTA'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_RECEPCION' => 'Id Recepcion',
			'FECHA_RECEPCION' => 'Fecha Recepcion',
			'ESTADO' => 'Estado',
			'ID_CONTRATISTA' => 'Contratistas',
			'ID_DOCUMENTO' => 'Documentos',
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

		$criteria->with = array('iDCONTRATISTAS');
		$criteria->with = array('iDDOCUMENTOS');
		$criteria->compare('ID_RECEPCION',$this->ID_RECEPCION);
		$criteria->compare('FECHA_RECEPCION',$this->FECHA_RECEPCION,true);
		$criteria->compare('ESTADO',$this->ESTADO);
		//$criteria->compare('ID_CONTRATISTA',$this->ID_CONTRATISTA);
		//$criteria->compare('ID_DOCUMENTO',$this->ID_DOCUMENTO);
		$criteria->compare('iDCONTRATISTAS.NOMBRE_EMPRESA_CONTRATISTA', $this->contratista, true );
		$criteria->compare('iDDOCUMENTOS.NOMBRE_DOCUMENTO', $this->documento, true );
		$criteria->order='FECHA_RECEPCION ASC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Recepciondocumentos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
