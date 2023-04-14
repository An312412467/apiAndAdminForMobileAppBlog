<?php

use yii\base\Model;
use common\models\Token;
use common\models\Publication;

class PublicationByCreateForm extends Model
{
    public $acessToken;
    public $text;

    private $publication;

    public function  rules()
    {
        return [
            [['acessToken', 'text'], 'required'],
            [['acessToken', 'text'], 'string'],
        ];
    }

    public  function createPublication()
    {
        if (!$this->validate()) {
            $this->addError("error", "Данные не прошли валидацию");
            return false;
        }

        $token = Token::findOne(["acessTocken" => $this->acessToken]);

        if (empty($token)) {
            $this->addError("error", "Пользователя с таким токеном не существует");

            return false;
        }

        if (empty($this->text)) {
            $this->addError("error", "Неккоректный текст статьи");

            return false;
        }

        $this->publication = new Publication();
        //$publication->userId = $token->userId;
        //$publication->text = $this->text;
        $this->publication->userId = $token->userId;
        $this->publication->text = $this->text;

        if (!$this->publication->save()) {
            $this->addError("error", $this->publication->getErrors());

            return false;
        }

        return  $this->publication->serializeToArray();
    }

    protected function serializeToArray()
    {
        $serializedData = [];
        $serializedData["publicationId"] = $this->publication;
    }
}
