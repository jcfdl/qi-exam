<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	private $_id;
	public function authenticate()
	{
		// $users=array(
			// username => password
			// 'demo'=>'demo',
			// 'admin'=>'admin',
		// );

		// if(!isset($users[$this->username]))
		// 	$this->errorCode=self::ERROR_USERNAME_INVALID;
		// elseif($users[$this->username]!==$this->password)
		// 	$this->errorCode=self::ERROR_PASSWORD_INVALID;
		// else
		// 	$this->errorCode=self::ERROR_NONE;
		// return !$this->errorCode;

		$account = User::model()->findByAttributes(array('email'=>$this->username));
		if($account === null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;		
		else if(!CPasswordHelper::verifyPassword($this->password,$account->password))
    	$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else {
			// UserIdentity::createAuthenticatedAccount($account);
			$this->_id=$account->id;
			$this->setState('email', $account->email);
			$this->setState('name', $account->first_name);
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}

	public static function createAuthenticatedAccount($account) {
		$identity = new self($account, '');
		$identity->_id=$account->id;
		$identity->setState('email', $account->email);
		$identity->setState('name', $account->first_name);
		$identity->errorCode=self::ERROR_NONE;
		Yii::app()->user->login($identity, 0);
		return !$identity->errorCode;
	}
}