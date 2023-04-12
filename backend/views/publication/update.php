<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Publication $model */

$this->title = 'Update Publication: ' . $model->publicationId;
$this->params['breadcrumbs'][] = ['label' => 'Publications', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->publicationId, 'url' => ['view', 'publicationId' => $model->publicationId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="publication-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
