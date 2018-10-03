<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\widgets\ActiveField;

/* @var $this yii\web\View */
/* @var $model app\models\Server */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="server-form">
<div class="panel panel-default">
    <div class="panel-body">
	    <?php $form = ActiveForm::begin(['id' => $model->formName(), 'type' => ActiveForm::TYPE_HORIZONTAL]); ?>

	    <div class="form-group">
	        <?= Html::activeLabel($model, 'idServer', ['label' => 'Название сервера', 'class' => 'col-sm-3 control-label'])?>
	        <div class="col-sm-4">
	            <?= $form->field($model, 'server', ['showLabels' => false])->textInput(['placeholder' => 'Название'])?>
	        </div>
	        <div class="col-sm-3">
	            <?= $form->field($model, 'location', ['showLabels' => false])->textInput(['placeholder' => 'Местонахождение'])?>
	        </div>
	    </div>

	    <div class="form-group">
	        <?= Html::activeLabel($model, 'idServer', ['label' => 'Название софта', 'class' => 'col-sm-3 control-label'])?>
	        <div class="col-sm-4">
	            <?= $form->field($model, 'nameSoft', ['showLabels' => false])->textInput(['placeholder' => 'Название'])?>
	        </div>
	        <div class="col-sm-3">
	            <?= $form->field($model, 'version', ['showLabels' => false])->textInput(['placeholder' => 'Версия'])?>
	        </div>
	    </div>
	    <div class="form-group">
	        <?= Html::activeLabel($model, 'idServer', ['label' => 'Ссылка на ПО', 'class' => 'col-sm-3 control-label'])?>
	        <div class="col-sm-7">
	            <?= $form->field($model, 'link', ['showLabels' => false])->textInput(['placeholder' => 'ссылка...'])?>
	        </div>
	    </div>

	    <div class="form-group" >
	                        
	        <?= Html::activeLabel($model, 'comment', ['label' => 'Примечание', 'class' => 'col-sm-3 control-label'])?>
	            <div class="col-sm-7">
	                <?= $form->field($model, 'comment', ['showLabels' => false])->textArea(['placeholder' => 'Пишите...', 'rows' => 4])?>
	            </div>      
	      </div>

	            <div class="form-group">
	                <div class="col-sm-offset-2 col-sm-10">
	                    
	                    <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => 'btn btn-primary'])?>
	                </div>
	            </div>

	    <?php ActiveForm::end(); ?>

	</div>
</div>
</div>

