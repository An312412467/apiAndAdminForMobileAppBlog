<?php

namespace app\models;

use common\models\User;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $userId
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $role
 *
 */

class UserAuthorisation extends User implements IdentityInterface
{
     public const ROLE_USER = "user";
     public const ROLE_ADMIN = "admin";

    public function rules()
    {
        return array_merge(parent::rules());
    }

    public static function findIdentity($id)
    {
        return User::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        
    }

    public function validateAuthKey($authKey)
    {
        
    }

    public static function findByUsername($username)
    {
        return User::findOne(['username' => $username]);
    }

    public function validatePassword($password)
    {
        return ($this->password == $password) ? true : false;
    }
}