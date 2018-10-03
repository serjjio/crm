<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\file\FileInput;

?>
<?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL, 'options' => ['enctype' => 'multipart/form-data']]) ?>

<div class="form-group">
                    
                    <div class="col-sm-5">
                        <?= $form->field($model, 'excel', ['showLabels' => false])->widget(FileInput::classname(),[
                                //'options' => ['accept' => 'images/*'],
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

                <div class="col-sm-offset-0 col-sm-10">
                    
                    <?= Html::submitButton('Создать', ['class' => 'btn btn-primary'])?>
            
                </div>
            </div>

 <?php ActiveForm::end();  ?>