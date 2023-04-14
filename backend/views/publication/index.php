<?php

use common\models\BasePublication;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\PublicationSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Publications';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="base-publication-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Publication', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'publicationId',
                'format' => 'html',
                'value' => function (BasePublication $model) {
                    return Html::a($model->primaryKey, ['view', 'publicationId' => $model->primaryKey]);
                },
            ],
            [
                'attribute' => 'userId',
                'format' => 'html',
                'value' => function (BasePublication $model) {
                    return (!empty($model->user)) ? Html::a($model->user->name, ['user/view', 'userId' => $model->userId]) : null;
                },
            ],

            'text:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, BasePublication $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'publicationId' => $model->publicationId]);
                 }
            ],
        ],
    ]); ?>


</div>
