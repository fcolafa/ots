<?php

/**
 * This is the model class for table "usuario_aprobacion".
 *
 * The followings are the available columns in table 'usuario_aprobacion':
 * @property integer $ID_USUARIO_APROBACION
 * @property string $ID_USUARIO
 * @property string $ID_NIVEL_APROB
 *
 * The followings are the available model relations:
 * @property Usuarios $iDUSUARIO
 * @property NivelAprobacion $iDNIVELAPROB
 */
class UsuarioAprobacion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuario_aprobacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_USUARIO, ID_NIVEL_APROB', 'required'),
			array('ID_USUARIO, ID_NIVEL_APROB', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_USUARIO_APROBACION, ID_USUARIO, ID_NIVEL_APROB', 'safe', 'on'=>'search'),
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
			'iDUSUARIO' => array(self::BELONGS_TO, 'Usuarios', 'ID_USUARIO'),
			'iDNIVELAPROB' => array(self::BELONGS_TO, 'NivelAprobacion', 'ID_NIVEL_APROB'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_USUARIO_APROBACION' => 'Id Usuario Aprobacion',
			'ID_USUARIO' => 'Id Usuario',
			'ID_NIVEL_APROB' => 'Id Nivel Aprob',
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

		$criteria->compare('ID_USUARIO_APROBACION',$this->ID_USUARIO_APROBACION);
		$criteria->compare('ID_USUARIO',$this->ID_USUARIO,true);
		$criteria->compare('ID_NIVEL_APROB',$this->ID_NIVEL_APROB,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsuarioAprobacion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
