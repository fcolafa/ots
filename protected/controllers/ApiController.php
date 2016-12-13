<?php

class ApiController extends Controller
{
    // Members
    /**
     * Key which has to be in HTTP USERNAME and PASSWORD headers 
     */
    Const APPLICATION_ID = 'ASCCPE';
 
    /**
     * Default response format
     * either 'json' or 'xml'
     */
    private $format = 'json';
    /**
     * @return array action filters
     */
    public function filters()
    {
            return array();
    }
 
    // Actions
    public function actionList()
    {
       // $this->_checkAuth();
        switch($_GET['model'])
        {
            case 'OrdenTrabajo':
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
                break;
            default:
                // Model not implemented error
                $this->_sendResponse(501, sprintf(
                    'Error: Mode <b>list</b> is not implemented for model <b>%s</b>',
                    $_GET['model']) );
                Yii::app()->end();
        }
        // Did we get some results?
        if($number==0) {
            // No
            $this->_sendResponse(200, 
                    sprintf('No items where found for model <b>%s</b>', $_GET['model']) );
        }else{
            // Prepare response
            /*$rows = array();
            foreach($models as $model)
                $rows[] = $model->attributes;*/
            // Send the response
            $this->_sendResponse(200, CJSON::encode($number));
        }
    }

    public function actionView()
    {
    }
    public function actionCreate()
    {
    }
    public function actionUpdate()
    {
    }
    public function actionDelete()
    {
        $this->_checkAuth();
    }

    private function _sendResponse($status = 200, $body = '', $content_type = 'text/html')
    {
        // set the status
        $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
        header($status_header);
        // and the content type
        header('Content-type: ' . $content_type);
     
        // pages with body are easy
        if($body != '')
        {
            // send the body
            echo $body;
        }
        // we need to create the body if none is passed
        else
        {
            // create some body messages
            $message = '';
     
            // this is purely optional, but makes the pages a little nicer to read
            // for your users.  Since you won't likely send a lot of different status codes,
            // this also shouldn't be too ponderous to maintain
            switch($status)
            {
                case 401:
                    $message = 'You must be authorized to view this page.';
                    break;
                case 404:
                    $message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
                    break;
                case 500:
                    $message = 'The server encountered an error processing your request.';
                    break;
                case 501:
                    $message = 'The requested method is not implemented.';
                    break;
            }
     
            // servers don't always have a signature turned on 
            // (this is an apache directive "ServerSignature On")
            $signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];
     
            // this should be templated in a real-world solution
            $body = '
                <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
                <html>
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
                    <title>' . $status . ' ' . $this->_getStatusCodeMessage($status) . '</title>
                </head>
                <body>
                    <h1>' . $this->_getStatusCodeMessage($status) . '</h1>
                    <p>' . $message . '</p>
                    <hr />
                    <address>' . $signature . '</address>
                </body>
                </html>';
     
            echo $body;
        }
        Yii::app()->end();
    }

    private function _getStatusCodeMessage($status)
    {
        // these could be stored in a .ini file and loaded
        // via parse_ini_file()... however, this will suffice
        // for an example
        $codes = Array(
            200 => 'OK',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
        );
        return (isset($codes[$status])) ? $codes[$status] : '';
    }

    private function _checkAuth()
    {
        // Check if we have the USERNAME and PASSWORD HTTP headers set?
        if(!(isset($_SERVER['HTTP_X_USERNAME']) and isset($_SERVER['HTTP_X_PASSWORD']))) {
            // Error: Unauthorized
            $this->_sendResponse(401);
        }
        $username = $_SERVER['HTTP_X_USERNAME'];
        $password = $_SERVER['HTTP_X_PASSWORD'];
        // Find the user
        $user=User::model()->find('LOWER(username)=?',array(strtolower($username)));
        if($user===null) {
            // Error: Unauthorized
            $this->_sendResponse(401, 'Error: User Name is invalid');
        } else if(!$user->validatePassword($password)) {
            // Error: Unauthorized
            $this->_sendResponse(401, 'Error: User Password is invalid');
        }
    }
}