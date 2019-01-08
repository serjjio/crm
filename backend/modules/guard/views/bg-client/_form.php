<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use yii\web\JsExpression;
use backend\modules\guard\models\BgClient;
use backend\modules\guard\models\BgDillerAll;

use kartik\checkbox\CheckboxX;

/* @var $this yii\web\View */
/* @var $model backend\modules\guard\models\BgClient */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bg-client-form">

    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: #337ab7; color: white">
            <h3 class="panel-title">Информация об клиенте</h3>
        </div>
        <div class="panel-body" style="color: #337ab7">
            <?php $form = ActiveForm::begin(['id' => $model->formName(), 'type' => ActiveForm::TYPE_HORIZONTAL, 'enableAjaxValidation' => true, 'disabled' => !Yii::$app->user->can('createGuard') ? true : false]); ?>

                <!--  -->
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
                        <?= Html::activeLabel($model, 'id_client', ['label' => 'Имя клиента'])?>
                    </div>      
                    <div class="col-sm-10 right-help">
                        <?= $form->field($model, 'client_name', ['showLabels' => false])->textInput()?>
                    </div> 

                </div>
                <!-- Diller -->

                
                <!-- Name Manager -->
                <div class="form-group">

                    <div class="col-sm-2" style="text-align: left">
                        <?= Html::activeLabel($model, 'id_client', ['label' => 'Менеджер'])?>
                    </div>      
                    <div class="col-sm-4">
                        <?= $form->field($model, 'name_manager', ['showLabels' => false])->textInput()?>
                    </div> 
    
                </div>

                

                <!-- Contract Number -->
                <div class="form-group">

                    <div class="col-sm-2" style="text-align: left">
                        <?= Html::activeLabel($model, 'id_client', ['label' => 'Номер договора'])?>
                    </div>      
                    <div class="col-sm-4">
                        <?= $form->field($model, 'contract_number', ['showLabels' => false])->textInput()?>
                    </div> 

                    <div class="col-sm-2" style="text-align: right">
                        <?= Html::activeLabel($model, 'id_unit', ['label' => 'Дата договора'])?>
                    </div>      
                    <div class="col-sm-4">
                         <?= $form->field($model, 'contract_date', ['showLabels' => false])->widget(DatePicker::classname(),[
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

                <!-- Contacts -->
                <div class="form-group">

                    <div class="col-sm-2" style="text-align: left">
                        <?= Html::activeLabel($model, 'id_client', ['label' => 'Контакт 1'])?>
                    </div>      
                    <div class="col-sm-4">
                        <?= $form->field($model, 'contact1', ['showLabels' => false])->textInput()?>
                    </div> 
                    <div class="col-sm-2" style="text-align: right">
                        <?= Html::activeLabel($model, 'id_client', ['label' => 'Контакт 2'])?>
                    </div>      
                    <div class="col-sm-4">
                        <?= $form->field($model, 'contact2', ['showLabels' => false])->textInput()?>
                    </div>
                </div>

                <div class="form-group">

                    <div class="col-sm-2" style="text-align: left">
                        <?= Html::activeLabel($model, 'id_client', ['label' => 'Электронная почта'])?>
                    </div>      
                    <div class="col-sm-10 right-help">
                        <?= $form->field($model, 'email', ['showLabels' => false,])->textInput(['placeholder' => 'email'])?>
                    </div> 
                </div>

                <!--Comment -->
                 <div class="form-group">
                    <div class="col-sm-2" style="text-align: left">
                        <?= Html::activeLabel($model, 'id_client', ['label' => 'Примечание'])?>
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

</div>
