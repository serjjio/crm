<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;
use yii\web\JsExpression;
use backend\modules\guard\models\BgOperators;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\guard\models\BgOperatorsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = false;
?>
<div class="bg-operators-index">

  <?php
    if (Yii::$app->user->can('createGuard')) {
        $columns = [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'name_operator',
                'label' => 'Имя Оператора', 
                'editableOptions' => [
                    'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                    //'data' => [1=> 'Активный', 0 => 'Неактивный'],
                    'header' => 'Имя',
                    'formOptions' => ['action' => ['edit-name', 'id' => $model->id_operator]],
                    'asPopover' => false
                ],
            ],

            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'status_operator',
                'label' => 'Статус',
                'value' => function($model){
                    return $model->status_operator==1 ? 'Активный' :  'Неактивный';
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => [1=> 'Активный', 0 => 'Неактивный'],/*ArrayHelper::map(BgOperators::find()->asArray()->all(), 'status_operator', 'status_operator'),*/
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear'=>true]
                ],
                'format' => 'raw',
                'filterInputOptions' => ['placeholder' => 'Статус'], 
                'editableOptions' => [
                    'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                    'data' => [1=> 'Активный', 0 => 'Неактивный'],
                    'header' => 'Статус',
                    'formOptions' => ['action' => ['edit-status', 'id' => $model->id_operator]],
                    'asPopover' => false
                ],
                
            ],
            [
                    'class' => 'kartik\grid\CheckboxColumn',
                    'headerOptions' => ['class' => 'kartik-sheet-style']
            ]

            
        ];
    }else{
        $columns = [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'name_operator',
                'label' => 'Имя Оператора',
            ],

            [
                'attribute' => 'status_operator',
                'label' => 'Статус',
                'value' => function($model){
                    return $model->status_operator==1 ? 'Активный' :  'Неактивный';
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => [1=> 'Активный', 0 => 'Неактивный'],/*ArrayHelper::map(BgOperators::find()->asArray()->all(), 'status_operator', 'status_operator'),*/
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear'=>true]
                ],
                'format' => 'raw',
                'filterInputOptions' => ['placeholder' => 'Статус'],
                
            ]

            
        ];
    }
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
        'responsive' => false,
        'responsiveWrap' => true,
        'hover' => true,
        'rowOptions' => function($model){
            return $model->status_operator ? ['style' => 'word-wrap:break-word'] : ['style' => 'background-color:#DCDCDC'];
        },
       
       
        'toggleDataOptions' => [
            'type'=>30,
        ],

        'export' => false,
        
        

        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            //'type' => 'success',
            //'heading' => 'Блоки',
            'before' => Yii::$app->user->can('createGuard') ? '<input id="dynamic-input" type="text" placeholder="ФИО" class="form-control" style="width:30%;display:inline">'.Html::a('<i class="glyphicon glyphicon-plus"></i> Добавить', 
                            ['create'], 
                            [
                                'data-pjax'=>0, 
                                'class' => !Yii::$app->user->can('createGuard') ? 'btn create hide' : 'btn dynamic-create',
                                'title' => Yii::t('app', 'Добавить'),
                            ]) : false,
            'after' => Html::a('<i class="glyphicon glyphicon-trash"></i> Удалить выбраные', 
                            ['delete-selected'], 
                            [
                                //'data-pjax'=>0, 
                                'class' => !Yii::$app->user->can('admin') ? 'btn btn-danger disabled hide' : 'btn btn-danger delete-selected disabled',
                                'title' => Yii::t('app', 'Delete Selected'),
                                //'id' => 'delete-selected',
                            ]),
            'afterOptions' => ['class' => 'kv-panel-after pull-right']
            

        ],
    ]); ?>
</div>
