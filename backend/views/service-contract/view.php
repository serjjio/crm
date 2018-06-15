<?php


use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;
use kartik\editable\Editable;
use app\models\Client;
use Yii;
use yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $model app\models\ServiceContract */

?>

<div class="service-contract-view">
<?php
    $columns = [
            [
                'columns' => [
                    [
                        'attribute' => 'name_service_contract',
                        'label' => 'Номер договора',
                        'labelColOptions' => ['style' => 'width:35%'],
                    ],
                            
                ]
            ],
            [
                'columns' => [
                    [
                        'attribute' => 'date_service_contract',
                        'label' => 'Дата подписания',
                        //'valueColOptions' => ['style' => 'width:30%'],
                        'format' => ['date', 'php:Y-m-d'],
                        'labelColOptions' => ['style' => 'width:35%'],
                        'type' => DetailView::INPUT_DATE,
                        'widgetOptions' => [
                            'pluginOptions' => ['format'=>'yyyy-mm-dd']
                        ],
                    ],
                            
                ]
            ],
            [
                'columns' => [
                    [
                        'attribute' => 'idClient',
                        'label' => 'Клиент',
                        'displayOnly' => true,
                        'labelColOptions' => ['style' => 'width:35%'],
                        'value' => ArrayHelper::getValue(Client::findOne($model->idClient), 'clientName'),
                        //'valueColOptions' => ['style' => 'width:30%'],
                        
                    ],
                            
                ]
            ],
            [
                'columns' => [
                    [
                        'attribute' => 'description_service_contract',
                        'label' => 'Описание договора',
                        'format' => 'raw',
                        'labelColOptions' => ['style' => 'width:35%'],
                        'value' => '<span class="text-justify"><em>' . $model->description_service_contract . '</em></span>',
                        'type' => DetailView::INPUT_TEXTAREA,
                        'options' => ['rows'=>4]
                        //'valueColOptions' => ['style' => 'width:30%'],
                        
                    ],
                            
                ]
            ],
        ]
?>
<?php

    echo DetailView::widget([
        'model' => $model,
        'condensed' => true,
        'hover' => true,
        'responsive' => true,
        'mode' => 'view',
        'formOptions' => [
            'options' => ['data-pjax' => 1],
            'enableClientValidation' => true,
                //'action' => Url::to('delete')
        ],
        'panel'=> [
            'heading' => 'Детали доп. соглашения',
            'type'=>DetailView::TYPE_INFO,
        ],
        'buttons1' => (Yii::$app->user->identity->username == "sale") ? '' : '{update}{delete}',
        'deleteOptions' => [
                    'url' => ['delete'],
                    'params' => ['id' => $model->id_service_contract, 'pldelete' => true],
                    //'method' => 'post',
                    'ajaxSettings' => [
                        'success' => new \yii\web\JsExpression("
                            function(data) {
                                $('#root').modal('hide');
                                $.pjax.reload({container:'#test-test'});
                                function deletAlert(){
                                  $('#client-container .kv-alert-container').fadeOut('slow');  
                                };
                                setTimeout(deletAlert, 3000);
                                //$('#client-container .kv-alert-container').addClass('kv-detail-success').show().append('sdsdsd')
                                

                             }
                        ")
                    ]
                ],
        'container' => ['id'=>'contract-container'],
        'attributes' => $columns,
    ]) ;

?>
</div>



