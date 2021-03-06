<?php

/**
 * This is the model class for table "equipo".
 *
 * The followings are the available columns in table 'equipo':
 * @property integer $ID_EQUIPO
 * @property string $TAG_EQUIPO
 * @property integer $ID_TIPO_EQUIPO
 * @property string $NOMBRE_EQUIPO
 * @property integer $ID_MODELO_EQUIPO
 * @property integer $TIEMPO_MANTENCION
 * @property integer $YEAR_EQUIPO
 * @property string $NUMERO_EQUIPO
 * @property string $UBICACION_EQUIPO
 * @property string $CAPACIDAD
 * @property string $FECHA_ADQUISICION
 * @property string $FECHA_EMPRESA
 * @property string $IMAGEN_EQUIPO
 * @property string $DESCRIPCION_EQUIPO
 * @property string $ESTADO_EQUIPO
 *
 * The followings are the available model relations:
 * @property ModelEquipo $iDMODELOEQUIPO
 * @property TipoEquipo $iDTIPOEQUIPO
 * @property EspecifTecnicas[] $especifTecnicases
 * @property PiezasEquipos[] $piezasEquiposes
 * @property RegistroHorometro[] $registroHorometros
 * @property RegistroMantencion[] $registroMantencions
 */
class Equipo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'equipo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DESCRIPCION_EQUIPO', 'required'),
			array('ID_TIPO_EQUIPO, ID_MODELO_EQUIPO, TIEMPO_MANTENCION, YEAR_EQUIPO', 'numerical', 'integerOnly'=>true),
			array('TAG_EQUIPO', 'length', 'max'=>150),
			array('NOMBRE_EQUIPO, UBICACION_EQUIPO', 'length', 'max'=>100),
			array('NUMERO_EQUIPO, CAPACIDAD, IMAGEN_EQUIPO', 'length', 'max'=>50),
			array('ESTADO_EQUIPO', 'length', 'max'=>10),
			array('FECHA_ADQUISICION, FECHA_EMPRESA', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_EQUIPO, TAG_EQUIPO, ID_TIPO_EQUIPO, NOMBRE_EQUIPO, ID_MODELO_EQUIPO, TIEMPO_MANTENCION, YEAR_EQUIPO, NUMERO_EQUIPO, UBICACION_EQUIPO, CAPACIDAD, FECHA_ADQUISICION, FECHA_EMPRESA, IMAGEN_EQUIPO, DESCRIPCION_EQUIPO, ESTADO_EQUIPO', 'safe', 'on'=>'search'),
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
			'iDMODELOEQUIPO' => array(self::BELONGS_TO, 'ModelEquipo', 'ID_MODELO_EQUIPO'),
			'iDTIPOEQUIPO' => array(self::BELONGS_TO, 'TipoEquipo', 'ID_TIPO_EQUIPO'),
			'especifTecnicases' => array(self::HAS_MANY, 'EspecifTecnicas', 'ID_EQUIPO'),
			'piezasEquiposes' => array(self::HAS_MANY, 'PiezasEquipos', 'ID_EQUIPO'),
			'registroHorometros' => array(self::HAS_MANY, 'RegistroHorometro', 'ID_EQUIPO'),
			'registroMantencions' => array(self::HAS_MANY, 'RegistroMantencion', 'ID_EQUIPO'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_EQUIPO' => 'Id Equipo',
			'TAG_EQUIPO' => 'Tag Equipo',
			'ID_TIPO_EQUIPO' => 'Id Tipo Equipo',
			'NOMBRE_EQUIPO' => 'Nombre Equipo',
			'ID_MODELO_EQUIPO' => 'Id Modelo Equipo',
			'TIEMPO_MANTENCION' => 'Tiempo Mantencion',
			'YEAR_EQUIPO' => 'Year Equipo',
			'NUMERO_EQUIPO' => 'Numero Equipo',
			'UBICACION_EQUIPO' => 'Ubicacion Equipo',
			'CAPACIDAD' => 'Capacidad',
			'FECHA_ADQUISICION' => 'Fecha Adquisicion',
			'FECHA_EMPRESA' => 'Fecha Empresa',
			'IMAGEN_EQUIPO' => 'Imagen Equipo',
			'DESCRIPCION_EQUIPO' => 'Descripcion Equipo',
			'ESTADO_EQUIPO' => 'Estado Equipo',
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

		$criteria->compare('ID_EQUIPO',$this->ID_EQUIPO);
		$criteria->compare('TAG_EQUIPO',$this->TAG_EQUIPO,true);
		$criteria->compare('ID_TIPO_EQUIPO',$this->ID_TIPO_EQUIPO);
		$criteria->compare('NOMBRE_EQUIPO',$this->NOMBRE_EQUIPO,true);
		$criteria->compare('ID_MODELO_EQUIPO',$this->ID_MODELO_EQUIPO);
		$criteria->compare('TIEMPO_MANTENCION',$this->TIEMPO_MANTENCION);
		$criteria->compare('YEAR_EQUIPO',$this->YEAR_EQUIPO);
		$criteria->compare('NUMERO_EQUIPO',$this->NUMERO_EQUIPO,true);
		$criteria->compare('UBICACION_EQUIPO',$this->UBICACION_EQUIPO,true);
		$criteria->compare('CAPACIDAD',$this->CAPACIDAD,true);
		$criteria->compare('FECHA_ADQUISICION',$this->FECHA_ADQUISICION,true);
		$criteria->compare('FECHA_EMPRESA',$this->FECHA_EMPRESA,true);
		$criteria->compare('IMAGEN_EQUIPO',$this->IMAGEN_EQUIPO,true);
		$criteria->compare('DESCRIPCION_EQUIPO',$this->DESCRIPCION_EQUIPO,true);
		$criteria->compare('ESTADO_EQUIPO',$this->ESTADO_EQUIPO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Equipo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
