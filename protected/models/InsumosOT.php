<?php

/**
 * This is the model class for table "insumos_ot".
 *
 * The followings are the available columns in table 'insumos_ot':
 * @property integer $ID_INSUMOS_OT
 * @property integer $ID_OT
 * @property string $NUMERO_SUB_ITEM
 * @property string $NOMBRE_SUB_ITEM
 * @property string $COSTO_CONTRATISTA
 * @property string $NRO_COTIZACION
 *
 * The followings are the available model relations:
 * @property OrdenTrabajo $iDOT
 */
class InsumosOT extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'insumos_ot';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_OT, NUMERO_SUB_ITEM, NOMBRE_SUB_ITEM, COSTO_CONTRATISTA, ID_CENTRO_COSTO', 'required'),
			array('ID_INSUMOS_OT, ID_OT, ID_CENTRO_COSTO, ID_CCC, ID_SEC, ID_SCC', 'numerical', 'integerOnly'=>true),
			array('NUMERO_SUB_ITEM', 'length', 'max'=>6),
			array('NOMBRE_SUB_ITEM', 'length', 'max'=>150),
			array('COSTO_CONTRATISTA', 'length', 'max'=>10),
			array('NRO_COTIZACION', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_CCC, ID_SEC, ID_SCC, ID_INSUMOS_OT, ID_OT, NUMERO_SUB_ITEM, NOMBRE_SUB_ITEM, COSTO_CONTRATISTA, NRO_COTIZACION', 'safe', 'on'=>'search'),
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
			'iDOT' => array(self::BELONGS_TO, 'OrdenTrabajo', 'ID_OT'),
			'centroCosto' => array(self::BELONGS_TO, 'CentroDeCostos', 'ID_CENTRO_COSTO'),
                        'iDCCC' => array(self::BELONGS_TO, 'Ccc', 'ID_CCC'),
			'iDSCC' => array(self::BELONGS_TO, 'Scc', 'ID_SCC'),
			'iDSEC' => array(self::BELONGS_TO, 'Sec', 'ID_SEC'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_INSUMOS_OT' => 'Id Insumos Ot',
			'ID_OT' => 'Id Ot',
			'NUMERO_SUB_ITEM' => 'Numero Sub Item',
			'NOMBRE_SUB_ITEM' => 'Nombre Sub Item',
			'COSTO_CONTRATISTA' => 'Costo Contratista',
			'NRO_COTIZACION' => 'Nro Cotizacion',
			'ID_CENTRO_COSTO' => 'Centro Costo',
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

		$criteria->compare('ID_INSUMOS_OT',$this->ID_INSUMOS_OT);
		$criteria->compare('ID_OT',$this->ID_OT);
		$criteria->compare('NUMERO_SUB_ITEM',$this->NUMERO_SUB_ITEM,true);
		$criteria->compare('NOMBRE_SUB_ITEM',$this->NOMBRE_SUB_ITEM,true);
		$criteria->compare('COSTO_CONTRATISTA',$this->COSTO_CONTRATISTA,true);
		$criteria->compare('NRO_COTIZACION',$this->NRO_COTIZACION,true);
                $criteria->compare('ID_CENTRO_COSTO',$this->ID_CENTRO_COSTO);
		
		$criteria->compare('ID_SUB_CENTRO_COSTO',$this->ID_SUB_CENTRO_COSTO);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InsumosOT the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
