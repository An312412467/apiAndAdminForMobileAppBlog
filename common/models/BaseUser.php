<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $userId
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $role
 *
 * @property Publication[] $publications
 * @property BaseToken[] $tokens
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password', 'role'], 'required'],
            [['name', 'email', 'password'], 'string', 'max' => 50],
            [['role'], 'string', 'max' => 5],
            [['name', 'email'], 'unique'],
            [['email'], 'email'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'userId' => 'User ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'role' => 'Role',
        ];
    }

    /**
     * Gets query for [[Publications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPublications()
    {
        return $this->hasMany(Publication::class, ['userId' => 'userId']);
    }

    /**
     * Gets query for [[Tokens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTokens()
    {
        return $this->hasMany(BaseToken::class, ['userId' => 'userId']);
    }
}
