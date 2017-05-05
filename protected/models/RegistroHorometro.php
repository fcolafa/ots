<?php

/**
 * This is the model class for table "registro_horometro".
 *
 * The followings are the available columns in table 'registro_horometro':
 * @property integer $ID_REGISTRO_HOROM
 * @property integer $ID_EQUIPO
 * @property string $FECHA_REGISTRO
 * @property integer $HOROMETRO
 * @property string $ID_USUARIO
 * @property string $OBSERVACION
 *
 * The followings are the available model relations:
 * @property Equipo $iDEQUIPO
 * @property Usuarios $iDUSUARIO
 */
class RegistroHorometro extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'registro_horometro';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_EQUIPO, FECHA_REGISTRO, HOROMETRO', 'required'),
			array('ID_EQUIPO, HOROMETRO', 'numerical', 'integerOnly'=>true),
			array('ID_USUARIO', 'length', 'max'=>11),
			array('FECHA_REGISTRO, OBSERVACION', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_REGISTRO_HOROM, ID_EQUIPO, FECHA_REGISTRO, HOROMETRO, ID_USUARIO, OBSERVACION', 'safe', 'on'=>'search'),
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
			'equipos' => array(self::BELONGS_TO, 'Equipo', 'ID_EQUIPO'),
			'usuarios' => array(self::BELONGS_TO, 'Usuarios', 'ID_USUARIO'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_REGISTRO_HOROM' => 'Id Registro Horom',
			'ID_EQUIPO' => 'Equipo',
			'FECHA_REGISTRO' => 'Fecha Registro',
			'HOROMETRO' => 'Horometro',
			'ID_USUARIO' => 'Usuario',
			'OBSERVACION' => 'Observación',
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

		$criteria->compare('ID_REGISTRO_HOROM',$this->ID_REGISTRO_HOROM);
		$criteria->compare('ID_EQUIPO',$this->ID_EQUIPO);
		$criteria->compare('FECHA_REGISTRO',$this->FECHA_REGISTRO,true);
		$criteria->compare('HOROMETRO',$this->HOROMETRO);
		$criteria->compare('ID_USUARIO',$this->ID_USUARIO,true);
		$criteria->compare('OBSERVACION',$this->OBSERVACION,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RegistroHorometro the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
