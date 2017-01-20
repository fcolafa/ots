<?php

/**
 * This is the model class for table "orden_trabajo".
 *
 * The followings are the available columns in table 'orden_trabajo':
 * @property integer $ID_OT
 * @property integer $ID_EMPRESA
 * @property integer $ID_TIPO_OT
 * @property integer $APLICA_IVA
 * @property integer $ID_TIPO_MONEDA
 * @property string $VALOR_MONEDA
 * @property integer $ID_CONTRATISTA
 * @property integer $USUARIO_CREADOR
 * @property integer $SOLICITANTE
 * @property integer $ID_DEPARTAMENTO
 * @property integer $SUPERVISOR
 * @property string $FECHA_OT
 * @property string $FECHA_EJECUCION
 * @property string $DESCRIPCION_OT
 * @property string $ARCHIVO_ADJUNTO
 * @property integer $VOBO_JEFE_DPTO
 * @property string $FECHA_VOBO_JDPTO
 * @property integer $USUARIO_VOBO_JDPTO
 * @property integer $VOBO_ADMIN
 * @property string $FECHA_VOBO_ADMIN
 * @property integer $USUARIO_VOBO_ADMIN
 * @property integer $VOBO_GERENTE_OP
 * @property string $FECHA_VOBO_GOP
 * @property integer $USUARIO_VOBO_GOP
 * @property integer $VOBO_GERENTE_GRAL
 * @property string $FECHA_VOBO_GG
 * @property integer $USUARIO_VOBO_GG
 * @property integer $RECHAZAR_OT
 * @property integer $USUARIO_RECHAZA
 * @property string $MOTIVO_RECHAZO
 * @property integer $APROBADO_I25
 *
 * The followings are the available model relations:
 * @property Consulta[] $consultas
 * @property Cotizacion[] $cotizacions
 * @property InsumosOt[] $insumosOts
 * @property Contratista $iDCONTRATISTA
 * @property Personal $uSUARIOCREADOR
 * @property Departamentos $iDDEPARTAMENTO
 * @property Empresa $iDEMPRESA
 * @property Personal $sUPERVISOR
 * @property TipoDeOt $iDTIPOOT
 * 
 */
