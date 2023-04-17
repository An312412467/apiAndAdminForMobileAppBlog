<?php

namespace backend\controllers;

use app\models\UserAuthorization;
use common\models\LoginForm;
use common\models\User;
use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();

        if (($model->load(Yii::$app->request->post())) && ($model->login())) {
            echo "hello";
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }
}
