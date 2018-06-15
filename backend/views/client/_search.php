<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ClientSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idClient') ?>

    <?= $form->field($model, 'clientName') ?>

    <?= $form->field($model, 'structure') ?>

    <?= $form->field($model, 'segment') ?>

    <?= $form->field($model, 'edrpou') ?>

    <?php // echo $form->field($model, 'publicTel') ?>

    <?php // echo $form->field($model, 'publicEmail') ?>

    <?php // echo $form->field($model, 'idType') ?>

    <?php // echo $form->field($model, 'idServer') ?>

    <?php // echo $form->field($model, 'idConract') ?>

    <?php // echo $form->field($model, 'clientCountObj') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
