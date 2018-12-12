<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\guard\models\BgCitySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bg-city-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_city') ?>

    <?= $form->field($model, 'name_sity') ?>

    <?= $form->field($model, 'id_oblast') ?>

    <?= $form->field($model, 'name_oblast') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
