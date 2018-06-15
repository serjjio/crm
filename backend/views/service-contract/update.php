<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ServiceContract */

$this->title = 'Update Service Contract: ' . $model->id_service_contract;
$this->params['breadcrumbs'][] = ['label' => 'Service Contracts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_service_contract, 'url' => ['view', 'id' => $model->id_service_contract]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="service-contract-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
