<?php

/**
 * This is the model class for table "registro_equipo".
 *
 * The followings are the available columns in table 'registro_equipo':
 * @property string $NUMERO_EQUIPO
 * @property string $NOMBRE_EQUIPO
 * @property string $MODELO_EQUIPO
 * @property integer $TIEMPO_MANTENCION
 * @property string $IMAGEN_EQUIPO
 * @property string $CAPACIDAD
 * @property string $UBICACION_EQUIPO
 * @property string $ULTIMO_REGISTRO
 * @property string $ULTIMO_HOROMETRO
 * @property string $ULTIMA_MANTENCION
 * @property string $HOROMETRO_MANTENCION
 */
class RegistroEquipo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'registro_equipo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TIEMPO_MANTENCION', 'numerical', 'integerOnly'=>true),
			array('NUMERO_EQUIPO, IMAGEN_EQUIPO, CAPACIDAD', 'length', 'max'=>50),
			array('NOMBRE_EQUIPO, UBICACION_EQUIPO', 'length', 'max'=>100),
			array('MODELO_EQUIPO', 'length', 'max'=>93),
			array('ULTIMO_HOROMETRO, HOROMETRO_MANTENCION', 'length', 'max'=>11),
			array('ULTIMO_REGISTRO, ULTIMA_MANTENCION', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('NUMERO_EQUIPO, NOMBRE_EQUIPO, MODELO_EQUIPO, TIEMPO_MANTENCION, IMAGEN_EQUIPO, CAPACIDAD, UBICACION_EQUIPO, ULTIMO_REGISTRO, ULTIMO_HOROMETRO, ULTIMA_MANTENCION, HOROMETRO_MANTENCION', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'NUMERO_EQUIPO' => 'Numero Equipo',
			'NOMBRE_EQUIPO' => 'Nombre Equipo',
			'MODELO_EQUIPO' => 'Modelo Equipo',
			'TIEMPO_MANTENCION' => 'Tiempo Mantencion',
			'IMAGEN_EQUIPO' => 'Imagen Equipo',
			'CAPACIDAD' => 'Capacidad',
			'UBICACION_EQUIPO' => 'Ubicacion Equipo',
			'ULTIMO_REGISTRO' => 'Ultimo Registro',
			'ULTIMO_HOROMETRO' => 'Ultimo Horometro',
			'ULTIMA_MANTENCION' => 'Ultima Mantencion',
			'HOROMETRO_MANTENCION' => 'Horometro Mantencion',
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

		$criteria->compare('NUMERO_EQUIPO',$this->NUMERO_EQUIPO,true);
		$criteria->compare('NOMBRE_EQUIPO',$this->NOMBRE_EQUIPO,true);
		$criteria->compare('MODELO_EQUIPO',$this->MODELO_EQUIPO,true);
		$criteria->compare('TIEMPO_MANTENCION',$this->TIEMPO_MANTENCION);
		$criteria->compare('IMAGEN_EQUIPO',$this->IMAGEN_EQUIPO,true);
		$criteria->compare('CAPACIDAD',$this->CAPACIDAD,true);
		$criteria->compare('UBICACION_EQUIPO',$this->UBICACION_EQUIPO,true);
		$criteria->compare('ULTIMO_REGISTRO',$this->ULTIMO_REGISTRO,true);
		$criteria->compare('ULTIMO_HOROMETRO',$this->ULTIMO_HOROMETRO,true);
		$criteria->compare('ULTIMA_MANTENCION',$this->ULTIMA_MANTENCION,true);
		$criteria->compare('HOROMETRO_MANTENCION',$this->HOROMETRO_MANTENCION,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RegistroEquipo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
