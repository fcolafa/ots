<?php

class TicketController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function actions() {

        return array(
            'captcha' => array(
                'class' => 'CaptchaExtendedAction',
                'mode' => CaptchaExtendedAction::MODE_MATH,
            ),
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            //R
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('create', 'admin', 'upload', 'captcha', 'view'),
                'users' => array('@'),
            ),
            //RU
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {

        $message = new TicketMensaje;
        $model=$this->loadModel($id);
        if(isset($_POST['closeticket'])){
            $model->ESTADO_TICKET='Cerrado';
            $model->save(false);
        }
        if (isset($_POST['TicketMensaje']) && isset($_POST['message'])) {
            $message->attributes = $_POST['TicketMensaje'];
            $message->ID_TICKET = $id;
            $message->FECHA_MENSAJE = date("y-m-d H:i:s");
            $message->ID_PERSONA_CREADOR = Yii::app()->user->id;
            if ($message->save())
                $message = new TicketMensaje;
        }
        $this->render('view', array(
            'model' => $model,
            'message' => $message
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Ticket;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);
        if (isset($_POST['Ticket'])) {
            $model->attributes = $_POST['Ticket'];
            $model->ID_PERSONA = Yii::app()->user->id;
            $model->FECHA_TICKET = date("y-m-d H:i:s");
            $model->ESTADO_TICKET = 'Pendiente';
            if (isset($_POST['Ticket']['_files']))
                $model->_files = $_POST['Ticket']['_files'];

            if ($model->save()) {
                $tempFolder = Yii::getPathOfAlias('webroot') . '/archivos/temp/';
                $newFolder = Yii::getPathOfAlias('webroot') . '/archivos/tickets/';
                if (!empty($model->_files)) {
                    $folder = $newFolder . "/" . $model->ID_TICKET;
                    if (!file_exists($folder))
                        mkdir($folder, 0777, true);
                    foreach ($model->_files as $file) {
                        if (file_exists($tempFolder . $file)) {
                            $ticketfile = new ArchivoTicket;
                            $ticketfile->ID_TICKET = $model->ID_TICKET;
                            $ticketfile->NOMBRE_ARCHIVO = $file;
                            $ticketfile->save();
                            copy($tempFolder . $ticketfile->NOMBRE_ARCHIVO, $folder . "/" . $ticketfile->NOMBRE_ARCHIVO);
                        }
                    }
                }
                $this->sendMail($model, 'Ticket de soporte Emitido Nº' . $model->ID_TICKET, 'body_ticket', 'ticket');
                $this->redirect(array('view', 'id' => $model->ID_TICKET));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }
    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Ticket');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Ticket('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Ticket']))
            $model->attributes = $_GET['Ticket'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Ticket the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Ticket::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Ticket $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ticket-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    private function sendMail($model, $subject, $view, $type = null, $content = null) {

        $mail = Yii::app()->Smtpmail;
        $mail->SMTPDebug = 1;
        $mail->CharSet = 'UTF-8';
        $mail->SetFrom('desarrollo@pcgeek.cl', 'Sistema Web Aprobacion de Documentos');
        $mail->Subject = $subject;
        $mail->MsgHTML(Yii::app()->controller->renderPartial($view, array('model' => $model, 'subject' => $subject, 'content' => $content), true));
        if ($type == 'ticket') {
            $criteria = new CDbCriteria();
            $criteria->condition = "COD_TIPO_USUARIO='A1'";
            $users = Usuarios::model()->findAll($criteria);
            foreach ($users as $u) {
                $mail->AddAddress($u->iDPERSONA->EMAIL, $subject);
            }
        } elseif ($type == 'support-response')
            $mail->AddAddress($model->iDPERSONA->EMAIL, $subject);
        if (!$mail->Send())
            Yii::app()->user->setFlash('error', Yii::t('validation', 'Error al enviar correo Electronico'));
        else
            Yii::app()->user->setFlash('success', Yii::t('validation', 'Notificación enviada por Correo Electronico'));
    }

    public function getMessages($id) {
        $criteria = new CDbCriteria();
        $criteria->condition = 'ID_TICKET=' . $id;
        $messages = TicketMensaje::model()->findAll($criteria);
        $rol = '';

        $text = '<div class="messages">';
        foreach ($messages as $message) {
            if ($message->iDPERSONACREADOR->iDUSUARIO->COD_TIPO_USUARIO == 'A1')
                $rol = '(Administrador)';
            $text.='<hr size="2px" width="90%" noshade="noshade" align="center" />';
            $text.='<p class="fechaconsult"><b>' . Yii::app()->dateFormatter->format("dd MMMM yyyy  hh:mm:ss", strtotime($message->FECHA_MENSAJE)) . '</b></p>';
            $text.='<h5 style="color:#468847;">' . $message->iDPERSONACREADOR->NOMBRE_PERSONA . ' ' . $message->iDPERSONACREADOR->APELLIDO_PERSONA . ' ' . $rol . ':<h5>';
            $text.="<p class='consult'>" . $message->TICKET_MENSAJE . "</p>";
        }
        $text.="</div>";
        return$text;
    }

    public function getFiles($id) {
        $criteria = new CDbCriteria();
        $criteria->condition = 't.ID_TICKET=' . $id;
        $cotfile = ArchivoTicket::model()->findall($criteria);

        $link = "<div id='tblCot'>";
        foreach ($cotfile as $t) {
            $link.=CHtml::link(CHtml::encode($t->NOMBRE_ARCHIVO), Yii::app()->baseUrl . '/archivos/tickets/' . $t->ID_TICKET . "/" . $t->NOMBRE_ARCHIVO, array('target' => '_blank', 'class' => 'attach')) ;
            $link.="<br>";
        }
        $link.="</div>";
        if ($cotfile)
            return $link;
        else
            return null;
    }

}
