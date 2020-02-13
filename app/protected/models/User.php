<?php

class User extends CActiveRecord {
	public $confirmPassword;

	public static function model($className=__CLASS__) {
    return parent::model($className);
  }

	public function tableName() {
		return '{{users}}';
	}

	public function rules() {
		return array(
			array('first_name, last_name', 'required'),
			array('password', 'required'),
			array('confirmPassword', 'validatePasswordConfirm', 'on' => 'register'),
			array('confirmPassword', 'required', 'on' => 'register'),
			array('email', 'email'),
			array('email', 'emailExists'),
			array('password', 'length', 'min'=>6, 'max'=>254),
			array('updated_at', 'safe'),
		);	
	}

	public function validatePasswordConfirm($attribute)
	{
		if(in_array($this->scenario, array('register')) && $this->password !== $this->confirmPassword )
		{
			$this->addError($attribute, $this->getAttributeLabel('confirmPassword').' did not match the provided password.');
		}
		
		if( in_array($this->scenario, array('changePassword', 'providePassword', '_resetPassword'))  && $this->newPassword !== $this->confirmPassword )
		{
			$this->addError($attribute, $this->getAttributeLabel('confirmPassword').' did not match the provided password.');
		}
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'Email',
			'password' => 'Password',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'confirmPassword' => 'Confirm Password',
			'created_at' => 'Date Created',
			'updated_at' => 'Date Updated',
		);
	}

	public function emailExists()
	{
		$account = (!isset($this->id))?User::model()->find('email="'.$this->email.'"'):User::model()->existing()->find('email="'.$this->email.'" AND id <> '.$this->id.'');
		 if(isset($account))
			$this->addError('email', 'Email already exists.');
	}

	protected function beforeSave()
	{
		if (parent::beforeSave())
		{
			$this->updated_at = date('Y-m-d H:i:s');
			
			if($this->isNewRecord)
			{
				$this->password = CPasswordHelper::hashPassword($this->password);
				$this->created_at = $this->updated_at;
			}
			return true;
		}
	}

}