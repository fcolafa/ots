<?php

/**
 * This is the model class for table "nivel_aprobacion".
 *
 * The followings are the available columns in table 'nivel_aprobacion':
 * @property string $ID_NIVEL_APROB
 * @property integer $ID_TIPO_DOC
 * @property string $NOMBRE_NIVEL
 * @property string $NIVEL_APROB
 * @property string $MONTO_APROB
 *
 * The followings are the available model relations:
 * @property Usuarios[] $usuarioses
 */
class NivelAprobacion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'nivel_aprobacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_TIPO_DOC', 'required'),
			array('ID_TIPO_DOC', 'numerical', 'integerOnly'=>true),
			array('NOMBRE_NIVEL', 'length', 'max'=>10),
			array('NIVEL_APROB', 'length', 'max'=>1),
			array('MONTO_APROB', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_NIVEL_APROB, ID_TIPO_DOC, NOMBRE_NIVEL, NIVEL_APROB, MONTO_APROB', 'safe', 'on'=>'search'),
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
			'usuarioses' => array(self::MANY_MANY, 'Usuarios', 'usuario_aprobacion(ID_NIVEL_APROB, ID_USUARIO)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_NIVEL_APROB' => 'Id Nivel Aprob',
			'ID_TIPO_DOC' => 'Id Tipo Doc',
			'NOMBRE_NIVEL' => 'Nombre Nivel',
			'NIVEL_APROB' => 'Nivel Aprob',
			'MONTO_APROB' => 'Monto Aprob',
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

		$criteria->compare('ID_NIVEL_APROB',$this->ID_NIVEL_APROB,true);
		$criteria->compare('ID_TIPO_DOC',$this->ID_TIPO_DOC);
		$criteria->compare('NOMBRE_NIVEL',$this->NOMBRE_NIVEL,true);
		$criteria->compare('NIVEL_APROB',$this->NIVEL_APROB,true);
		$criteria->compare('MONTO_APROB',$this->MONTO_APROB,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NivelAprobacion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
