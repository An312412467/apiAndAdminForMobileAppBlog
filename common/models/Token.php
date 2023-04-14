<?php

namespace common\models;

use Yii;
use models\BaseToken;

/**
 * This is the model class for table "token".
 *
 * @property int $tokenId
 * @property int $userId
 * @property string $acessToken
 *
 */

 class Token extends BaseToken
 {
    public function rules()
    {
        return array_merge(parent::rules());
    }

    public static function generateToken($userId)
    {
        $token = new Token();
        $token->userId = $userId;
        $token->acessToken = Yii::$app->getSecurity()->generateRandomString();
        
        if (!$token->save()) {
            return null;
        }

        return $token;
    }
 }