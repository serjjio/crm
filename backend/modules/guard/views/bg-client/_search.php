<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\guard\models\BgClientSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bg-client-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_client') ?>

    <?= $form->field($model, 'client_name') ?>

    <?= $form->field($model, 'id_diller_reteiler') ?>

    <?= $form->field($model, 'name_manager') ?>

    <?= $form->field($model, 'id_package') ?>

    <?php // echo $form->field($model, 'contract_number') ?>

    <?php // echo $form->field($model, 'contract_date') ?>

    <?php // echo $form->field($model, 'contact1') ?>

    <?php // echo $form->field($model, 'contact2') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
