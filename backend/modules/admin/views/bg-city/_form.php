<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\guard\models\BgCity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bg-city-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_sity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_oblast')->textInput() ?>

    <?= $form->field($model, 'name_oblast')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
