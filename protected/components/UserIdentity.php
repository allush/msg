<?php

class UserIdentity extends CUserIdentity
{
    private $_id;

    public function authenticate()
    {
        /** @var $user User */
        $user = User::model()->find('LOWER(login)=:login', array(':login' => strtolower($this->username)));

        if (!$user or !$user->validatePassword($this->password)) {
            return false;
        }

        $this->_id = $user->id;
        $this->username = $user->login;

        return true;
    }

    public function getId()
    {
        return $this->_id;
    }
}