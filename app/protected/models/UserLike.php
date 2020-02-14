<?php

class UserLike extends CActiveRecord {
	const STATUS_DELETED = 0;
	const STATUS_ACTIVE = 1;
	public $confirmPassword;

	public static function model($className=__CLASS__) {
    return parent::model($className);
  }

	public function tableName() {
		return '{{user_likes}}';
	}

	public function rules() {
		return array(
			array('title, year, type, user_id, imdbID', 'required'),
			array('user_id, status', 'numerical', 'integerOnly'=>true),
			array('updated_at, created_at, poster', 'safe'),
		);	
	}

	public function relations() {
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id')
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'type' => 'Type',
			'poster' => 'Poster',
			'year' => 'Year',
			'created_at' => 'Date Created',
			'updated_at' => 'Date Updated',
		);
	}

	protected function beforeSave()
	{
		if (parent::beforeSave())
		{
			$this->updated_at = date('Y-m-d H:i:s');
			if($this->isNewRecord) {
				$this->created_at = $this->updated_at;
			} else {
				$like = UserLike::model()->findByAttributes(array(
					'user_id'=>Yii::app()->user->id,
					'imdbID'=>$this->imdbID,
				));

				if($like->status == 0) {
					$this->status = self::STATUS_ACTIVE;
				} else {
					$this->status = self::STATUS_DELETED;
				}
			}
			return true;
		}
	}

	public function scopes() {
		$t = $this->getTableAlias(false, true);
		return array(
			'existing' => array(
				'condition'=>$t . '.status <>' . self::STATUS_DELETED
			),
		);
	}



}