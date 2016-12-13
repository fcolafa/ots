<?php

/**
 * This is the model class for table "ticket".
 *
 * The followings are the available columns in table 'ticket':
 * @property integer $ID_TICKET
 * @property string $ASUNTO_TICKET
 * @property string $DESCRIPCION_TICKET
 * @property string $FECHA_TICKET
 * @property integer $ID_PERSONA
 *
 * The followings are the available model relations:
 * @property ArchivoTicket[] $archivoTickets
 * @property Personal $iDPERSONA
 * @property TicketMensaje[] $ticketMensajes
 */
class Ticket extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public $_verifyCode;
    public $_files = array();

    public function tableName() {
        return 'ticket';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ID_PERSONA, ASUNTO_TICKET, DESCRIPCION_TICKET', 'required'),
            array('ID_PERSONA', 'numerical', 'integerOnly' => true),
            array('ASUNTO_TICKET', 'length', 'max' => 100),
            array('DESCRIPCION_TICKET, FECHA_TICKET', 'safe'),
            array('ESTADO_TICKET', 'length', 'max' => 45),
            array('_files', 'validFile'),
            array('_verifyCode', 'CaptchaExtendedValidator', 'allowEmpty' => !CCaptcha::checkRequirements()),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ID_TICKET, ASUNTO_TICKET, DESCRIPCION_TICKET, FECHA_TICKET, ID_PERSONA, ESTADO_TICKET', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'archivoTickets' => array(self::HAS_MANY, 'ArchivoTicket', 'ID_TICKET'),
            'iDPERSONA' => array(self::BELONGS_TO, 'Personal', 'ID_PERSONA'),
            'ticketMensajes' => array(self::HAS_MANY, 'TicketMensaje', 'ID_TICKET'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID_TICKET' => 'N° Ticket',
            'ASUNTO_TICKET' => 'Asunto',
            'DESCRIPCION_TICKET' => 'Descripcion',
            'FECHA_TICKET' => 'Fecha Ticket',
            'ID_PERSONA' => 'Id Persona',
            'ESTADO_TICKET' => 'Estado',
            '_verifyCode' => 'Codigo Verificación',
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
        $criteria->order = 'ID_TICKET DESC';
        $criteria->compare('ID_TICKET', $this->ID_TICKET);
        $criteria->compare('ASUNTO_TICKET', $this->ASUNTO_TICKET, true);
        $criteria->compare('DESCRIPCION_TICKET', $this->DESCRIPCION_TICKET, true);
        $criteria->compare('FECHA_TICKET', $this->FECHA_TICKET, true);
        if (Yii::app()->user->A1())
            $criteria->compare('ID_PERSONA', $this->ID_PERSONA);
        else
            $criteria->compare('ID_PERSONA', Yii::app()->user->id);
        $criteria->compare('ESTADO_TICKET', $this->ESTADO_TICKET);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Ticket the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getTicketFile() {
        $criteria = new CDbCriteria();
        $criteria->condition = 't.ID_TICKET=' . $this->ID_TICKET;
        $ticketsfile = ArchivoTicket::model()->findall($criteria);
        $link = "";
        foreach ($ticketsfile as $t) {
            $link.=CHtml::link(CHtml::encode($t->NOMBRE_ARCHIVO), Yii::app()->baseUrl . '/images/tickets/' . $t->ID_TICKET . "/" . $t->NOMBRE_ARCHIVO, array('target' => '_blank')) . "<br>";
        }
        if ($ticketsfile)
            return $link;
        else
            return null;
    }

    public function validFile($model, $attribute) {
        $newfile = array();
        if (!empty($this->_files)) {
            foreach ($this->_files as $key => $value) {
                $newfile[$value] = $value;
            }
            $this->_files = $newfile;
        }
    }

    public function getNumberTC() {

        if (!Yii::app()->user->isGuest) {
            $criteria = new CDbCriteria();
            if (!Yii::app()->user->A1())
                $criteria->condition = 'ID_PERSONA=' . Yii::app()->user->id.' AND ESTADO_TICKET="Cerrado"';
             else
                $criteria->condition = 'ESTADO_TICKET="Cerrado"';
            $number = count(CHtml::listData(Ticket::model()->findAll($criteria), 'ID_TICKET', 'ID_TICKET'));
            return $number;
        }
    }
    public function getNumberTP() {
        if (!Yii::app()->user->isGuest) {
            $criteria = new CDbCriteria();
            if (!Yii::app()->user->A1())
                $criteria->condition = 'ID_PERSONA=' . Yii::app()->user->id.' AND ESTADO_TICKET="Pendiente"';
            else
                $criteria->condition = 'ESTADO_TICKET="Pendiente"';
            $number = count(CHtml::listData(Ticket::model()->findAll($criteria), 'ID_TICKET', 'ID_TICKET'));
            return $number;
        }
    }
}
