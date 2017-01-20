<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();
    public $logMessage = NULL;
    public $writeLog = false;

//    protected function afterAction() {
//
//        if ($this->writeLog) {
//            $model = new Transaccion;
//            $model->USUARIO = Yii::app()->user->name;
//            $model->IP_ADDRESS = $_SERVER['REMOTE_ADDR'];
//            $model->FECHA_TRANSACCION = date("Y-m-d H:i:s");
//            $model->CONTROLADOR = $this->getId();
//            $model->ACCION = $this->getAction()->getId();
//            $model->DETALLE = $this->logMessage;
//            $model->save();
//        }
//    }

    public function init() {
        // register class paths for extension captcha extended
        Yii::$classMap = array_merge(Yii::$classMap, array(
            'CaptchaExtendedAction' => Yii::getPathOfAlias('ext.captchaExtended') . DIRECTORY_SEPARATOR . 'CaptchaExtendedAction.php',
            'CaptchaExtendedValidator' => Yii::getPathOfAlias('ext.captchaExtended') . DIRECTORY_SEPARATOR . 'CaptchaExtendedValidator.php'
        ));
    }

}
