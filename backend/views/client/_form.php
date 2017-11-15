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
use app\models\Type;
use app\models\Segment;

/* @var $this yii\web\View */
/* @var $model app\models\Inst */
/* @var $form yii\widgets\ActiveForm */
?>
<?php

    Modal::begin([
                'header'=>'<h4 class="moadl-tittle">Detail Inst</h4>',
                'options' => ['tabindex' => false],
                'id' => 'blok',

            ]);
        echo "<div id='modalContent'></div>";
    Modal::end();

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Создание клиента</h3>
    </div>
    <div class="panel-body">
        <?php Pjax::begin(['id' => 'auto'])?>
        <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL, 'options' => ['enctype' => 'multipart/form-data']]) ?>

                <div class="form-group">
                    
                        <div class="col-sm-4">
                            <?= $form->field($model, 'clientName', ['showLabels' => false])->textInput(['placeholder' => 'Имя клиента в 1С'])?>
                        </div>
                        <div class="col-sm-2">
                            <?= $form->field($model, 'idSegment', ['showLabels' => false])->widget(Select2::classname(), 
                                [
                                    'data' => ArrayHelper::map(Segment::find()->all(), 'idSegment', 'nameSegment'),
                                    'options' => ['placeholder' => 'Укажите сегмент'],
                                    'pluginOptions' => ['allowClear' => true]
                                ]) ?>
                        </div>
                        <div class="col-sm-3">
                            <?= $form->field($model, 'structure', ['showLabels' => false])->textInput(['placeholder' => 'Структура'])?>
                        </div>
                        
                        
                </div>
                <div class="form-group">
                    <?= Html::activeLabel($model, 'idClient', ['label' => 'Юридический статус:', 'class' => 'col-sm-3 control-label'])?>
                        <div class="col-sm-2">
                            <?= $form->field($model, 'idType', ['showLabels' => false])->widget(Select2::classname(), 
                                [
                                    'data' => ArrayHelper::map(Type::find()->all(), 'idType', 'nameType'),
                                    'options' => ['placeholder' => false],
                                    'pluginOptions' => ['allowClear' => true]
                                ]) ?>
                        </div>
                    <div class="col-sm-3">
                            <?= $form->field($model, 'edrpou', ['showLabels' => false])->textInput(['placeholder' => 'Код ЕРДПОУ'])?>
                    </div>
                    
                </div>
                
                <div class="form-group">
                    
                    <?= Html::activeLabel($model, 'idClient', ['label' => 'Договор обслуживания:', 'class' => 'col-sm-3 control-label'])?>
                    <div class="col-sm-3">
                            <?= $form->field($modelContract, 'serviceContract',['showLabels' => false])->textInput(['placeholder' => 'договор'])?>
                    </div>
                    <div class="col-sm-3">
                        <?= $form->field($modelContract, 'date_service_contract', ['showLabels' => false])->widget(DatePicker::classname(),[
                                'name' => 'dp_1',
                                'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                //'value' => '28-May-1989',
                                'pluginOptions'=> [
                                    'autoclose' => true,
                                    'format' => 'dd-m-yyyy'
                                ],
                                //'options' => ['placeholder' => 'Select date...']
                        ])?>
                    </div>
    
                </div>
                
                <div class="form-group">
                    
                        <?= Html::activeLabel($model, 'idClient', ['label' => 'Контактная информация:', 'class' => 'col-sm-3 control-label'])?>
                        <div class="col-sm-3">
                            <?= $form->field($model, 'publicTel', ['showLabels' => false])->textInput(['placeholder' => 'Контактный тел.'])?>
                        </div>
                        <div class="col-sm-3">
                            <?= $form->field($model, 'publicEmail', [
                                                                        'showLabels' => false,
                                                                        'feedbackIcon' => [
                                                                            'default' => 'envelope',
                                                                            'success' => 'ok',
                                                                            'error' => 'exclamation-sign',
                                                                            'defaultOptions' => ['class' => 'text-primery']
                                                                        ]
                                                                    ])->textInput(['placeholder' => 'email'])?>
                        </div>
                    

                </div>
                <div class="form-group">
                    <?= Html::activeLabel($model, 'logo', ['label' => 'Логотип:', 'class' => 'col-sm-3 control-label'])?>
                    <div class="col-sm-5">
                        <?= $form->field($model, 'imgLogo', ['showLabels' => false])->widget(FileInput::classname(),[
                                'options' => ['accept' => 'images/*'],
                                'pluginOptions' => [
                                    'showPreview' => false,
                                    'showCaption' => true,
                                    'showRemove' => true,
                                    'showUpload' => false,
                                    
                                ]
                        ])?>
                    </div>
                </div>
                <div class="form-group">
                    <?= Html::activeLabel($model, 'idClient', ['label' => 'Менеджер проекта:', 'class' => 'col-sm-3 control-label'])?>
                        <div class="col-sm-5">
                            <?= $form->field($model, 'prManager', ['showLabels' => false])->textInput(['placeholder' => 'Имя'])?>
                        </div>
                </div>
                <div class="form-group">
                    <?= Html::activeLabel($model, 'ID', ['label' => 'Комментарий:', 'class' => 'col-sm-3 control-label'])?>
                    <div class="col-sm-6">
                        <?= $form->field($model, 'comment', ['showLabels' => false])->textArea([
                            'placeholder' => 'Сюда можно что-то написать',
                            'rows' => 4,
                        ])?>
                    </div>
                </div>
            
            
            
   


            <div class="form-group">

                <div class="col-sm-offset-7 col-sm-10">
                    
                    <?= Html::submitButton('Создать', ['class' => 'btn btn-primary'])?>
                    <?= Html::submitButton('Обновить', ['class' => 'btn btn-default'])?>
                </div>
            </div>
            
            


        <?php ActiveForm::end();  ?>
        <?php Pjax::end()?>

    </div>
</div>

<?php

$script = <<< JS



JS;

$this->registerJs($script)

?>

