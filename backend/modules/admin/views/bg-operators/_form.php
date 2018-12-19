<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\guard\models\BgOperators */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bg-operators-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_operator')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_operator')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
