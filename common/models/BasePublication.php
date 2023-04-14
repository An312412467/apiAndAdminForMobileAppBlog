<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "publication".
 *
 * @property int $publicationId
 * @property int $userId
 * @property string $text
 *
 * @property BaseUser $user
 */
class BasePublication extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publication';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userId', 'publication'], 'required'],
            [['userId'], 'integer'],
            [['text'], 'string'],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['userId' => 'userId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'publicationId' => 'Publication ID',
            'userId' => 'User ID',
            'text' => 'text',
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
