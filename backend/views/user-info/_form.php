<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;
use kartik\widgets\ActiveField;
use app\models\Server;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\UserInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-info-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName()]); ?>

    <!-- <?= $form->field($model, 'idClient')->textInput() ?> -->

    <?= $form->field($model, 'login')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nameUser')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idServer', ['showLabels' => true])->widget(Select2::classname(),
                        [
                            'data' => ArrayHelper::map(Server::find()->all(), 'idServer', 'server'),
                            'options' => ['placeholder' => 'Укажите сервер'],
                            'pluginOptions' => ['allowClear' => true]
                        ]
                    )?>
    <div style="overflow-x: auto">      
    <?= $form->field($model, 'comment', ['showLabels' => true])->textArea(['placeholder' => 'Пишите...', 'rows' => 4])?>
    </div>   
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновит', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
