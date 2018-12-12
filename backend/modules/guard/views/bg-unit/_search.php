<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\guard\models\BgUnitSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bg-unit-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_unit') ?>

    <?= $form->field($model, 'unit_number') ?>

    <?= $form->field($model, 'id_type_unit') ?>

    <?= $form->field($model, 'sim_number') ?>

    <?= $form->field($model, 'test_date') ?>

    <?php // echo $form->field($model, 'id_city') ?>

    <?php // echo $form->field($model, 'id_diller_installer') ?>

    <?php // echo $form->field($model, 'installer') ?>

    <?php // echo $form->field($model, 'contact_installer') ?>

    <?php // echo $form->field($model, 'test_status') ?>

    <?php // echo $form->field($model, 'can_module') ?>

    <?php // echo $form->field($model, 'shock_sensor') ?>

    <?php // echo $form->field($model, 'volume_sensor') ?>

    <?php // echo $form->field($model, 'rfid_tags') ?>

    <?php // echo $form->field($model, 'vin_number') ?>

    <?php // echo $form->field($model, 'id_tester_operator') ?>

    <?php // echo $form->field($model, 'activate_date') ?>

    <?php // echo $form->field($model, 'activate_status') ?>

    <?php // echo $form->field($model, 'id_activate_operator') ?>

    <?php // echo $form->field($model, 'garant_term') ?>

    <?php // echo $form->field($model, 'id_marka') ?>

    <?php // echo $form->field($model, 'name_model') ?>

    <?php // echo $form->field($model, 'gos_number') ?>

    <?php // echo $form->field($model, 'color') ?>

    <?php // echo $form->field($model, 'id_model') ?>

    <?php // echo $form->field($model, 'made_auto_date') ?>

    <?php // echo $form->field($model, 'passport_number') ?>

    <?php // echo $form->field($model, 'name_owner') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
