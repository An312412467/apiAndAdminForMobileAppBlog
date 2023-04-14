<?php

use common\models\BaseUser;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="base-user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'userId',
                'format' => 'html',
                'value' => function (BaseUser $model) {
                    return Html::a($model->primaryKey, ['view', 'userId' => $model->primaryKey]);
                },
            ],
            [
                'attribute' => 'name',
                'format' => 'html',
                'value' => function (BaseUser $model) {
                    return (!empty($model)) ? Html::a($model->name, ['user/view', 'userId' => $model->userId]) : null;
                },
            ],
            'email:email',
            'password',
            'role',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, BaseUser $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'userId' => $model->userId]);
                 }
            ],
        ],
    ]); ?>


</div>
