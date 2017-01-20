<?php

/**
 * This is the model class for table "sec".
 *
 * The followings are the available columns in table 'sec':
 * @property integer $ID_SEC
 * @property string $SEC_NUMERO
 * @property string $SEC_DESCRIPCION
 * @property integer $ID_SCC
 *
 * The followings are the available model relations:
 * @property InsumosOt[] $insumosOts
 * @property Scc $iDSCC
 */
class Sec extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sec';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_SEC, ID_SCC', 'required'),
			array('ID_SEC, ID_SCC', 'numerical', 'integerOnly'=>true),
			array('SEC_NUMERO, SEC_DESCRIPCION', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_SEC, SEC_NUMERO, SEC_DESCRIPCION, ID_SCC', 'safe', 'on'=>'search'),
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
			'insumosOts' => array(self::HAS_MANY, 'InsumosOt', 'ID_SEC'),
			'iDSCC' => array(self::BELONGS_TO, 'Scc', 'ID_SCC'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_SEC' => 'Id Sec',
			'SEC_NUMERO' => 'Sec Numero',
			'SEC_DESCRIPCION' => 'Sec Descripcion',
			'ID_SCC' => 'Id Scc',
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

		$criteria->compare('ID_SEC',$this->ID_SEC);
		$criteria->compare('SEC_NUMERO',$this->SEC_NUMERO,true);
		$criteria->compare('SEC_DESCRIPCION',$this->SEC_DESCRIPCION,true);
		$criteria->compare('ID_SCC',$this->ID_SCC);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Sec the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
         public function getConcatened()
        {
                return $this->SEC_NUMERO.' - '.$this->SEC_DESCRIPCION;
        }
}
