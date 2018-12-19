<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\guard\models\BgModel */

$this->title = 'Update Bg Model: ' . $model->id_model;
$this->params['breadcrumbs'][] = ['label' => 'Bg Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_model, 'url' => ['view', 'id' => $model->id_model]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bg-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
