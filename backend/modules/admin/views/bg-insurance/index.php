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
/* @var $searchModel backend\modules\guard\models\BgInsuranceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = false;
?>
<div class="bg-insurance-index">

  <?php
    if (Yii::$app->user->can('createGuard')) {
        $columns = [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'name_insurance',
                'label' => 'Страховая', 
                'editableOptions' => [
                    'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                    'formOptions' => ['action' => ['edit-name', 'id' => $model->id_insurance]],
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
                'attribute' => 'name_insurance',
                'label' => 'Страховая',
            ],

            
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
        'toggleDataOptions' => [
            'type'=>30,
        ],

        'export' => false,
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            //'type' => 'success',
            //'heading' => 'Блоки',
            'before' => Yii::$app->user->can('createGuard') ? '<input id="dynamic-input" type="text" placeholder="Страховая" class="form-control" style="width:30%;display:inline">'.Html::a('<i class="glyphicon glyphicon-plus"></i> Добавить', 
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
