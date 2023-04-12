<?php

namespace frontend\controllers;

use app\models\UserAuthorisation;
use common\models\UserToken;
use yii\web\Controller;
use Yii;

class LoginCotroller extends Controller
{
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
        $name = Yii::$app->request->post("name");
        $password = Yii::$app->request->post("password");        
        
        $user = UserAuthorisation::findOne($name);

        if (empty($user)) {
            return [
                "error" => "Пользователя с таким именем не существует"
            ];
        }

        if (!Yii::$app->security->validatePassword($password, $user->password) || ($user->role == $user::ROLE_ADMIN)) {
            return [
                "error" => "Неверный пароль"
            ];
        }
        $acessToken = UserToken::generateToken($user->userId);

        if (empty($acessToken)) {
            return [
                "error" => "Не удалось сгенерировать токен"
            ];
        }

        return [
            "acessToken" => $acessToken->acessToken
        ];
    }

    public function actionSignUp()
    {
        $name = Yii::$app->request->post("name");
        $email = Yii::$app->request->post("email");
        $password = Yii::$app->request->post("password");
        $hash = Yii::$app->getSecurity()->generatePasswordHash($password);

        $user = new UserAuthorisation();
        $user->name = $name;
        $user->email = $email;
        $user->password = $hash;
        $user->role = $user::ROLE_USER;
        
        if (!$user->save) {
            return [
                "error" => $user->getErrors()
            ];
        }

        $token = UserToken::generateToken($user->userId);

        if ($token == null) {
            return [
                "error" => "Не удалось сгенерировать токен"
            ];
        }        

        return [
            "acessToken" => $token->acessToken
        ];
    }
}