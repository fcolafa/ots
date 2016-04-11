<?php

/**
 * This is the model class for table "tipo_usuario".
 *
 * The followings are the available columns in table 'tipo_usuario':
 * @property string $COD_TIPO_USUARIO
 * @property string $NOMBRE_TIPO_USUARIO
 * @property string $DESCRIPCION_TIPO_USUARIO
 *
 * The followings are the available model relations:
 * @property Personal[] $personals
 */
class TipoUsuario extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tipo_usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('COD_TIPO_USUARIO, NOMBRE_TIPO_USUARIO', 'required'),
			array('COD_TIPO_USUARIO', 'length', 'max'=>5),
			array('NOMBRE_TIPO_USUARIO', 'length', 'max'=>50),
			array('DESCRIPCION_TIPO_USUARIO', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('COD_TIPO_USUARIO, NOMBRE_TIPO_USUARIO, DESCRIPCION_TIPO_USUARIO', 'safe', 'on'=>'search'),
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
			'personals' => array(self::HAS_MANY, 'Personal', 'COD_TIPO_USUARIO'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'COD_TIPO_USUARIO' => 'Cod Tipo Usuario',
			'NOMBRE_TIPO_USUARIO' => 'Nombre Tipo Usuario',
			'DESCRIPCION_TIPO_USUARIO' => 'Descripcion Tipo Usuario',
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

		$criteria->compare('COD_TIPO_USUARIO',$this->COD_TIPO_USUARIO,true);
		$criteria->compare('NOMBRE_TIPO_USUARIO',$this->NOMBRE_TIPO_USUARIO,true);
		$criteria->compare('DESCRIPCION_TIPO_USUARIO',$this->DESCRIPCION_TIPO_USUARIO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TipoUsuario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
