<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ServerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="server-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idServer') ?>

    <?= $form->field($model, 'server') ?>

    <?= $form->field($model, 'location') ?>

    <?= $form->field($model, 'nameSoft') ?>

    <?= $form->field($model, 'version') ?>

    <?php // echo $form->field($model, 'link') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
