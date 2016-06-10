<?php

/**
 * This is the model class for table "cotizacion".
 *
 * The followings are the available columns in table 'cotizacion':
 * @property integer $ID_COTIZACION
 * @property string $NOMBRE_ARCHIVO
 * @property integer $ID_OT
 * @property string $COMENTARIOS_COTIZACION
 * @property integer $DEF_COT
 *
 * The followings are the available model relations:
 * @property OrdenTrabajo $iDOT
 */
class Cotizacion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cotizacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_OT', 'required'),
			array('ID_OT, DEF_COT', 'numerical', 'integerOnly'=>true),
			array('NOMBRE_ARCHIVO', 'length', 'max'=>45),
			array('COMENTARIOS_COTIZACION', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_COTIZACION, NOMBRE_ARCHIVO, ID_OT, COMENTARIOS_COTIZACION, DEF_COT', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_COTIZACION' => 'Id Cotizacion',
			'NOMBRE_ARCHIVO' => 'Nombre Archivo',
			'ID_OT' => 'Id Ot',
			'COMENTARIOS_COTIZACION' => 'Comentarios Cotizacion',
			'DEF_COT' => 'Def Cot',
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

		$criteria->compare('ID_COTIZACION',$this->ID_COTIZACION);
		$criteria->compare('NOMBRE_ARCHIVO',$this->NOMBRE_ARCHIVO,true);
		$criteria->compare('ID_OT',$this->ID_OT);
		$criteria->compare('COMENTARIOS_COTIZACION',$this->COMENTARIOS_COTIZACION,true);
		$criteria->compare('DEF_COT',$this->DEF_COT);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cotizacion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public function getFile($id){
            $model= Cotizacion::model()->findByPk($id);
            
            $ext=explode('.', $model->NOMBRE_ARCHIVO);
            if($ext[1]=='pdf'||$ext[1]=='PDF')
                $image='<embed src="'.Yii::app()->baseUrl.'/archivos/cot/'.$model->ID_OT.'/'.$model->NOMBRE_ARCHIVO.'"  height="100%" width="100%">';
            else
                $image=CHtml::image(Yii::app()->request->baseUrl.'/archivos/cot/'.$model->ID_OT.'/'.$model->NOMBRE_ARCHIVO);
            
          
           
         /**
           $image='<object type="application/pdf" data="slax.pdf#toolbar=1&amp;navpanes=0&amp;scrollbar=1" '.
            'width="900" height="500">'.
            '<param name="src" value="slax.pdf#toolbar=1&amp;navpanes=0&amp;scrollbar=1" />.'.
            '<p style="text-align:center; width: 60%;">Adobe Reader no se encuentra o la versión no es compatible, .'.
            'utiliza el icono para ir a la página de descarga <br />'.
            '<a href="http://get.adobe.com/es/reader/" onclick="this.target=_blank">'.
            '<img src="'.Yii::app()->baseUrl.'/archivos/cot/'.$model->ID_OT.'/'.$model->NOMBRE_ARCHIVO.'” " alt="Descargar Adobe Reader" '.
            'width="32" height="32" style="border: none;" /></a></p>'.
            '</object>';
           **/
           //$link= CHtml::link(CHtml::encode($model->NOMBRE_ARCHIVO), Yii::app()->baseUrl . '/archivos/cot/'.$model->ID_OT."/". $model->NOMBRE_ARCHIVO,array('target'=>'_blank','class'=>'attach'));
        
           return $image;
        }
}
