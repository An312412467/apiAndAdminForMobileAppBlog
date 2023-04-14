<?php

namespace frontend\controllers;

use yii\web\Controller;
use Yii;

class LoginCotroller extends Controller
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

    public function actionLogin()
    {
        $model = new \LoginByLoginForm();
        $model->load(Yii::$app->request->post());

        if (!$model->login()) {
            return [
                "error" => $model->getErrors(),
            ];
        }

        return [
            "acessToken" => $model->login(),
        ];
    }

    public function actionSignUp()
    {
        $model = new \LoginBySignUpForm();
        $model->load(Yii::$app->request->post());
        
        if (!$model->signUp()) {
            return [
                "error" => $model->getErrors(),
            ];
        }

        return [
            "acessToken" => $model->signUp(),
        ];
    }
}