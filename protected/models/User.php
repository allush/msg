<?php

/**
 * @property integer $id
 * @property string $login
 * @property string $password
 *
 * @property Dialog[] $dialogs
 * @property Dialog[] $dialogs1
 */
class User extends CActiveRecord
{
	public function tableName()
	{
		return 'user';
	}

	public function rules()
	{
		return array(
			array('login, password', 'required'),
			array('login, password', 'length', 'max'=>45),
		);
	}

	public function relations()
	{
		return array(
			'dialogs' => array(self::HAS_MANY, 'Dialog', 'sender_id'),
			'dialogs1' => array(self::HAS_MANY, 'Dialog', 'receiver_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => '#',
			'login' => 'Логин',
			'password' => 'Пароль',
		);
	}

    public function validatePassword($password)
    {
        return crypt($password, $this->password) === $this->password;
    }

    public static function hashPassword($password)
    {
        return crypt($password, self::generateSalt());
    }

    public static function generateSalt()
    {
        return time();
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}