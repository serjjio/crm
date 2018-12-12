<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use backend\modules\guard\models\BgMarka;



/* @var $this yii\web\View */
/* @var $model backend\modules\guard\models\BgClient */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bg-model-form">

    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: #337ab7; color: white">
            <h3 class="panel-title">Информация о модели</h3>
        </div>
        <div class="panel-body" style="color: #337ab7">
        	<?php $form = ActiveForm::begin(['id' => $model->formName(), 'type' => ActiveForm::TYPE_HORIZONTAL, 'enableAjaxValidation' => true, 'disabled' => !Yii::$app->user->can('createGuard') ? true : false]); ?>

        		<!-- Model / marka -->
        		<div class="form-group">
            		<div class="col-sm-2" style="text-align: left">
                		<?= Html::activeLabel($model, 'id_model', ['label' => 'Марка Авто'])?>
	            	</div>      
	            	<div class="col-sm-4">
	                	<?= $form->field($model, 'id_marka', ['showLabels' => false])->widget(Select2::classname(), 
	                    [
	                        'data' => ArrayHelper::map(BgMarka::find()->all(), 'id_marka', 'name_marka'),
	                        'options' => ['placeholder' => 'Укажите марку...'],
	                        'pluginOptions' => ['allowClear' => true]
	                    ]) ?>
	            	</div>
        		</div>
        	 	<div class="form-group">
            		<div class="col-sm-2" style="text-align: left">
                		<?= Html::activeLabel($model, 'id_model', ['label' => 'Модель Авто'])?>
            		</div>      
            		<div class="col-sm-4">
                		<?= $form->field($model, 'name_model', ['showLabels' => false])->textInput()?>
            		</div>     
        		</div>

                <hr size="3px" style="border-top:1px solid #cecece">

                <div class="form-group">
                    <div class="col-sm-offset-0 col-sm-10">
                        <?= Html::resetButton('Отменить', ['class' => 'btn btn-primery'])?>
                        <?= Html::submitButton('Сохранить', ['class' => !Yii::$app->user->can('createGuard') ? 'hide btn btn-success' : 'btn btn-success'])?>
                    </div>
                </div>
        		<?php ActiveForm::end();  ?>
        </div>
    </div>

    

</div>
