<?php

namespace frontend\controllers;

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
        $model = new \PublicationByCreateForm();
        $model->load(Yii::$app->request->post());

        if (!$model->createPublication()) {
            return [
                "error" => $model->getErrors(),
            ];
        }

        return [
            "publication" => $model->createPublication(),
        ];
    }

    public function actionPublications()
    {
        $model = new \PublicationByPublications();
        $model->load(Yii::$app->request->get());

        if (!$model->getPublications()) {
            return [
                "error" => $model->getErrors(),
            ];
        }

        return [
            "publication" => $model->getPublications(),
        ];
    }

    public function actionUserPublications()
    {
        $model = new \PublicationByUserPublications();
        $model->load(Yii::$app->request->get());

        if (!$model->getUserPublications()) {
            return [
                "error" => $model->addError(),
            ];
        }
        
        return [
            "publication" => $model->getUserPublications(),
        ];
    }
}