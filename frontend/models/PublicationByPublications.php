<?php

namespace frontend\models;

use yii\base\Model;
use common\models\Publication;

class PublicationByPublications extends Model
{
    public $limit = 10;
    public $offset = 0;

    private $publications;

    public  function rules()
    {
        return [
            [['limit', 'offset'], 'integer'],
        ];
    }

    public function getPublications()
    {
        if (!$this->validate()) {
            $this->addError("error", "Данные не прошли валидацию");

            return false;
        }

        $this->publications = Publication::find()
            ->limit($this->limit)
            ->offset($this->offset);

        if (empty($this->publications)) {
            $this->addError("error", "Не удалось получить статьи");
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