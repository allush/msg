<?php

class LoginForm extends CFormModel
{
    public $login;
    public $password;

    private $_identity = null;

    public function rules()
    {
        return array(
            array('login, password', 'required'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'login' => 'Логин',
            'password' => 'Пароль',
        );
    }

    public function login()
    {
        if (!$this->validate()) {
            return false;
        }

        if ($this->_identity === null) {
            $this->_identity = new UserIdentity($this->login, $this->password);
        }

        if (!$this->_identity->authenticate()) {
            $this->addError('password', 'Неверный логин или пароль');
            return false;
        }

        Yii::app()->user->login($this->_identity);

        return true;
    }
}
