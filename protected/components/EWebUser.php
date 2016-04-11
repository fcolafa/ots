<?php
ob_start();

class EWebUser extends CWebUser{

    protected $_model;

    function GG(){
        $user = $this->loadUser();
        if ($user)
           return $user->COD_TIPO_USUARIO==LevelLookUp::GG;
        return false;
    }

    function GOP(){
        $user = $this->loadUser();
        if ($user)
           return $user->COD_TIPO_USUARIO==LevelLookUp::GOP;
        return false;
    }

    function ADM(){
        $user = $this->loadUser();
        if ($user)
           return $user->COD_TIPO_USUARIO==LevelLookUp::ADM;
        return false;
    }

    function JDP(){
        $user = $this->loadUser();
        if ($user)
           return $user->COD_TIPO_USUARIO==LevelLookUp::JDP;
        return false;
    }

    function A1(){
        $user = $this->loadUser();
        if ($user)
           return $user->COD_TIPO_USUARIO==LevelLookUp::A1;
        return false;
    }
    function PR(){
        $user = $this->loadUser();
        if ($user)
           return $user->COD_TIPO_USUARIO==LevelLookUp::PR;
        return false;
    }

    // Load user model.

    protected function loadUser()
    {
        //$sql = "SELECT ID_PERSONA, COD_TIPO_USUARIO, ID_EMPRESA FROM usuarios Where ID_USUARIO=:value";
        $sql = "SELECT ID_PERSONA, COD_TIPO_USUARIO, ID_EMPRESA FROM usuarios Where ID_PERSONA=:value";
        $params=array(':value'=>$this->id);
        if ( $this->_model === null ) {
            $this->_model = Usuarios::model()->findBySql($sql,$params);
        }
        return $this->_model;
    }

    function getTypeUser()
    {
        if (Yii::app()->user->id != '')
        {
            $user = $this->loadUser(Yii::app()->user->id);
            $t = $user->COD_TIPO_USUARIO;
        }else {
            $t = '';            
        }
        return $t;
    }

    function getEmpresaUser()
    {
        if (Yii::app()->user->id != '')
        {
            //$user = $this->loadUser(Yii::app()->user->id);
            $user = $this->loadUser();
            $t = $user->ID_EMPRESA;
        }else {
            $t = '';
        }
        return $t;
    }   
}