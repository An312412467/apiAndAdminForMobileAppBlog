<?php

namespace frontend\controllers;

use common\models\UserToken;
use common\models\UserPublication;
use yii\web\Controller;
use Yii;

class PublicationsController extends Controller
{
    public $enableCsrfValidation = false;

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator'] = [
            'class' => 'yii\filters\ContentNegotiator',
            'formats' => [
                'application/json' => \yii\web\Response::FORMAT_JSON,
            ]
        ];

        return $behaviors;
    }

    public function actionCreate()
    {
        $acessToken = Yii::$app->request->post("acessToken");
        $text = Yii::$app->request->post("text");
        $token = UserToken::findOne($acessToken);

        if (empty($token)) {
            return [
                "error" => "Пользователя с таким токеном не существует"
            ];
        }

        if (empty($text)) {
            return [
                "error" => "некорректный текст статьи"
            ];
        }
        
        $publication = new UserPublication();
        $publication->userId = $token->userId;
        $publication->text = $text;
        
        if (!$publication->save()) {
            return [
                "error" => $publication->getErrors()
            ];
        }

        return [
            "publication" => $publication->serializeToArray()
        ];
    }

    public function actionPublications()
    {
        $limit = Yii::$app->request->get("limit", 10);
        $offset = Yii::$app->request->get("offset", 0);
        $publicationQuery = UserPublication::find()
            ->limit($limit)
            ->offset($offset);
        $result = [];
        
        foreach ($publicationQuery->each() as $publication) {
            $result[] = $publication->serializeToArray();
        }

        return [
            "publication" => $result
        ];
    }

    public function adtionUserPublications()
    {
        $limit = Yii::$app->request->get("limit", 10);
        $offset = Yii::$app->request->get("offset", 0);
        $acessToken = Yii::$app->request->get("acessToken");
        $user = UserToken::findOne($acessToken);
        $publicationQuery = UserPublication::find()
            ->andWhere(['publication.userId' => $user->userId])
            ->limit($limit)
            ->offset($offset);
        $result = [];
        
        foreach ($publicationQuery->each() as $publication) {
            $result[] = $publication->serializeToArray();
        }
        
        return [
            "publication" => $result
        ];
    }
}