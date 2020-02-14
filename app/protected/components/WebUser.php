<?php

class WebUser extends CWebUser
{
	private $account;
	
	function getAccount()
	{
		$account = $this->loadAccount(Yii::app()->user->id);
		if ($account === null && !Yii::app()->user->isGuest)
		{
			Yii::app()->user->logout();
			Yii::app()->controller->redirect(Yii::app()->homeUrl);
			Yii::app()->end();
		}
		return $account;
	}
	
	protected function loadAccount($id = null)
	{	
		if ($this->account === null)
		{
			if ($id !== null)
			{
				$this->account = User::model()->findByPk($id);
			}
		}
		
		return $this->account;
	}
	
}
?>