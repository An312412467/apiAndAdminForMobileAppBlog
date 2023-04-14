<?php

use app\models\User;
use yii\base\Model;

class LoginBySignUpForm extends Model
{
    public $name;
    public $email;
    public $password;

    public function  rules()
    {
        return [
            [['name', 'email', 'password',], 'required'],
            [['name', 'email', 'password'], 'string', 'max' => 50],
            [['email'], 'email'],
        ];
    }

    public function signUp()
    {
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        $user->role = $user::ROLE_USER;

        if (!$user->save()) {
            $this->addError("error", "Не удалось сохранить данные");

            return false;
        }

        $user = User::findOne(["name" => $this->name]);
        $token = Token::generateToken($user->userId);

        if (empty($token)) {
            $this->addError("error", "Не удалось сгенерировать токен");

            return false;
        }

        return $token;
    }
}
