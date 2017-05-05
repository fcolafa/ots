<?php

/**
 * This is the model class for table "registro_mantencion".
 *
 * The followings are the available columns in table 'registro_mantencion':
 * @property integer $ID_REGISTRO
 * @property integer $ID_EQUIPO
 * @property string $FECHA_REGISTRO
 * @property integer $REGISTRO_MARCADO
 * @property string $COMENTARIO_REGISTRO
 *
 * The followings are the available model relations:
 * @property Equipo $iDEQUIPO
 */
class RegistroMantencion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'registro_mantencion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_EQUIPO', 'required'),
			array('ID_EQUIPO, REGISTRO_MARCADO', 'numerical', 'integerOnly'=>true),
			array('FECHA_REGISTRO, COMENTARIO_REGISTRO', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_REGISTRO, ID_EQUIPO, FECHA_REGISTRO, REGISTRO_MARCADO, COMENTARIO_REGISTRO', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_REGISTRO' => 'Id Registro',
			'ID_EQUIPO' => 'Equipo',
			'FECHA_REGISTRO' => 'Fecha Registro',
			'REGISTRO_MARCADO' => 'Horómetro',
			'COMENTARIO_REGISTRO' => 'Observaciones',
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

		$criteria->compare('ID_REGISTRO',$this->ID_REGISTRO);
		$criteria->compare('ID_EQUIPO',$this->ID_EQUIPO);
		$criteria->compare('FECHA_REGISTRO',$this->FECHA_REGISTRO,true);
		$criteria->compare('REGISTRO_MARCADO',$this->REGISTRO_MARCADO);
		$criteria->compare('COMENTARIO_REGISTRO',$this->COMENTARIO_REGISTRO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RegistroMantencion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
