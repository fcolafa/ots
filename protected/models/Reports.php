<?php

/**
 * Reports class.
 * Reports is the data structure for keeping
 * Reports form data. It is used by the 'Sales' action of 'Sales'.
 */
class Reports extends CFormModel {

    /**
     * Declares the validation rules.
     */
    public $type;
    public $range;
    public $company;
    public $initdate;
    public $endate;
    public $data = array();
    public $contractor;
    public $costc;

    public function rules() {
        return array(
            //array('_year', 'numerical', 'integerOnly'=>true),
            array('type, range', 'required'),
            array('contractor,', 'required', 'on' => 'rcontractor'),
            array('costc,', 'required', 'on' => 'rcc'),
            array('data', 'getData'),
            array('costc, contractor, data, company, range, type, initdate, endate', 'safe'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'verifyCode' => Yii::t('database', 'Verification Code'),
            'year' => Yii::t('database', 'Año'),
            'type' => Yii::t('database', 'Tipo de Reporte'),
            'initdate' => Yii::t('database', 'Fecha Inicial'),
            'endate' => Yii::t('database', 'Fecha final'),
            'range' => Yii::t('database', 'tipo de rango'),
            'company' => Yii::t('database', 'Empresa'),
            'contractor' => Yii::t('database', 'Contratistas'),
            'costc' => Yii::t('database', 'Centro de costos'),
        );
    }

    public function years() {
        $year = "SELECT year(t.ticket_date) as y FROM `ticket` `t` GROUP BY year(t.ticket_date)";
        $years = Yii::app()->db->createCommand($year)->queryAll();
        $yfinal = array();

        foreach ($years as $y) {
            $yfinal[$y['y']] = $y['y'];
        }
        return $yfinal;
    }

    public function types() {
        return array(1 => 'Reporte por Contratista');
    }

    public function range() {
        return array(1 => 'Global', 2 => 'Entre Rango de tiempo');
    }

    public function validDate($attribute) {
        if (empty($this->$attribute) && $this->_type == '1')
            $this->addError($attribute, Yii::t('yii', '{attribute} cannot be blank.', array('{attribute}' => Yii::t('database', $attribute))));
    }

    public function validRange($attribute) {
        if (empty($this->$attribute) && $this->_type == '2')
            $this->addError($attribute, Yii::t('yii', '{attribute} cannot be blank.', array('{attribute}' => Yii::t('database', $attribute))));
    }

    public function haveTicket() {
        if (!empty($this->_initdate) && !empty($this->_endate) && $this->_type == '1') {
            $initdate = Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm', $this->_initdate);
            $endate = Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm', $this->_endate);
            $criteria = new CDbCriteria();
            $criteria->condition = "t.ticket_date between '" . $initdate . "' and '" . $endate . "'";
            $ticket = Ticket::model()->findAll($criteria);

            if (empty($ticket))
                $this->addError('initdate', 'No exiten datos asociadas entre ' . $this->_initdate . ' y ' . $this->_endate);
        }
    }

    public function getData() {

        $condition = "";
        $ndata = 0;
        if ($this->range == 2) {
            if (empty($this->initdate) || empty($this->endate))
                $this->addError('data', 'Fecha Inicial o Final no puede estar vacia');
            else {
                $initdate = Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm', $this->initdate);
                $endate = Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm', $this->endate);
            }
        }
        $criteria = new CDbCriteria();
        if (!empty($this->type))
            if ($this->type == 1 && !empty($this->contractor)) {
                foreach ($this->contractor as $con) {
                 
                    $criteria->with = array('iDOT');
                    $criteria->together = true;
                    $criteria->condition = 'iDOT.ID_CONTRATISTA=' . $con . ' AND iDOT.VOBO_GERENTE_GRAL=1';
                    $criteria->order = 'iDOT.ID_OT,CAST(NUMERO_SUB_ITEM AS DECIMAL) ASC';
                    if ($this->range == 2)
                        $criteria->addBetweenCondition('iDOT.FECHA_OT', $initdate, $endate);
                    $ins = InsumosOT::model()->findAll($criteria);

                    if (!empty($ins)) {
                        $this->data[$con] = $ins;
                        $ndata++;
                    }
                }
               
            }else
            if($this->type==2 && !empty($this->costc)){
                foreach($this->costc as $cc){
                    $criteria->with=array('iDOT');
                    $criteria->together = true;
                    $criteria->condition='ID_CENTRO_COSTO='.$cc. ' AND iDOT.VOBO_GERENTE_GRAL=1';
                    $criteria->order = 'iDOT.ID_OT,CAST(NUMERO_SUB_ITEM AS DECIMAL) ASC';
                    if ($this->range == 2)
                        $criteria->addBetweenCondition('iDOT.FECHA_OT', $initdate, $endate);
                    $ins = InsumosOT::model()->findAll($criteria);
                }
                
            }
             if ($ndata == 0)
                    $this->data['error'] = 'prueba';
    }

}
