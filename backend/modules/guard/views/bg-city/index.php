<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;
use yii\web\JsExpression;
use backend\modules\guard\models\BgCity;
use backend\modules\guard\models\BgOblast;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\guard\models\BgCitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="bg-city-index">


  <?php
    if (Yii::$app->user->can('createGuard')) {
        $columns = [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'name_oblast',
                'label' => 'Область', 
                'value' => 'name_oblast',
                'group' => true,
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(BgCity::find()->orderBy('name_oblast')->asArray()->all(), 'name_oblast', 'name_oblast'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear'=>true],
                ],
               'filterInputOptions' => ['placeholder' => 'Область'],
               'format' => 'raw',
            ],

            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'name_sity',
                'label' => 'Город', 
                'filterType' => GridView::FILTER_SELECT2,
                //'filter' => ArrayHelper::map(BgCity::find()->orderBy('name_sity')->asArray()->all(), 'name_sity', 'name_sity'),
                'filterWidgetOptions' => [
                    'pluginOptions' => [
                        'allowClear'=>true,
                        'minimumInputLength' => 3,
                                    'language' => [
                                        'errorLoading' => new JsExpression("function () {return 'Ожидание...'}"),
                                        'inputTooShort' => new JsExpression("function () {return 'Введите больше 3 символов'}"),
                                        'noResults' => new JsExpression("function () {return 'Совпадений не найдено'}"),
                                    ],
                                    'ajax' => [
                                        'url' => '/guard/bg-city/city-list',
                                        'dataType' => 'json',
                                        'data' => new JsExpression("function (params) {return {q:params.term};}"),
                                    ],
                                    'escapeMarkup' => new JsExpression("function (markup) {return markup;}"),
                                    'templateResult' => new JsExpression("function (id_city) {return id_city.text;}"),
                                    'templateSelection' => new JsExpression("function (id_city) {return id_city.text;}"),
                    ],
                ],
               'filterInputOptions' => ['placeholder' => 'Город'],
               'format' => 'raw',
                'editableOptions' => [
                    'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                    'formOptions' => ['action' => ['edit-name', 'id' => $model->id_city]],
                    'asPopover' => false
                ],
            ], 
        ];
    }else{
        $columns = [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'name_oblast',
                'label' => 'Область', 
                'value' => 'name_oblast',
                'group' => true,
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(BgCity::find()->orderBy('name_oblast')->asArray()->all(), 'name_oblast', 'name_oblast'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear'=>true],
                ],
               'filterInputOptions' => ['placeholder' => 'Область'],
               'format' => 'raw',
            ],

            [
                'attribute' => 'name_sity',
                'label' => 'Город', 
                'filterType' => GridView::FILTER_SELECT2,
                //'filter' => ArrayHelper::map(BgCity::find()->orderBy('name_sity')->asArray()->all(), 'name_sity', 'name_sity'),
                'filterWidgetOptions' => [
                    'pluginOptions' => [
                        'allowClear'=>true,
                        'minimumInputLength' => 3,
                                    'language' => [
                                        'errorLoading' => new JsExpression("function () {return 'Ожидание...'}"),
                                        'inputTooShort' => new JsExpression("function () {return 'Введите больше 3 символов'}"),
                                        'noResults' => new JsExpression("function () {return 'Совпадений не найдено'}"),
                                    ],
                                    'ajax' => [
                                        'url' => '/guard/bg-city/city-list',
                                        'dataType' => 'json',
                                        'data' => new JsExpression("function (params) {return {q:params.term};}"),
                                    ],
                                    'escapeMarkup' => new JsExpression("function (markup) {return markup;}"),
                                    'templateResult' => new JsExpression("function (id_city) {return id_city.text;}"),
                                    'templateSelection' => new JsExpression("function (id_city) {return id_city.text;}"),
                    ],
                ],
               'filterInputOptions' => ['placeholder' => 'Город'],
               'format' => 'raw',
            ], 
        ];
    }
    ?>


    <?= GridView::widget([
        'id' => 'pl-grid-units',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
            /*'before' => Yii::$app->user->can('createGuard') ? '<input id="dynamic-input" type="text" placeholder="Имя диллера" class="form-control" style="width:30%;display:inline">'.Html::a('<i class="glyphicon glyphicon-plus"></i> Добавить', 
                            ['create'], 
                            [
                                'data-pjax'=>0, 
                                'class' =>'btn dynamic-create',
                                'title' => Yii::t('app', 'Добавить'),
                            ]) : false,*/
            

        ],
    ]); ?>
</div>
