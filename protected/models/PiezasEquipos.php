<?php

/**
 * This is the model class for table "piezas_equipos".
 *
 * The followings are the available columns in table 'piezas_equipos':
 * @property integer $ID_PIEZA
 * @property integer $ID_EQUIPO
 * @property string $NOMBRE_PIEZA
 * @property string $IMAGEN_PIEZA
 * @property string $DESCRIPCION_PIEZA
 *
 * The followings are the available model relations:
 * @property EspecifTecnicas[] $especifTecnicases
 * @property Equipo $iDEQUIPO
 */
class PiezasEquipos extends CActiveRecord
{

	public $archivo;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'piezas_equipos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_EQUIPO, NOMBRE_PIEZA', 'required'),
			array('ID_EQUIPO', 'numerical', 'integerOnly'=>true),
			array('NOMBRE_PIEZA', 'length', 'max'=>100),
			array('IMAGEN_PIEZA', 'length', 'max'=>50),
			array('archivo', 'file', 'maxSize'=>'2097150', 'tooLarge'=>'Archivo no debe superar los 2 MB', 'allowEmpty'=>true),
			array('archivo', 'validarExtension'),
			array('NOMBRE_PIEZA, IMAGEN_PIEZA, DESCRIPCION_PIEZA', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_PIEZA, ID_EQUIPO, NOMBRE_PIEZA, IMAGEN_PIEZA, DESCRIPCION_PIEZA', 'safe', 'on'=>'search'),
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
			'especifTecnicas' => array(self::HAS_MANY, 'EspecifTecnicas', 'ID_PIEZA'),
			'equipos' => array(self::BELONGS_TO, 'Equipo', 'ID_EQUIPO'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_PIEZA' => 'Id Pieza',
			'ID_EQUIPO' => 'Equipo',
			'NOMBRE_PIEZA' => 'Nombre Pieza',
			'IMAGEN_PIEZA' => 'Imagen Pieza',
			'DESCRIPCION_PIEZA' => 'Descripción Pieza',
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

		$criteria->compare('ID_PIEZA',$this->ID_PIEZA);
		$criteria->compare('ID_EQUIPO',$this->ID_EQUIPO);
		$criteria->compare('NOMBRE_PIEZA',$this->NOMBRE_PIEZA,true);
		$criteria->compare('IMAGEN_PIEZA',$this->IMAGEN_PIEZA,true);
		$criteria->compare('DESCRIPCION_PIEZA',$this->DESCRIPCION_PIEZA,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function validarExtension($attribute, $params) {
		$datetime1 = CDateTimeParser::parse(date("Y-m-d H:i:s"),'yyyy-MM-dd hh:mm:ss');

		if(!empty($this->archivo)):
			$extensionFile = $this->archivo->getExtensionName();
			if ($extensionFile == "jpeg" || $extensionFile == "jpg" || $extensionFile == "png"):
				$this->IMAGEN_PIEZA = $this->ID_EQUIPO.'-'.$datetime1.'.'.$extensionFile;
			else:
				$model->addError('archivo', 'El archivo debe ser  .jpeg,  .jpg  o  .png');
			endif;
		endif;
  	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PiezasEquipos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
