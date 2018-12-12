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
/* @var $searchModel backend\modules\guard\models\BgDillerInstallerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="bg-diller-installer-index">
  

  <?php
    if (Yii::$app->user->can('createGuard')) {
        $columns = [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'name_diller_installer',
                'label' => 'Диллер утановщик', 
                'editableOptions' => [
                    'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                    'formOptions' => ['action' => ['edit-name', 'id' => $model->id_diller_installer]],
                    'asPopover' => false
                ],
            ], 
        ];
    }else{
        $columns = [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'name_diller_installer',
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
            'before' => Yii::$app->user->can('createGuard') ? '<input id="dynamic-input" type="text" placeholder="Имя диллера" class="form-control" style="width:30%;display:inline">'.Html::a('<i class="glyphicon glyphicon-plus"></i> Добавить', 
                            ['create'], 
                            [
                                'data-pjax'=>0, 
                                'class' =>'btn dynamic-create',
                                'title' => Yii::t('app', 'Добавить'),
                            ]) : false,
            

        ],
    ]); ?>
</div>
