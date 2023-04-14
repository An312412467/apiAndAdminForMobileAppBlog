<?php

use yii\base\Model;
use common\models\Publication;

class PublicationByPublications extends Model
{
    public $limit;
    public $offset;

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

        $publicationQuerry = Publication::find()
            ->limit($this->limit)
            ->offset($this->offset);
        $result = [];

        foreach ($publicationQuerry->each() as $publication) {
            $result[] = $publication->serializeToArray();
        }

        return $result;
    }
}