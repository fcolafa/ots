<?php

/**
 * This is the model class for table "scc".
 *
 * The followings are the available columns in table 'scc':
 * @property integer $ID_SCC
 * @property string $SCC_NUMERO
 * @property string $SCC_DESCRIPCION
 * @property integer $ID_CCC
 *
 * The followings are the available model relations:
 * @property InsumosOt[] $insumosOts
 * @property Ccc $iDCCC
 * @property Sec[] $secs
 */
class Scc extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'scc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_SCC, ID_CCC', 'required'),
			array('ID_SCC, ID_CCC', 'numerical', 'integerOnly'=>true),
			array('SCC_NUMERO', 'length', 'max'=>45),
			array('SCC_DESCRIPCION', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_SCC, SCC_NUMERO, SCC_DESCRIPCION, ID_CCC', 'safe', 'on'=>'search'),
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
			'insumosOts' => array(self::HAS_MANY, 'InsumosOt', 'ID_SCC'),
			'iDCCC' => array(self::BELONGS_TO, 'Ccc', 'ID_CCC'),
			'secs' => array(self::HAS_MANY, 'Sec', 'ID_SCC'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_SCC' => 'Id Scc',
			'SCC_NUMERO' => 'Scc Numero',
			'SCC_DESCRIPCION' => 'Scc Descripcion',
			'ID_CCC' => 'Id Ccc',
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

		$criteria->compare('ID_SCC',$this->ID_SCC);
		$criteria->compare('SCC_NUMERO',$this->SCC_NUMERO,true);
		$criteria->compare('SCC_DESCRIPCION',$this->SCC_DESCRIPCION,true);
		$criteria->compare('ID_CCC',$this->ID_CCC);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Scc the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
