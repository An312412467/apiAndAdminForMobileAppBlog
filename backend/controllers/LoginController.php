<?php

namespace backend\controllers;

use app\models\Userdata;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

class LoginController extends Controller
{
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionLogin()
    {
        $model = Userdata::findOne('admin');

        Yii::$app->user->login($model);

        if (Yii::$app->user->isGuest)
        {
            return $this->render('admin', [
                'model' => $model,
            ]);
        }
        else 
        {
            return $this->render('index');
        }
    }
}