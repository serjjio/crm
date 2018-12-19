<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\guard\models\BgInsurance */

$this->title = 'Update Bg Insurance: ' . $model->id_insurance;
$this->params['breadcrumbs'][] = ['label' => 'Bg Insurances', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_insurance, 'url' => ['view', 'id' => $model->id_insurance]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bg-insurance-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
