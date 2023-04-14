<?php

namespace common\models;

use models\BasePublication;

/**
 * This is the model class for table "publication".
 *
 * @property int $publicationId
 * @property int $userId
 * @property string $text
 *
 */
class Publication extends BasePublication
{
    public function rules()
    {
        return array_merge(parent::rules());
    }

    public function serializeToArray()
    {
        $serializedData = [];
        $serializedData['publicationId'] = $this->publicationId;
        $serializedData['userId'] = $this->userId;
        $serializedData['text'] = $this->text;

        return $serializedData;
    }
}