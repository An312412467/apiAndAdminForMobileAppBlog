<?php

namespace frontend\models;

use yii\base\Model;
use common\models\User;
use common\models\Token;

class LoginByLoginForm extends Model
{
    public $name;
    public $email;
    public $password;

    private $acessToken;

    public function  rules()
    {
        return [
            [['name', 'email', 'password',], 'required'],
            [['name', 'email', 'password'], 'string', 'max' => 50],
            [['email'], 'email'],
        ];
    }

    public function validatePassword()
    {
        $user = User::findByUsername($this->name);

        if (!$user->validatePassword($this->password)) {
            return false;
        }

        return true;
    }

    public function login()
    {
        if (!$this->validate()) {
            return false;
        }

        if (!$this->validatePassword()) {
            $this->addError("error", "Неверный логин или пароль");

            return false;
        }

        $user = User::findOne(["name" => $this->name]);
        $this->acessToken = Token::generateToken($user->userId);

        if (empty($acessToken)) {
            $this->addError("error", "Не удалось сгенерировать токен");
            return false;
        }

        return true;
    }

    public function serializeToArray()
    {
        return $this->acessToken->serializeToArray();
    }
}
