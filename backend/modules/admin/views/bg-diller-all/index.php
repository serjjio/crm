<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;
use yii\web\JsExpression;
use backend\modules\guard\models\BgDillerAll;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\guard\models\BgDillerInstallerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = false;
?>
<div class="bg-diller-all-index">
  

  <?php
    if (Yii::$app->user->can('createGuard')) {
        $columns = [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'name_city',
                'label' => 'Город', 
                //'value' => 'name_city',
                'group' => true,
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(BgDillerAll::find()->orderBy('name_city')->asArray()->all(), 'name_city', 'name_city'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear'=>true],
                ],
               'filterInputOptions' => ['placeholder' => 'Город'],
               'format' => 'raw',
            ],

            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'name_diller',
                'label' => 'Диллер утановщик', 
                'editableOptions' => [
                    'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                    'formOptions' => ['action' => ['edit-name', 'id' => $model->id_diller]],
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
                'attribute' => 'name_city',
                'label' => 'Город', 
                'value' => 'name_city',
                'group' => true,
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(BgDillerAll::find()->orderBy('name_city')->asArray()->all(), 'name_city', 'name_city'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear'=>true],
                ],
               'filterInputOptions' => ['placeholder' => 'Город'],
               'format' => 'raw',
            ],

            [
                'attribute' => 'name_diller',
                'label' => 'Диллер утановщик', 
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
            'before' => Yii::$app->user->can('createGuard') ? Html::a('<i class="glyphicon glyphicon-plus"></i> Добавить', 
                            ['create'], 
                            [
                                'data-pjax'=>0, 
                                'class' =>'btn create',
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
