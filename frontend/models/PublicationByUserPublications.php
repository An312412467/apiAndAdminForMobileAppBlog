<?php

use yii\base\Model;
use common\models\Token;
use common\models\Publication;

class PublicationByUserPublications extends Model
{
    public $limit;
    public $offset;
    public $acessToken;

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

        $publicationQuery = Publication::find()
            ->andWhere(['publication.userId' => $user->userId])
            ->limit($this->limit)
            ->offset($this->offset);
        $result = [];

        foreach ($publicationQuery->each() as $publication) {
            $result[] = $publication->serializeToArray();
        }

        if (empty($result)) {
            $this->addError("error", "Статьи пользователя не найдены");
            return false;
        }

        return $result;
    }
}
