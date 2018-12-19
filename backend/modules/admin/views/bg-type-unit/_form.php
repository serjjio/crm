<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\guard\models\BgTypeUnit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bg-type-unit-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_type_unit')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
