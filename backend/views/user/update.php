<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\BaseUser $model */

$this->title = 'Update Base User: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Base Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'userId' => $model->userId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="base-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
