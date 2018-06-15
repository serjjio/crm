<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Unit */

$this->title = 'Update Unit: ' . $model->idUnit;
$this->params['breadcrumbs'][] = ['label' => 'Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idUnit, 'url' => ['view', 'id' => $model->idUnit]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="unit-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
