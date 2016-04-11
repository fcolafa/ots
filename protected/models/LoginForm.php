<?php
ob_start();

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $empresa;
	public $rememberMe;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password, empresa', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'username'=>'Nombre de Usuario',
			'rememberMe'=>'Mantenerme Autentificado',
			'password'=>'Contraseña',
			'empresa'=>'Empresa',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity = new UserIdentity($this->username, $this->password, $this->empresa);
			if(!$this->_identity->authenticate())
				$this->addError('password','Usuario o Contraseña incorrecta');
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password, $this->empresa);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*1 : 0; // 30 days
			Yii::app()->user->login($this->_identity, $duration);

			Yii::app()->getSession()->add('id_empresa', $this->empresa);  // setear id de empresa actual
			$user = Empresa::model()->find('ID_EMPRESA=?',array($this->empresa));
			Yii::app()->getSession()->add('empresa_actual', $user->NOMBRE_EMPRESA);  // setear nombre de la empresa actual

			// Obtener id de la empresa actual= Yii::app()->getSession()->get('id_empresa')
			// Obtener nombre de empresa actual= Yii::app()->getSession()->get('empresa_actual')	

			return true;
		}
		else
			return false;
	}
}
