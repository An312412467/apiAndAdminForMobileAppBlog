<?php

namespace frontend\models;

use yii\base\Model;
use common\models\Token;
use common\models\Publication;

class PublicationByUserPublications extends Model
{
    public $limit = 10;
    public $offset = 0;
    public $acessToken;

    private $publications;

    public  function rules()
    {
        return [
            [['acessToken'], 'required'],
            [['acessToken'], 'string'],
            [['limit', 'offset'], 'integer'],
        ];
    }

    public function getUserPublications()
    {
        if (!$this->validate()) {
            $this->addError("error", "Данные не прошли валидацию");
            return false;
        }

        $user = Token::findOne($this->acessToken);

        if (empty($user)) {
            $this->addError("error", "Пользователь с таким токеном не найден");
            return false;
        }

        $this->publications = Publication::find()
            ->andWhere(['publication.userId' => $user->userId])
            ->limit($this->limit)
            ->offset($this->offset);

        if (empty($this->publications)) {
            $this->addError("error", "статьи пользователя не найдены");
            return false;
        }

        return true;
    }

    public function serializeToArray()
    {
        $result = [];

        foreach ($this->publications->each() as $publication) {
            $result[] = $publication->serializeToArray();
        }

        return $result;
    }
}
