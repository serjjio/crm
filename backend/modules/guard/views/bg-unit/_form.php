<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use kartik\switchinput\SwitchInput;
use yii\bootstrap\Modal;
use yii\web\JsExpression;
use backend\modules\guard\models\BgTypeUnit;
use backend\modules\guard\models\BgClient;
use backend\modules\guard\models\BgDillerAll;
use backend\modules\guard\models\BgOperators;
use backend\modules\guard\models\BgCity;
use backend\modules\guard\models\BgMarka;
use backend\modules\guard\models\BgModel;
use backend\modules\guard\models\BgSegment;
use backend\modules\guard\models\BgInsurance;
use backend\modules\guard\models\BgVolumeSensor;
use backend\modules\guard\models\BgCanSensor;
use kartik\checkbox\CheckboxX;


/* @var $this yii\web\View */
/* @var $model backend\modules\guard\models\BgUnit */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="panel panel-default">
    <div class="panel-heading" style="background-color: #337ab7; color: white">
        <h3 class="panel-title">Информация об устройстве</h3>
    </div>
    <div class="panel-body" style="color: #337ab7">
         <?php $form = ActiveForm::begin(['id' => $model->formName(), 'type' => ActiveForm::TYPE_HORIZONTAL, 'enableAjaxValidation' => true, 'disabled' => !Yii::$app->user->can('createGuard') ? true : false]); ?>

         <!-- Unit number -->
         <div class="form-group">
             <div class="col-sm-3">
                        <?= $form->field($model, 'status', ['showLabels' => false])->widget(CheckboxX::classname(), [
                            'options' => ['value' => $model->status === 0 ? 0 : 1],
                            'pluginOptions' => [
                                'threeState' => false,
                            ],
                            'labelSettings'  => [
                                'label' => 'Активный',
                                'position' => CheckboxX::LABEL_RIGHT
                            ]
                        ])?>  
            </div>
         </div>
         <div class="form-group">
            <div class="col-sm-2" style="text-align: left">
                <?= Html::activeLabel($model, 'id_unit', ['label' => 'Номер'])?>
            </div>      
            <div class="col-sm-7 right-help">
                <?= $form->field($model, 'unit_number', ['showLabels' => false])->textInput()?>
            </div>   
        </div>

        <!-- Sim number -->
         <div class="form-group">

            <div class="col-sm-2" style="text-align: left">
                <?= Html::activeLabel($model, 'id_unit', ['label' => 'Сим-карта'])?>
            </div>      
            <div class="col-sm-7 right-help">
                <?= $form->field($model, 'sim_number', ['showLabels' => false])->textInput()?>
            </div> 
    
        </div>


        <!-- Type  unit-->
         <div class="form-group">
            <div class="col-sm-2" style="text-align: left">
                <?= Html::activeLabel($model, 'id_unit', ['label' => 'Тип устройства'])?>
            </div>      
            <div class="col-sm-3">
                <?= $form->field($model, 'id_type_unit', ['showLabels' => false])->widget(Select2::classname(), 
                    [
                        'data' => ArrayHelper::map(BgTypeUnit::find()->all(), 'id_type_unit', 'name_type_unit'),
                        'options' => ['placeholder' => 'Укажите тип устройства...'],
                        'pluginOptions' => ['allowClear' => true]
                    ]) ?>
            </div>
                    
        </div>

         <!-- Client-->
         <div class="form-group">
            <div class="col-sm-2" style="text-align: left">
                <?= Html::activeLabel($model, 'id_unit', ['label' => 'Имя клиента'])?>
            </div>      
            <div class="col-sm-3">
                <?= $form->field($model, 'id_client', ['showLabels' => false])->widget(Select2::classname(), 
                    [
                        'data' => ArrayHelper::map(BgClient::find()->all(), 'id_client', 'client_name'),
                        'options' => ['placeholder' => 'Укажите клиента...'],
                        'pluginOptions' => ['allowClear' => true]
                    ]) ?>
            </div>
                    
        </div>

        <!-- Segment-->
         <div class="form-group">
            <div class="col-sm-2" style="text-align: left">
                <?= Html::activeLabel($model, 'id_unit', ['label' => 'Сегмент'])?>
            </div>      
            <div class="col-sm-3">
                <?= $form->field($model, 'id_segment', ['showLabels' => false])->widget(Select2::classname(), 
                    [
                        'data' => ArrayHelper::map(BgSegment::find()->all(), 'id_segment', 'name_segment'),
                        'options' => ['placeholder' => 'Укажите сегмент...'],
                        //'value' => "1",
                        'pluginOptions' => ['allowClear' => true]
                    ]) ?>
            </div>
            <div id="insurance">
                <div class="col-sm-2" style="text-align: right">
                    <?= Html::activeLabel($model, 'id_unit', ['label' => 'Страховая'])?>
                </div>      
                <div class="col-sm-3">
                    <?= $form->field($model, 'id_insurance', ['showLabels' => false])->widget(Select2::classname(), 
                        [
                            'data' => ArrayHelper::map(BgInsurance::find()->all(), 'id_insurance', 'name_insurance'),
                            'options' => ['placeholder' => 'Укажите страховую...'],
                            'pluginOptions' => ['allowClear' => true]
                        ]) ?>
                </div>
            </div>
                    
        </div>

        <!-- Install-->
        
        <hr size="3px" style="border-top:1px solid #cecece">
        <div class="form-group">
            <div class="col-sm-2" style="text-align: left">
                <?= Html::activeLabel($model, 'id_unit', ['label' => 'Диллер'])?>
            </div>      
            <div class="col-sm-3">
                <?= $form->field($model, 'id_diller_installer', ['showLabels' => false])->widget(Select2::classname(), 
                    [
                        'data' => ArrayHelper::map(BgDillerAll::find()->all(), 'id_diller', 'name_diller', 'name_city'),
                        'options' => ['placeholder' => 'Укажите диллера...'],
                        'pluginOptions' => ['allowClear' => true]
                    ]) ?>
            </div>
                    
        </div>

        <!-- Installer -->
         <div class="form-group">
            <div class="col-sm-2" style="text-align: left">
                <?= Html::activeLabel($model, 'id_unit', ['label' => 'Установщик'])?>
            </div>      
            <div class="col-sm-3">
                <?= $form->field($model, 'installer', ['showLabels' => false])->textInput()?>
            </div> 
            <div class="col-sm-2" style="text-align: right">
                <?= Html::activeLabel($model, 'id_unit', ['label' => 'Контакты'])?>
            </div> 
            <div class="col-sm-3">
                <?= $form->field($model, 'contact_installer', ['showLabels' => false])->textInput()?>
            </div>      
        </div>

        <!-- City-->
         <div class="form-group">
            <div class="col-sm-2" style="text-align: left">
                <?= Html::activeLabel($model, 'id_unit', ['label' => 'Город'])?>
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

        <!-- Date-->
        <div class="form-group">
            <div class="col-sm-2" style="text-align: left">
                <?= Html::activeLabel($model, 'id_unit', ['label' => 'Дата тестирования'])?>
            </div>      
            <div class="col-sm-3">
                 <?= $form->field($model, 'test_date', ['showLabels' => false])->widget(DatePicker::classname(),[
                                'name' => 'dp_1',
                                'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                //'value' => '28-May-1989',
                                'pluginOptions'=> [
                                    'autoclose' => true,
                                    'format' => 'yyyy-m-dd'
                                ],
                        ])?>
            </div>
                    
        </div>

        <!-- Test Status-->
         <div class="form-group">
            <div class="col-sm-2" style="text-align: left">
                <?= Html::activeLabel($model, 'id_unit', ['label' => 'Статус тестирования'])?>
            </div>      
            <div class="col-sm-3">
                <?= $form->field($model, 'test_status', ['showLabels' => false])->widget(CheckboxX::classname(), [
                            'options' => ['value' => !$model->test_status ? 0 : $model->test_status],
                            'pluginOptions' => [
                                'threeState' => false,
                            ] 
                    ])?>
            </div>        
        </div>

        <!-- Tester Operator-->
         <div class="form-group">
            <div class="col-sm-2" style="text-align: left">
                <?= Html::activeLabel($model, 'id_unit', ['label' => 'Оператор тестирования'])?>
            </div>      
            <div class="col-sm-4">
                <?= $form->field($model, 'id_tester_operator', ['showLabels' => false])->widget(Select2::classname(), 
                    [
                        'data' => ArrayHelper::map(BgOperators::find()->where(['status_operator' => 1])->all(), 'id_operator', 'name_operator'),
                        'options' => ['placeholder' => 'Укажите имя...'],
                        'pluginOptions' => ['allowClear' => true]
                    ]) ?>
            </div>
                    
        </div>

        <hr size="3px" style="border-top:1px solid #cecece">

        <!-- Sensors-->
        <div class="col-sm-3" style="text-align: left">
            <?= Html::activeLabel($model, 'id_unit', ['label' => 'Датчики'])?>
        </div>
        <br>
        <div class="form-group">
            <div class="col-sm-3">
                <?= $form->field($model, 'can_module', ['showLabels' => false])->widget(CheckboxX::classname(), [
                            'options' => ['value' => !$model->can_module ? 0 : $model->can_module],
                            'pluginOptions' => [
                                'threeState' => false,
                            ],
                            'labelSettings'  => [
                                'label' => 'CAN-модуль',
                                'position' => CheckboxX::LABEL_RIGHT
                            ]
                    ])?>
            </div>
            <div class="col-sm-3" id="can">
                <?= $form->field($model, 'id_can', ['showLabels' => false])->widget(Select2::classname(), 
                    [
                        'data' => ArrayHelper::map(BgCanSensor::find()->all(), 'id_can_sensor', 'name_can_sensor'),
                        'options' => ['placeholder' => 'Укажите тип CAN-модуля...'],
                        'pluginOptions' => ['allowClear' => true]
                    ]) ?>
            </div>
        </div>
        <div class="col-sm-3" style="text-align: left">
            <?= Html::activeLabel($model, 'id_unit', ['label' => false])?>
        </div>
        <div class="form-group">
            <div class="col-sm-3">
                <?= $form->field($model, 'volume_sensor', ['showLabels' => false])->widget(CheckboxX::classname(), [
                            'options' => ['value' => !$model->volume_sensor ? 0 : $model->volume_sensor],
                            'pluginOptions' => [
                                'threeState' => false,
                            ],
                            'labelSettings'  => [
                                'label' => 'Датчик объема',
                                'position' => CheckboxX::LABEL_RIGHT
                            ] 
                    ])?>
            </div>
            <div class="col-sm-3" id="volume">
                <?= $form->field($model, 'id_volume', ['showLabels' => false])->widget(Select2::classname(), 
                    [
                        'data' => ArrayHelper::map(BgVolumeSensor::find()->all(), 'id_volume_sensor', 'name_volume_sensor'),
                        'options' => ['placeholder' => 'Укажите тип датчика объема...'],
                        'pluginOptions' => ['allowClear' => true]
                    ]) ?>
            </div>
        </div>
        <div class="col-sm-3" style="text-align: left">
            <?= Html::activeLabel($model, 'id_unit', ['label' => false])?>
        </div>
        <div class="form-group">
            <div class="col-sm-3">
                <?= $form->field($model, 'shock_sensor', ['showLabels' => false])->widget(CheckboxX::classname(), [
                            'options' => ['value' => !$model->shock_sensor ? 0 : $model->shock_sensor],
                            'pluginOptions' => [
                                'threeState' => false,
                            ],
                            'labelSettings'  => [
                                'label' => 'Датчик удара',
                                'position' => CheckboxX::LABEL_RIGHT
                            ] 
                    ])?>
                
                <?= $form->field($model, 'rfid_tags', ['showLabels' => false])->widget(CheckboxX::classname(), [
                            'options' => ['value' => !$model->rfid_tags ? 0 : $model->rfid_tags],
                            'pluginOptions' => [
                                'threeState' => false,
                            ],
                            'labelSettings'  => [
                                'label' => 'RFID-метки',
                                'position' => CheckboxX::LABEL_RIGHT
                            ] 
                    ])?>
            </div>
        </div>

        <hr size="3px" style="border-top:1px solid #cecece">

        <!-- Activate Operator-->
         <div class="form-group">
            <div class="col-sm-2" style="text-align: left">
                <?= Html::activeLabel($model, 'id_unit', ['label' => 'Оператор активации'])?>
            </div>      
            <div class="col-sm-4">
                <?= $form->field($model, 'id_activate_operator', ['showLabels' => false])->widget(Select2::classname(), 
                    [
                        'data' => ArrayHelper::map(BgOperators::find()->where(['status_operator' => 1])->all(), 'id_operator', 'name_operator'),
                        'options' => ['placeholder' => 'Укажите имя...'],
                        'pluginOptions' => ['allowClear' => true]
                    ]) ?>
            </div>
                    
        </div>

        <!-- Activate Status-->
         <div class="form-group">
            <div class="col-sm-2" style="text-align: left">
                <?= Html::activeLabel($model, 'id_unit', ['label' => 'Статус активации'])?>
            </div>      
            <div class="col-sm-3">
                <?= $form->field($model, 'activate_status', ['showLabels' => false])->widget(CheckboxX::classname(), [
                            'options' => ['value' => !$model->activate_status ? 0 : $model->activate_status],
                            'pluginOptions' => [
                                'threeState' => false,
                            ] 
                    ])?>
            </div>        
        </div>

        <!-- Activate Date -->
        <div class="form-group">
            <div class="col-sm-2" style="text-align: left">
                <?= Html::activeLabel($model, 'id_unit', ['label' => 'Дата активации'])?>
            </div>      
            <div class="col-sm-3">
                 <?= $form->field($model, 'activate_date', ['showLabels' => false])->widget(DatePicker::classname(),[
                                'name' => 'dp_1',
                                'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                //'value' => '28-May-1989',
                                'pluginOptions'=> [
                                    'autoclose' => true,
                                    'format' => 'yyyy-m-dd'
                                ],
                        ])?>
            </div>
                    
        </div>

        <hr size="3px" style="border-top:1px solid #cecece">

        <!-- GOS NUM -->
         <div class="form-group">
            <div class="col-sm-2" style="text-align: left">
                <?= Html::activeLabel($model, 'id_unit', ['label' => 'Гос номер'])?>
            </div>      
            <div class="col-sm-3">
                <?= $form->field($model, 'gos_number', ['showLabels' => false])->textInput()?>
            </div>     
        </div>

        <!-- Model / marka -->
        <div class="form-group">
            <div class="col-sm-2" style="text-align: left">
                <?= Html::activeLabel($model, 'id_unit', ['label' => 'Марка Авто'])?>
            </div>      
            <div class="col-sm-3">
                <?= $form->field($model, 'id_marka', ['showLabels' => false])->widget(Select2::classname(), 
                    [
                        'data' => ArrayHelper::map(BgMarka::find()->all(), 'id_marka', 'name_marka'),
                        'options' => ['placeholder' => 'Укажите марку...'],
                        'pluginOptions' => ['allowClear' => true]
                    ]) ?>
            </div>
            <div class="col-sm-2" style="text-align: right">
                <?= Html::activeLabel($model, 'id_unit', ['label' => 'Модель Авто'])?>
            </div> 
            <div class="col-sm-3">
                <?= $form->field($model, 'id_model', ['showLabels' => false])->widget(Select2::classname(), [
                                        'initValueText' => BgModel::findOne($model->id_model)->name_model,
                                        'options' => ['placeholder' => 'Укажите модель...', ],
                                        'pluginOptions' => ['allowClear' => true]
                                ])?>
            </div>
                    
        </div>

        <!--Color -->
         <div class="form-group">
            <div class="col-sm-2" style="text-align: left">
                <?= Html::activeLabel($model, 'id_unit', ['label' => 'Цвет'])?>
            </div>      
            <div class="col-sm-3">
                <?= $form->field($model, 'color', ['showLabels' => false])->textInput()?>
            </div>     
        </div>

        <!--VIN -->
        <div class="form-group">
            <div class="col-sm-2" style="text-align: left">
                <?= Html::activeLabel($model, 'id_unit', ['label' => 'Номер техпаспорта'])?>
            </div>      
            <div class="col-sm-3">
                <?= $form->field($model, 'passport_number', ['showLabels' => false])->textInput()?>
            </div>  
            <div class="col-sm-2" style="text-align: right">
                <?= Html::activeLabel($model, 'id_unit', ['label' => 'VIN'])?>
            </div>      
            <div class="col-sm-3">
                <?= $form->field($model, 'vin_number', ['showLabels' => false])->textInput()?>
            </div>    
        </div>

        <!-- Date made-->
        <div class="form-group">
            <div class="col-sm-2" style="text-align: left">
                <?= Html::activeLabel($model, 'id_unit', ['label' => 'Год выпуска'])?>
            </div>      
            <div class="col-sm-3">
                 <?= $form->field($model, 'made_auto_date', ['showLabels' => false])->widget(DatePicker::classname(),[
                                'name' => 'dp_1',
                                'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                //'value' => '28-May-1989',
                                'pluginOptions'=> [
                                    'autoclose' => true,
                                    'format' => 'yyyy'
                                ],
                        ])?>
            </div>
                    
        </div>

        <!--Name owner -->
         <div class="form-group">
            <div class="col-sm-2" style="text-align: left">
                <?= Html::activeLabel($model, 'id_unit', ['label' => 'Имя владельца'])?>
            </div>      
            <div class="col-sm-6">
                <?= $form->field($model, 'name_owner', ['showLabels' => false])->textInput()?>
            </div>     
        </div>

        <!--Garant term -->
         <div class="form-group">
            <div class="col-sm-2" style="text-align: left">
                <?= Html::activeLabel($model, 'id_unit', ['label' => 'Гарантия'])?>
            </div>      
            <div class="col-sm-3">
                <?= $form->field($model, 'garant_term', ['showLabels' => false])->textInput()?>
            </div>     
        
            <div class="col-sm-2" style="text-align: right">
                <?= Html::activeLabel($model, 'id_unit', ['label' => 'Расширенная гарантия'])?>
            </div>      
            <div class="col-sm-3">
                <?= $form->field($model, 'ext_garant', ['showLabels' => false])->textInput()?>
            </div>     
        </div>

        <!--Comment -->
         <div class="form-group">
            <div class="col-sm-2" style="text-align: left">
                <?= Html::activeLabel($model, 'id_unit', ['label' => 'Примечание'])?>
            </div>      
            <div class="col-sm-6">
                        <?= $form->field($model, 'comment', ['showLabels' => false])->textArea([
                            'rows' => 3,
                        ])?>
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

<?php

$script = <<< JS
function funcSuccess(data){
    $('#bgunit-id_model').html(data);
    $('#bgunit-id_model').select2("val")
}

$('#bgunit-id_marka').change(function(){
    var id = $(this).val();
    $.ajax({
        url: "/guard/bg-unit/change-marka/",
        type: "GET",
        data: ({id : id}),
        success: funcSuccess
    })
})


JS;

$this->registerJs($script)

?>


