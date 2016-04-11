<?php

/**
 * This is the model class for table "usuarios".
 *
 * The followings are the available columns in table 'usuarios':
 * @property string $ID_USUARIO
 * @property string $NOMBRE_USUARIO
 * @property string $CONTRASENA
 * @property string $COD_TIPO_USUARIO
 * @property integer $ID_PERSONA
 *
 * The followings are the available model relations:
 * @property UsuarioAprobacion[] $usuarioAprobacions
 */
class Usuarios extends CActiveRecord
{

	public $empresa;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuarios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NOMBRE_USUARIO, CONTRASENA, COD_TIPO_USUARIO', 'required'),
			array('ID_PERSONA', 'numerical', 'integerOnly'=>true),
			array('NOMBRE_USUARIO', 'length', 'max'=>50),
			array('CONTRASENA', 'length', 'max'=>1024),
			array('COD_TIPO_USUARIO', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_USUARIO, empresa, NOMBRE_USUARIO, CONTRASENA, COD_TIPO_USUARIO, ID_PERSONA', 'safe', 'on'=>'search'),
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
			'usuarioAprobacions' => array(self::HAS_MANY, 'UsuarioAprobacion', 'ID_USUARIO'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_USUARIO' => 'Id Usuario',
			'NOMBRE_USUARIO' => 'Nombre Usuario',
			'CONTRASENA' => 'Contrasena',
			'COD_TIPO_USUARIO' => 'Cod Tipo Usuario',
			'ID_PERSONA' => 'Id Persona',
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

		$criteria->compare('ID_USUARIO',$this->ID_USUARIO,true);
		$criteria->compare('NOMBRE_USUARIO',$this->NOMBRE_USUARIO,true);
		$criteria->compare('CONTRASENA',$this->CONTRASENA,true);
		$criteria->compare('COD_TIPO_USUARIO',$this->COD_TIPO_USUARIO,true);
		$criteria->compare('ID_PERSONA',$this->ID_PERSONA);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usuarios the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

		public function validatePassword($password)
	{
		return $password === $this->CONTRASENA;
	}
}
