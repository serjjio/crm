<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;
use yii\web\JsExpression;
use backend\modules\guard\models\BgMarka;
use backend\modules\guard\models\BgModel;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\guard\models\BgModelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

  <?php
    if (Yii::$app->user->can('createGuard')) {
        $columns = [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id_marka',
                'label' => 'Марка', 
                'value' => 'idMarka.name_marka',
                'group' => true,
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(BgMarka::find()->orderBy('name_marka')->asArray()->all(), 'id_marka', 'name_marka'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear'=>true],
                ],
               'filterInputOptions' => ['placeholder' => 'Марка'],
               'format' => 'raw',
            ],

            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'name_model',
                'label' => 'Модель', 
                'filterType' => GridView::FILTER_SELECT2,
                //'filter' => ArrayHelper::map(BgModel::find()->orderBy('name_model')->asArray()->all(), 'name_model', 'name_model'),
                'filterWidgetOptions' => [
                    'pluginOptions' => [
                        'allowClear'=>true,
                        'minimumInputLength' => 1,
                                    'language' => [
                                        'errorLoading' => new JsExpression("function () {return 'Ожидание...'}"),
                                        'inputTooShort' => new JsExpression("function () {return 'Введите больше 1 символа'}"),
                                        'noResults' => new JsExpression("function () {return 'Совпадений не найдено'}"),
                                    ],
                                    'ajax' => [
                                        'url' => '/guard/bg-model/model-list',
                                        'dataType' => 'json',
                                        'data' => new JsExpression("function (params) {return {q:params.term};}"),
                                    ],
                                    'escapeMarkup' => new JsExpression("function (markup) {return markup;}"),
                                    'templateResult' => new JsExpression("function (id_model) {return id_model.text;}"),
                                    'templateSelection' => new JsExpression("function (id_model) {return id_model.text;}"),
                    ],
                ],
               'filterInputOptions' => ['placeholder' => 'Модель'],
               'format' => 'raw',
                'editableOptions' => [
                    'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                    'formOptions' => ['action' => ['edit-name', 'id' => $model->id_model]],
                    'asPopover' => false
                ],
            ], 
        ];
    }else{
        $columns = [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id_marka',
                'label' => 'Марка', 
                'value' => 'idMarka.name_marka',
                'group' => true,
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(BgMarka::find()->orderBy('name_marka')->asArray()->all(), 'id_marka', 'name_marka'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear'=>true],
                ],
               'filterInputOptions' => ['placeholder' => 'Марка'],
               'format' => 'raw',
            ],

            [
                'attribute' => 'name_model',
                'label' => 'Модель', 
                'filterType' => GridView::FILTER_SELECT2,
                //'filter' => ArrayHelper::map(BgModel::find()->orderBy('name_model')->asArray()->all(), 'name_model', 'name_model'),
                'filterWidgetOptions' => [
                    'pluginOptions' => [
                        'allowClear'=>true,
                        'minimumInputLength' => 1,
                                    'language' => [
                                        'errorLoading' => new JsExpression("function () {return 'Ожидание...'}"),
                                        'inputTooShort' => new JsExpression("function () {return 'Введите больше 1 символа'}"),
                                        'noResults' => new JsExpression("function () {return 'Совпадений не найдено'}"),
                                    ],
                                    'ajax' => [
                                        'url' => '/guard/bg-model/model-list',
                                        'dataType' => 'json',
                                        'data' => new JsExpression("function (params) {return {q:params.term};}"),
                                    ],
                                    'escapeMarkup' => new JsExpression("function (markup) {return markup;}"),
                                    'templateResult' => new JsExpression("function (id_model) {return id_model.text;}"),
                                    'templateSelection' => new JsExpression("function (id_model) {return id_model.text;}"),
                    ],
                ],
               'filterInputOptions' => ['placeholder' => 'Модель'],
               'format' => 'raw',
            ], 
        ];
    }
    ?>


<div class="bg-model-index">
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
            

        ],
    ]); ?>
</div>
