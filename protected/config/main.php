<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'theme' => 'default',
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Aprobacion de documentos',
    'defaultController' => 'site/login',
    'timeZone' => 'America/Santiago',
    'language' => 'es',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.helpers.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'root',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
    ),
    // application components
    'components' => array(
        'mailer' => array(
            'class' => 'application.extensions.mailer.EMailer',
            'pathViews' => 'application.views.email',
            'pathLayouts' => 'application.views.email.layouts'
        ),
        'Smtpmail' => array(
            'class' => 'application.extensions.smtpmail.PHPMailer',
            'Host' => "199.195.119.4",
            'Username' => 'desarrollo@pcgeek.cl',
            'Password' => 'r2d2.desarrollo',
            'Mailer' => 'smtp',
            'Port' => 25,
            'SMTPAuth' => true,
        ),
        'user' => array(
            // enable cookie-based authentication
            'class' => 'application.components.EWebUser',
            'allowAutoLogin' => true,
        ),
        'image' => array(
            'class' => 'application.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver' => 'GD',
            // ImageMagick setup path
            'params' => array('directory' => '/opt/local/bin'),
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                array('api/auth', 'pattern' => 'api/auth', 'verb' => 'GET'),
                array('api/list', 'pattern' => 'api/<model:\w+>', 'verb' => 'GET'),
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        'db' => array(
            'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
        ),
        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=admin_ordenes_trabajo',
            'emulatePrepare' => true,
            'username' => 'ast',
            //'username' => 'root',
            'password' => 'ast-r2d2',
            //'password' => 'root',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
     'log'=>array(
      'class'=>'CLogRouter',
      'routes'=>array(
      array(
      'class'=>'CFileLogRoute',
      'levels'=>'error, warning',
      ),
      // uncomment the following to show log messages on web pages

//      array(
//      'class'=>'CWebLogRoute',
//      ),

      ),
      ), 
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
        'listPerPage' => 20,
    ),
);