class OrdenTrabajo extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public $_cot = array();
    public $_rutcontratista;
    public $_departamento;

    public function tableName() {
        return 'orden_trabajo';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ID_EMPRESA, ID_CONTRATISTA, ID_DEPARTAMENTO, ID_TIPO_OT, FECHA_EJECUCION, FECHA_OT, ID_TIPO_MONEDA, VALOR_MONEDA, APLICA_IVA', 'required'),
            array('NUMERO_OT, APROBADO_I25, ID_OT, ID_EMPRESA, ID_CONTRATISTA, SUPERVISOR, ID_DEPARTAMENTO, ID_TIPO_OT, VOBO_JEFE_DPTO, VOBO_ADMIN, VOBO_GERENTE_OP, VOBO_GERENTE_GRAL, RECHAZAR_OT', 'numerical', 'integerOnly' => true),
            array('SOLICITANTE', 'length', 'max' => 250),
            array('_cot', 'validFile'),
            array('FECHA_EJECUCION, FECHA_OT', 'formateaFecha'),
            array('_empresa,FECHA_EJECUCION, DESCRIPCION_OT, FECHA_OT, MOTIVO_RECHAZO, RECHAZAR_OT, MOTIVO_RECHAZO', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('NUMERO_OT, _rutcontratista, _cot ,APROBADO_I25, ID_OT, ID_EMPRESA, ID_CONTRATISTA, SOLICITANTE, SUPERVISOR, ID_DEPARTAMENTO, FECHA_EJECUCION, ID_TIPO_OT, DESCRIPCION_OT, FECHA_OT, VOBO_JEFE_DPTO, VOBO_ADMIN, VOBO_GERENTE_OP, VOBO_GERENTE_GRAL', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'cotizacions' => array(self::HAS_MANY, 'Cotizacion', 'ID_OT'),
            'insumos_ot' => array(self::HAS_MANY, 'InsumosOT', 'ID_OT'),
            'contratista' => array(self::BELONGS_TO, 'Contratista', 'ID_CONTRATISTA'),
            'departamentos' => array(self::BELONGS_TO, 'Departamentos', 'ID_DEPARTAMENTO'),
            'empresa' => array(self::BELONGS_TO, 'Empresa', 'ID_EMPRESA'),
            //'personal' => array(self::BELONGS_TO, 'Personal', 'SUPERVISOR'),
            'personal' => array(self::BELONGS_TO, 'Personal', 'SUPERVISOR'),
            'supervisor' => array(self::BELONGS_TO, 'Personal', 'SUPERVISOR'),
            'tipo_de_ot' => array(self::BELONGS_TO, 'TipoDeOT', 'ID_TIPO_OT'),
            'tipo_moneda' => array(self::BELONGS_TO, 'TipoMoneda', 'ID_TIPO_MONEDA'),
            'creador' => array(self::BELONGS_TO, 'Personal', 'USUARIO_CREADOR'),
            'solicitante' => array(self::BELONGS_TO, 'Personal', 'SOLICITANTE'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID_OT' => 'ID OT',
            'NUMERO_OT' => 'N° OT',
            'ID_EMPRESA' => 'Empresa',
            'ID_TIPO_MONEDA' => 'Id Tipo Moneda',
            'APLICA_IVA' => 'Aplica IVA',
            'ID_CONTRATISTA' => 'Contratista',
            'SOLICITANTE' => 'Solicitante',
            'SUPERVISOR' => 'Supervisor',
            'ID_DEPARTAMENTO' => 'Departamento',
            'FECHA_EJECUCION' => 'Fecha Ejecucion',
            'ID_TIPO_OT' => 'Tipo OT',
            'DESCRIPCION_OT' => 'Descripción OT',
            'FECHA_OT' => 'Fecha OT',
            'VOBO_JEFE_DPTO' => 'V°B° Jefe Depto.',
            'VOBO_ADMIN' => 'V°B° Jefe Administrativo',
            'VOBO_GERENTE_OP' => 'V°B° Gerente Planta',
            'VOBO_GERENTE_GRAL' => 'V°B° Gerente Zonal',
            'RECHAZAR_OT' => 'Rechazar OT',
            'MOTIVO_RECHAZO' => 'Motivo Rechazo',
            'APROBADO_I25' => 'por definir Aprobado cuando es inferior a 2500 USS',
            '_rutcontratista' => 'Rut Contratista',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->with = array('contratista');
        $criteria->together = true;
        $criteria->order = 'NUMERO_OT DESC';
        $criteria->compare('ID_OT', $this->ID_OT);
        $criteria->compare('NUMERO_OT', $this->NUMERO_OT);
        $criteria->compare('ID_CONTRATISTA', $this->ID_CONTRATISTA);
        $criteria->compare('SOLICITANTE', $this->SOLICITANTE, true);
        $criteria->compare('SUPERVISOR', $this->SUPERVISOR);
        $criteria->compare('ID_DEPARTAMENTO', $this->ID_DEPARTAMENTO);
        $criteria->compare('FECHA_EJECUCION', $this->FECHA_EJECUCION, true);
        $criteria->compare('ID_TIPO_OT', $this->ID_TIPO_OT);
        $criteria->compare('DESCRIPCION_OT', $this->DESCRIPCION_OT, true);
        $criteria->compare('FECHA_OT', $this->FECHA_OT, true);
        $criteria->compare('VOBO_ADMIN', $this->VOBO_ADMIN);
        $criteria->compare('VOBO_JEFE_DPTO', $this->VOBO_JEFE_DPTO);
        $criteria->compare('VOBO_GERENTE_GRAL', $this->VOBO_GERENTE_GRAL);
        $criteria->compare('VOBO_GERENTE_OP', $this->VOBO_GERENTE_OP);
        $criteria->compare('contratista.RUT_CONTRATISTA', $this->_rutcontratista, true);

        $usuario = Personal::model()->findByPk(Yii::app()->user->id);

        if (Yii::app()->user->JDP() && $usuario->iDDEPARTAMENTO->NOMBRE_DEPARTAMENTO == 'Logística') {
            $criteria->with = array('creador');
            $criteria->together = true;
            $criteria->condition = 't.ID_EMPRESA=' . Yii::app()->getSession()->get('id_empresa') . ' AND creador.ID_DEPARTAMENTO=' . $usuario->ID_DEPARTAMENTO;
        } else {
            $criteria->condition = 't.ID_EMPRESA=' . Yii::app()->getSession()->get('id_empresa') . ' AND USUARIO_CREADOR=' . Yii::app()->user->id;
        }
        if (Yii::app()->user->ADM()) {
            $criteria->compare('VOBO_JEFE_DPTO', 1);
        } elseif (Yii::app()->user->GOP()) {
            $criteria->compare('VOBO_JEFE_DPTO', 1);
            $criteria->compare('VOBO_ADMIN', 1);
        } elseif (Yii::app()->user->GG()) {
            $criteria->compare('VOBO_JEFE_DPTO', 1);
            $criteria->compare('VOBO_ADMIN', 1);
            $criteria->compare('VOBO_GERENTE_OP', 1);
        }


        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchAllcompany() {
        // @todo Please modify the following code to remove attributes that should not be searched.
        $criteria = new CDbCriteria;
        $criteria->with = array('contratista');
        $criteria->together = true;
        $criteria->order = 'NUMERO_OT DESC, t.ID_EMPRESA ASC';
        $criteria->compare('ID_OT', $this->ID_OT);
        $criteria->compare('NUMERO_OT', $this->NUMERO_OT);
        $criteria->compare('ID_CONTRATISTA', $this->ID_CONTRATISTA);
        $criteria->compare('t.ID_EMPRESA', $this->ID_EMPRESA);
        $criteria->compare('SOLICITANTE', $this->SOLICITANTE, true);
        $criteria->compare('SUPERVISOR', $this->SUPERVISOR);
         $criteria->compare('ID_DEPARTAMENTO', $this->ID_DEPARTAMENTO);
        $criteria->compare('FECHA_EJECUCION', $this->FECHA_EJECUCION, true);
        $criteria->compare('ID_TIPO_OT', $this->ID_TIPO_OT);
        $criteria->compare('DESCRIPCION_OT', $this->DESCRIPCION_OT, true);
        $criteria->compare('FECHA_OT', $this->FECHA_OT, true);
        $criteria->compare('VOBO_ADMIN', $this->VOBO_ADMIN);
        $criteria->compare('VOBO_JEFE_DPTO', $this->VOBO_JEFE_DPTO);
        $criteria->compare('VOBO_GERENTE_GRAL', $this->VOBO_GERENTE_GRAL);
        $criteria->compare('VOBO_GERENTE_OP', $this->VOBO_GERENTE_OP);
        //$criteria->compare('empresa.NOMBRE_EMPRESA', $this->_empresa, true);
        $criteria->compare('contratista.RUT_CONTRATISTA', $this->_rutcontratista, true);
        //si la empresa es la Portada
        //
                //
		
    if (Yii::app()->user->GOP()) {
            $criteria->compare('VOBO_JEFE_DPTO', 1);
            $criteria->compare('VOBO_ADMIN', 1);
        } elseif (Yii::app()->user->GG()) {
            $criteria->compare('VOBO_JEFE_DPTO', 1);
            $criteria->compare('VOBO_ADMIN', 1);
            $criteria->compare('VOBO_GERENTE_OP', 1);
        }


        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getNumberOTP() {
        if (!Yii::app()->user->isGuest) {
            $criteria = new CDbCriteria();
            if (Yii::app()->user->allCompany() != 1) {
                $idempresa = Yii::app()->getSession()->get('id_empresa');
                $condition = 't.ID_EMPRESA';
                if (!empty($idempresa))
                    $condition.="=" . $idempresa;
                else
                    $condition.=' IS NOT NULL';
                $condition.=' AND ';
            } else
                $condition = '';
            $usuario = Personal::model()->findByPk(Yii::app()->user->id);
            if (Yii::app()->user->ADM())
                $condition.='VOBO_ADMIN=0 AND RECHAZAR_OT <> 1';
            elseif (Yii::app()->user->GOP())
                $condition.="VOBO_JEFE_DPTO=1 AND VOBO_ADMIN=1 AND VOBO_GERENTE_OP=0 AND RECHAZAR_OT <> 1";
            elseif (Yii::app()->user->JDP() && $usuario->iDDEPARTAMENTO->NOMBRE_DEPARTAMENTO == 'Logística') {
                //   die ($usuario->iDDEPARTAMENTO->NOMBRE_DEPARTAMENTO);
                $criteria->with = array('creador');
                $criteria->together = true;
                $condition.='VOBO_JEFE_DPTO=0 AND RECHAZAR_OT <> 1 AND creador.ID_DEPARTAMENTO=' . $usuario->ID_DEPARTAMENTO;
            } elseif (Yii::app()->user->JDP() || Yii::app()->user->LOG())
                $condition.='VOBO_JEFE_DPTO=0 AND RECHAZAR_OT <> 1 AND  USUARIO_CREADOR=' . Yii::app()->user->id;
            elseif (Yii::app()->user->GG())
                $condition.="VOBO_GERENTE_OP=1 AND VOBO_JEFE_DPTO=1 AND VOBO_ADMIN=1 AND VOBO_GERENTE_GRAL=0 AND RECHAZAR_OT <> 1";
            elseif (Yii::app()->user->A1())
                $condition.='VOBO_JEFE_DPTO=0 AND RECHAZAR_OT <> 1';
            $criteria->condition = $condition;
            $number = count(CHtml::listData(OrdenTrabajo::model()->findAll($criteria), 'ID_OT', 'ID_OT'));
            return $number;
        }
    }

    public function getNumberOTA() {

        if (!Yii::app()->user->isGuest) {
            $criteria = new CDbCriteria();
            if (Yii::app()->user->allCompany() != 1) {
                $condition = "";
                $idempresa = Yii::app()->getSession()->get('id_empresa');

                $condition = 't.ID_EMPRESA';
                if (!empty($idempresa))
                    $condition.="=" . $idempresa;
                else
                    $condition.=' IS NOT NULL ';
                $condition.=' AND ';
            } else
                $condition = '';
            $usuario = Personal::model()->findByPk(Yii::app()->user->id);
            // die ($usuario->iDDEPARTAMENTO->NOMBRE_DEPARTAMENTO);
            if (Yii::app()->user->ADM())
                $condition.='VOBO_JEFE_DPTO=1 AND VOBO_ADMIN=1 AND RECHAZAR_OT <> 1';
            elseif (Yii::app()->user->JDP() && $usuario->iDDEPARTAMENTO->NOMBRE_DEPARTAMENTO == 'Logística') {
                //   die ($usuario->iDDEPARTAMENTO->NOMBRE_DEPARTAMENTO);
                $criteria->with = array('creador');
                $criteria->together = true;
                $condition.='VOBO_JEFE_DPTO=1 AND RECHAZAR_OT <> 1 AND creador.ID_DEPARTAMENTO=' . $usuario->ID_DEPARTAMENTO;
            } elseif (Yii::app()->user->JDP() || Yii::app()->user->LOG())
                $condition.='VOBO_JEFE_DPTO=1 AND RECHAZAR_OT <> 1 AND  USUARIO_CREADOR=' . Yii::app()->user->id;
            elseif (Yii::app()->user->GOP())
                $condition.="VOBO_JEFE_DPTO=1 AND VOBO_ADMIN=1 AND VOBO_GERENTE_OP=1 AND RECHAZAR_OT <> 1";
            elseif (Yii::app()->user->GG())
                $condition.="VOBO_JEFE_DPTO=1 AND VOBO_ADMIN=1 AND VOBO_GERENTE_OP=1 AND VOBO_GERENTE_GRAL=1 AND RECHAZAR_OT <> 1";
            elseif (Yii::app()->user->A1())
                $condition.='VOBO_JEFE_DPTO=1 AND RECHAZAR_OT <> 1';


            $criteria->condition = $condition;
            $number = count(CHtml::listData(OrdenTrabajo::model()->findAll($criteria), 'ID_OT', 'ID_OT'));
            return $number;
        }
    }

    public function getNumberOTR() {
        if (!Yii::app()->user->isGuest) {
            $criteria = new CDbCriteria();
            if (Yii::app()->user->allCompany() != 1) {
                $condition = "";
                $idempresa = Yii::app()->getSession()->get('id_empresa');
                $condition = 't.ID_EMPRESA';
                if (!empty($idempresa))
                    $condition.="=" . $idempresa;
                else
                    $condition.=' IS NOT NULL ';
                $condition.=' AND ';
            } else
                $condition = '';
            $usuario = Personal::model()->findByPk(Yii::app()->user->id);
            if (Yii::app()->user->ADM())
                $condition.='RECHAZAR_OT=1';
            elseif (Yii::app()->user->A1())
                $condition.='RECHAZAR_OT =1';
            elseif (Yii::app()->user->JDP() && $usuario->iDDEPARTAMENTO->NOMBRE_DEPARTAMENTO == 'Logística') {
                //   die ($usuario->iDDEPARTAMENTO->NOMBRE_DEPARTAMENTO);
                $criteria->with = array('creador');
                $criteria->together = true;
                $condition.='RECHAZAR_OT = 1 AND creador.ID_DEPARTAMENTO=' . $usuario->ID_DEPARTAMENTO;
            } elseif (Yii::app()->user->JDP() || Yii::app()->user->LOG())
                $condition.='RECHAZAR_OT = 1 AND  USUARIO_CREADOR=' . Yii::app()->user->id;
            elseif (Yii::app()->user->GOP())
                $condition.="VOBO_JEFE_DPTO=1 AND VOBO_ADMIN=1 AND RECHAZAR_OT = 1";
            elseif (Yii::app()->user->GG())
                $condition.="VOBO_JEFE_DPTO=1 AND VOBO_ADMIN=1 AND VOBO_GERENTE_OP=1 AND RECHAZAR_OT = 1";

            $criteria->condition = $condition;
            $number = count(CHtml::listData(OrdenTrabajo::model()->findAll($criteria), 'ID_OT', 'ID_OT'));
            return $number;
        }
    }

    public function formateaFecha($attribute, $params) {
        $this->FECHA_EJECUCION = Yii::app()->dateFormatter->format('yyyy-MM-dd', $this->FECHA_EJECUCION);
        $this->FECHA_OT = Yii::app()->dateFormatter->format('yyyy-MM-dd', $this->FECHA_OT);
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return OrdenTrabajo the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getTax() {
        return array('1' => 'Afecto a IVA', '2' => 'Exento', '3' => 'Boleta Honorario (-10%)');
    }

    public function validFile($model, $attribute) {
        $newfile = array();
        if (!empty($this->_cot)) {
            foreach ($this->_cot as $key => $value) {
                $newfile[$value] = $value;
            }
            $this->_cot = $newfile;
        }
    }

    public function getCotFile() {
        $criteria = new CDbCriteria();
        $criteria->condition = 't.ID_OT=' . $this->ID_OT;
        $cotfile = Cotizacion::model()->findall($criteria);

        $link = "<div id='tblCot'>";
        foreach ($cotfile as $t) {
            if ($t->DEF_COT == 1)
                $check = ", check";
            else
                $check = "";
            $link.=CHtml::link(CHtml::encode($t->NOMBRE_ARCHIVO), Yii::app()->baseUrl . '/archivos/cot/' . $t->ID_OT . "/" . $t->NOMBRE_ARCHIVO, array('target' => '_blank', 'class' => 'attach' . ' ' . $check)) . ' <div class="btn btn-success pad" >' . CHtml::link('Aprobar Cotización', array('cotizacion/approveCot', 'id' => $t->ID_COTIZACION), array('target' => '_blank')) . "</div>";
            $link.="<br>";
        }
        $link.="</div>";
        if ($cotfile)
            return $link;
        else
            return null;
    }

    public function getImage($rechazo, $gg) {
        if ($rechazo == 1)
            return "../themes/default/img/icons/reprove.png";
        elseif ($gg == 1)
            return "../themes/default/img/icons/aprove.png";
        else
            return "../themes/default/img/icons/pending.png";
    }

}
