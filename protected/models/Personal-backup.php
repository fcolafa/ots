<?php

/**
 * This is the model class for table "personal".
 *
 * The followings are the available columns in table 'personal':
 * @property integer $ID_PERSONA
 * @property integer $ID_EMPRESA
 * @property string $RUT_PERSONA
 * @property string $NOMBRE_PERSONA
 * @property string $APELLIDO_PERSONA
 * @property string $TELEFONO
 * @property string $EMAIL
 * @property integer $ID_CARGO
 * @property integer $ID_DEPARTAMENTO
 * @property string $ES_SUPERVISOR
 * @property string $COD_TIPO_USUARIO
 * @property string $CONTRASENA
 * @property integer $NIVEL_APROBACION
 * @property integer $MONTO_APROBACION
 * @property string $ESTADO_TRABAJADOR
 *
 * The followings are the available model relations:
 * @property OrdenTrabajo[] $ordenTrabajos
 * @property Cargos $iDCARGO
 * @property Departamentos $iDDEPARTAMENTO
 * @property Empresa $iDEMPRESA
 * @property TipoUsuario $cODTIPOUSUARIO
 */
class Personal extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'personal';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_EMPRESA, RUT_PERSONA, NOMBRE_PERSONA, APELLIDO_PERSONA, ID_DEPARTAMENTO', 'required'),
			array('ID_PERSONA, ID_EMPRESA, ID_CARGO, ID_DEPARTAMENTO, ES_USUARIO, APRUEBA_DOCS', 'numerical', 'integerOnly'=>true),
			array('RUT_PERSONA', 'length', 'max'=>15),
			array('NOMBRE_PERSONA, APELLIDO_PERSONA, EMAIL', 'length', 'max'=>50),
			array('TELEFONO', 'length', 'max'=>20),
			array('ES_SUPERVISOR, ESTADO_TRABAJADOR, ES_USUARIO, APRUEBA_DOCS, ESTADO_TRABAJADOR', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_PERSONA, ID_EMPRESA, RUT_PERSONA, NOMBRE_PERSONA, APELLIDO_PERSONA, TELEFONO, EMAIL, ID_CARGO, ID_DEPARTAMENTO, ES_SUPERVISOR, ES_USUARIO, APRUEBA_DOCS, ESTADO_TRABAJADOR', 'safe', 'on'=>'search'),
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
			'ordenTrabajos' => array(self::HAS_MANY, 'OrdenTrabajo', 'SUPERVISOR'),
			'iDCARGO' => array(self::BELONGS_TO, 'Cargos', 'ID_CARGO'),
			'iDDEPARTAMENTO' => array(self::BELONGS_TO, 'Departamentos', 'ID_DEPARTAMENTO'),
			'iDEMPRESA' => array(self::BELONGS_TO, 'Empresa', 'ID_EMPRESA'),
			'cODTIPOUSUARIO' => array(self::BELONGS_TO, 'TipoUsuario', 'COD_TIPO_USUARIO'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_PERSONA' => 'Persona',
			'ID_EMPRESA' => 'Empresa',
			'RUT_PERSONA' => 'Rut',
			'NOMBRE_PERSONA' => 'Nombre',
			'APELLIDO_PERSONA' => 'Apellido',
			'TELEFONO' => 'Telefono',
			'EMAIL' => 'Email',
			'ID_CARGO' => 'Cargo',
			'ID_DEPARTAMENTO' => 'Departamento',
			'ES_SUPERVISOR' => 'Supervisor',
			'ESTADO_TRABAJADOR' => 'Estado Trabajador',
			'ES_USUARIO' => 'Es Usuario', 
			'APRUEBA_DOCS' => 'Aprueba Documentos',
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

		$criteria->compare('ID_PERSONA',$this->ID_PERSONA);
		$criteria->compare('ID_EMPRESA',$this->ID_EMPRESA);
		$criteria->compare('RUT_PERSONA',$this->RUT_PERSONA,true);
		$criteria->compare('NOMBRE_PERSONA',$this->NOMBRE_PERSONA,true);
		$criteria->compare('APELLIDO_PERSONA',$this->APELLIDO_PERSONA,true);
		$criteria->compare('TELEFONO',$this->TELEFONO,true);
		$criteria->compare('EMAIL',$this->EMAIL,true);
		$criteria->compare('ID_CARGO',$this->ID_CARGO);
		$criteria->compare('ID_DEPARTAMENTO',$this->ID_DEPARTAMENTO);
		$criteria->compare('ES_SUPERVISOR',$this->ES_SUPERVISOR,true);
		$criteria->compare('ESTADO_TRABAJADOR',$this->ESTADO_TRABAJADOR,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Personal the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function validatePassword($password)
	{
		return $password === $this->CONTRASENA;
	}

	public static function getNivelAprobacion()
	{
		return array('1'=>'Gerente General','2'=>'Gerente de Operaciones','3'=>'Administrador','4'=>'Jefe de Departamento','5'=>'No aprueba OT');
	}

	public static function getPersonal(){
		return CHtml::listData(Personal::model()->findAll(), 'ID_PERSONA', 'NOMBRE_PERSONA' );
	}
}
