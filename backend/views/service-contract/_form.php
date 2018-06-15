<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;
use kartik\widgets\ActiveField;
use app\models\Client;
use kartik\select2\Select2;
use yii\widgets\Pjax;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\ServiceContract */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-contract-form">
<?php $form = ActiveForm::begin(['id' => $model->formName(), 'type' => ActiveForm::TYPE_HORIZONTAL]); ?>
<div class="panel panel-info" style="margin-bottom: 0px">
    <div class="panel-heading">
        <h3 class="panel-title"><?= $model->isNewRecord ? 'Создание договора' : 'Редактирование договора'?></h3>
    </div>
    <div class="panel-body" style="padding: 0">
	<div style="overflow:auto">
     <table class="mytable table table-bordered">
         <tbody>
             <tr>
                 <th>Номер договора</th>
                 <td><?= $form->field($model, 'name_service_contract', ['showLabels' => false])->textInput(['placeholder' => 'Номер'])?></td>
             </tr>
             <tr>
                 <th>Клиент</th>
                 <td style="color: #6d9eeb"><?=ArrayHelper::getValue(Client::findOne($model->idClient), 'clientName')?></td>
             </tr>
             <tr>
                 <th>Дата подписания</th>
                 <td><?= $form->field($model, 'date_service_contract', ['showLabels' => false])->widget(DatePicker::classname(),[
                                'name' => 'dp_1',
                                'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                                //'value' => '28-May-1989',
                                'pluginOptions'=> [
                                    'autoclose' => true,
                                    'format' => 'dd-m-yyyy'
                                ],
                                //'options' => ['placeholder' => 'Select date...']
                        ])?></td>
             </tr>
             <tr>
                 <th>Примечание</th>
                 <td><?= $form->field($model, 'description_service_contract', ['showLabels' => false])->textArea([
                            'placeholder' => 'Введите текст...',
                            'rows' => 4,
                        ])?></td>
             </tr>
         </tbody>
     </table>
     </div>   
     
        
	    <!-- <div class="form-group">
	       <?= Html::activeLabel($model, 'id_service_contract', ['label' => 'Номер договора', 'class' => 'col-sm-4 control-label'])?>
                <div class="col-sm-7">
                    <?= $form->field($model, 'name_service_contract', ['showLabels' => false])->textInput(['placeholder' => 'Номер'])?>
                </div>
	    </div> -->

	    <!-- <div class="form-group">
                        <div class="col-sm-4">
                            <?= $form->field($model, 'idClient', ['showLabels' => false])->widget(Select2::classname(), 
                                [
                                    'data' => ArrayHelper::map(Client::find()->all(), 'idClient', 'clientName'),
                                    'options' => ['placeholder' => 'name client'],
                                    'pluginOptions' => ['allowClear' => true]
                                ]) ?>
                        </div>
        </div> -->
        <!-- <div class="form-group">
                    <div class="col-sm-4">
                        <?= $form->field($model, 'date_service_contract', ['showLabels' => false])->widget(DatePicker::classname(),[
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
                </div> -->
<!-- 
    <?= $form->field($model, 'name_service_contract')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_service_contract')->textInput() ?>

    <?= $form->field($model, 'idClient')->textInput() ?> -->

	    <div style="text-align: right; padding-bottom: 20px; padding-right: 20px;">
	        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>

	    
	</div>
</div>
<?php ActiveForm::end(); ?>
</div>
