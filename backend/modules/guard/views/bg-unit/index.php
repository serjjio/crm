<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;
use yii\web\JsExpression;
use backend\modules\guard\models\BgClient;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\guard\models\BgUnitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="bg-unit-index">

     <?php

        Modal::begin([
                'options' => ['tabindex' => false],
                'id' => 'root',
                'size' => 'modal-lg',

            ]);
        echo "<div id='modalContent'></div>";
        Modal::end();

    ?>
    <? 
        if (Yii::$app->session->hasFlash('kv-detail-success')){
            Alert::begin([
                'options' => ['class'=>'alert-success']
            ]);

                echo Yii::$app->session->getFlash('kv-detail-success');
            Alert::end();
        }
    ?>

    <?
            //'id_unit',
            //'unit_number',
            //'id_type_unit',
            //'sim_number',
            //'test_date',
            // 'id_city',
            // 'id_diller_installer',
            // 'installer',
            // 'contact_installer',
            // 'test_status',
            // 'can_module',
            // 'shock_sensor',
            // 'volume_sensor',
            // 'rfid_tags',
            // 'vin_number',
            // 'id_tester_operator',
            // 'activate_date',
            // 'activate_status',
            // 'id_activate_operator',
            // 'garant_term',
            // 'id_marka',
            // 'name_model',
            // 'gos_number',
            // 'color',
            // 'id_model',
            // 'made_auto_date',
            // 'passport_number',
            // 'name_owner',
            // 'comment',
    ?>
    <?php
        $columns = [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'unit_number',
                'label' => 'Номер блока', 
                'format' => 'raw',
                'value' => function($model, $key){
                    return Html::a($model->unit_number, ['bg-unit/update/'.$key], 
                                    [
                                        //'class' => 'create-object',
                                        'title' => Yii::t('app', 'Редактировать'),
                                        'data-pjax' => 0
                                    ]);
                }
            ],

            [
                'attribute' => 'id_client',
                'label' => 'Имя клиента', 
                'value' => function ($model){
                    $name =  ArrayHelper::getValue(BgClient::findOne($model->id_client), 'client_name');
                    return Html::a($name, [Url::to('bg-client/detail-view/'.$model->id_client)], ['data-pjax' => 0]);
                },
                'contentOptions' => ['style' => 'max-width:300px; white-space:normal'],
                'format' => 'raw',
            ],

            /*[
                'attribute' => 'id_type_unit',
                'label' => 'Тип трекера', 
                'value' => 'idTypeUnit.name_type_unit'
            ],*/

            [
                'attribute' => 'sim_number',
                'label' => 'СИМ-карта', 
            ],

            [
                'attribute' => 'gos_number',
                'label' => 'Гос номер', 
            ],
            [
                'attribute' => 'vin_number',
                'label' => 'VIN', 
            ],
            /*[
                'attribute' => 'id_model',
                'label' => 'Модель', 
                'value' => 'idModel.name_model'
            ],*/
            [
                'attribute' => 'test_date',
                'value' => 'test_date',
                'label' => 'Дата тестирования',
                'format' => ['date', 'php:Y-m-d'],
                //'width' => 'auto',
                'filterType' => GridView::FILTER_DATE_RANGE,
                'filterWidgetOptions' => [
                    'model' => $model,
                    'attribute' => 'test_date',
                    'presetDropdown' => true,
                    'defaultPresetValueOptions' => [
                       'style' => 'display:none',
                    ],
                    //hideInput' => true,
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'locale' => ['format' => 'Y-m-d', 'separator' => ' : ']
                    ],
                    'pluginEvents' => [
                        "cancel.daterangepicker" => "function(ev, picker){
                            picker.element[0].children[1].textContent='';
                            $(picker.element[0].nextElementSibling).val('').trigger('change');
                        }",
                        'apply.daterangepicker'=>'function(ev, picker){
                            var val = picker.startDate.format(picker.locale.format) + picker.locale.separator + picker.endDate.format(picker.locale.format);
                            picker.element[0].children[1].textContent = val;
                            $(picker.element[0].nextElementSibling).val(val);
                        }',
                    ]
                ]
            ],
            [
                'attribute' => 'activate_date',
                'value' => 'activate_date',
                'label' => 'Дата активации',
                'format' => ['date', 'php:Y-m-d'],
                //'width' => 'auto',
                'filterType' => GridView::FILTER_DATE_RANGE,
                'filterWidgetOptions' => [
                    'model' => $model,
                    'attribute' => 'activate_date',
                    'presetDropdown' => true,
                    'defaultPresetValueOptions' => [
                       'style' => 'display:none',
                    ],
                    //hideInput' => true,
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'locale' => ['format' => 'Y-m-d', 'separator' => ' : ']
                    ],
                    'pluginEvents' => [
                        "cancel.daterangepicker" => "function(ev, picker){
                            picker.element[0].children[1].textContent='';
                            $(picker.element[0].nextElementSibling).val('').trigger('change');
                        }",
                        'apply.daterangepicker'=>'function(ev, picker){
                            var val = picker.startDate.format(picker.locale.format) + picker.locale.separator + picker.endDate.format(picker.locale.format);
                            picker.element[0].children[1].textContent = val;
                            $(picker.element[0].nextElementSibling).val(val);
                        }',
                    ]
                ]
            ],

            [
                'class' => 'kartik\grid\BooleanColumn',
                'attribute' => 'status',
                'vAlign' => 'middle',
                'label' => 'Статус',
                'width' => '100px',
                'trueLabel' => 'Активный',
                'falseLabel' => 'Неактивный',
                'width' => '20px',
            ],
            [
                'class' => 'kartik\grid\BooleanColumn',
                'attribute' => 'activate_status',
                'vAlign' => 'middle',
                'label' => 'Статус активации',
                'width' => '100px',
                'trueLabel' => 'Активный',
                'falseLabel' => 'Неактивный',
                'width' => '20px',
            ],

            [
                'class' => 'kartik\grid\CheckboxColumn',
                'headerOptions' => ['class' => 'kartik-sheet-style']
            ]
        ]
    ?>
    
        <?= GridView::widget([
        'id' => 'pl-grid-units',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        //'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
        'tableOptions' => ['class' => 'mytable kv-grid-table table table-hover table-bordered table-condensed' ],
        'columns' => $columns,
        'condensed' => true,
        'resizableColumns'=>true,
        'persistResize' => false,
        'pjax' => true,

        'striped' => true,
        'pjaxSettings' => [
                'options' => [
                    'id' => 'kv-pjax-container'
                ],
        ],

        
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'rowOptions' => function($model){
            return $model->status ? ['style' => 'word-wrap:break-word'] : ['style' => 'background-color:#DCDCDC'];
        },
        
        //'layout' => $layout,

        'responsive' => false,
        'responsiveWrap' => true,
        'hover' => true,
       
       
        'toggleDataOptions' => [
            'type'=>30,
        ],

        'export' => false,
        
        

        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            //'type' => 'success',
            'heading' => 'Охрана',
            'before' => Yii::$app->user->can('createGuard') ? Html::a('<i class="glyphicon glyphicon-plus"></i> Добавить блок', 
                            ['create'], 
                            [
                                'data-pjax'=>0, 
                                'class' =>'btn create',
                                'title' => Yii::t('app', 'Добавить блок'),
                            ]) : false,
            'after' => Html::a('<i class="glyphicon glyphicon-trash"></i> Удалить выбраные', 
                            ['delete-selected'], 
                            [
                                //'data-pjax'=>0, 
                                'class' => !Yii::$app->user->can('createGuard') ? 'btn btn-danger disabled hide' : 'btn btn-danger delete-selected disabled',
                                'title' => Yii::t('app', 'Delete Selected'),
                                //'id' => 'delete-selected',
                            ]),
            'afterOptions' => ['class' => 'kv-panel-after pull-right']

        ],
    ]); ?>
</div>
