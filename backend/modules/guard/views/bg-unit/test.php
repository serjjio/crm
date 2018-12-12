<?php
use kartik\form\ActiveForm;
use yii\helpers\Html;
?>

<?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL, 'options' => ['enctype' => 'multipart/form-data']]) ?>
<div class="col-sm-3">
                <?= $form->field($model, 'file', ['showLabels' => false])->FileInput()?>
            </div> 

            <div class="form-group">
                <div class="col-sm-offset-0 col-sm-10">
                    <?= Html::submitButton('Создать', ['class' => 'btn btn-success'])?>
                </div>
        </div>
<?php ActiveForm::end();  ?>
