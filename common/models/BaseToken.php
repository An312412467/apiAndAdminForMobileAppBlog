<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "token".
 *
 * @property int $tokenId
 * @property int $userId
 * @property string $acessToken
 *
 * @property BaseUser $user
 */
class Token extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'token';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userId', 'acessToken'], 'required'],
            [['userId'], 'integer'],
            [['acessToken'], 'string', 'max' => 255],
            [['acessToken'], 'unique'],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['userId' => 'userId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tokenId' => 'Token ID',
            'userId' => 'User ID',
            'acessToken' => 'Acess Token',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(BaseUser::class, ['userId' => 'userId']);
    }
}
