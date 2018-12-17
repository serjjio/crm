<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use backend\modules\guard\models\BgCity;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model backend\modules\guard\models\BgDillerInstaller */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bg-diller-all-form">

    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: #337ab7; color: white">
            <h3 class="panel-title">Информация о диллере</h3>
        </div>
        <div class="panel-body" style="color: #337ab7">
        	<?php $form = ActiveForm::begin(['id' => $model->formName(), 'type' => ActiveForm::TYPE_HORIZONTAL, 'enableAjaxValidation' => true, 'disabled' => !Yii::$app->user->can('createGuard') ? true : false]); ?>


        		<!-- Name diller -->
        		<div class="form-group">
            		<div class="col-sm-2" style="text-align: left">
                		<?= Html::activeLabel($model, 'id_diller', ['label' => 'Имя диллера'])?>
            		</div>      
            		<div class="col-sm-4">
                		<?= $form->field($model, 'name_diller', ['showLabels' => false])->textInput()?>
            		</div>     
        		</div>

        		<!-- City -->
        		<div class="form-group">
            		<div class="col-sm-2" style="text-align: left">
                		<?= Html::activeLabel($model, 'id_diller', ['label' => 'Город'])?>
	            	</div>      
	            	<div class="col-sm-4">
                <?= $form->field($model, 'id_city', ['showLabels' => false])->widget(Select2::classname(), 
                    [
                        'initValueText' => $model->id_city ? BgCity::findOne($model->id_city)->name_sity : '',
                        //'data' => ['Kievska' => ['Kiev', 'Brovari'], 'Lvivska' => ['Lviv', 'Srn']],
                        //'data' => ArrayHelper::map(BgCity::find()->all(), 'id_city', 'name_sity', 'name_oblast'),
                        'options' => ['placeholder' => 'Укажите город...'],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'minimumInputLength' => 3,
                                    'language' => [
                                        'errorLoading' => new JsExpression("function () {return 'Ожидание...'}"),
                                        'inputTooShort' => new JsExpression("function () {return 'Введите больше 3 символов'}"),
                                        'noResults' => new JsExpression("function () {return 'Совпадений не найдено'}"),
                                    ],
                                    'ajax' => [
                                        'url' => '/guard/bg-city/cities-list',
                                        'dataType' => 'json',
                                        'data' => new JsExpression("function (params) {return {q:params.term};}"),
                                    ],
                                    'escapeMarkup' => new JsExpression("function (markup) {return markup;}"),
                                    'templateResult' => new JsExpression("function (id_city) {var res = id_city.text+', '+id_city.obl; return res}"),
                                    'templateSelection' => new JsExpression("function (id_city) {return id_city.text;}"),
                        ]
                    ]) ?>
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
