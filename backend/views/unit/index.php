<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use app\models\Unit;
use app\models\Client;
use app\models\TypeUnit;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;
use yii\web\JsExpression;
use kartik\export\ExportMenu;


/* @var $this yii\web\View */
/* @var $searchModel app\models\InstSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Блоки';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="inst-index">

    
    <?php

        Modal::begin([
                'options' => ['tabindex' => false],
                'id' => 'unit',
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


    <?php

        $columns = [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'number',
                'label' => 'Номер блока',
                'hAlign' => 'center',
                //'width' => '150px',
                
            ],
            [
                'attribute' => 'imei',
                'label' => 'IMEI',
                'hAlign' => 'center',
            ],
            [
                'attribute' => 'idTypeUnit',
                'value' => 'idTypeUnit0.name',
                //'hAlign' => 'center',
                
                'label' => 'Тип трекера',
                'contentOptions' => ['style' => 'width:150px;; white-space:normal'],
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(TypeUnit::find()->orderBy('name')->asArray()->all(), 'idTypeUnit', 'name'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear'=>true]
                ],
                'format' => 'raw',
                'filterInputOptions' => ['placeholder' => 'Тип'],   
            ],
            [
                'attribute' => 'idClient',
                'label' => 'Клиент',
                'format' => 'raw',
                'value' => function ($model){
                    $name =  ArrayHelper::getValue(Client::findOne($model->idClient), 'clientName');
                    return Html::a($name, [Url::to('client/detail-view/'.$model->idClient)], ['data-pjax' => 0]);
                },
                'hAlign' => 'center',
                'contentOptions' => ['style' => 'max-width:300px; white-space:normal']
            ],
            [
                //'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'idSim',
                'value' => 'idSim0.sim',
                'label' => 'СИМ-карта',
                'hAlign' => 'center',
            ],
            /*[
                'attribute' => 'idIcc',
                'hAlign' => 'center',
                'label' => 'ICC',
                'value' => 'idIcc0.icc'
            ],*/
            [
                //'class' => 'yii\grid\DataColumn',
                'attribute' => 'dateInstaller',
                'format' => ['date', 'php:Y-m-d'],
                'label' => 'Дата установки',
                'width' => 'auto',
                'value' => 'dateInstaller',
                'filterType' => GridView::FILTER_DATE_RANGE,
                'filterWidgetOptions' => [
                    'model' => $model,
                    'attribute' => 'dateInstaller',
                    'presetDropdown' => true,
                    'defaultPresetValueOptions' => [
                        'style' => 'display:none',
                    ],
                    'hideInput' => true,
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'locale' => ['format' => 'Y-m-d', 'separator' => ' : ']
                    ]
                ],
            ],
            [
                'class' => 'kartik\grid\BooleanColumn',
                'attribute' => 'status',
                'vAlign' => 'middle',
                'label' => 'Статус',
                //'width' => '100px',
                'trueLabel' => 'Активный',
                'falseLabel' => 'Неактивный',
                'width' => '20px',
            ],
            
            [
                'attribute' => 'comment',
                'format' => 'html',
                'label' => 'Примечание',
                'hAlign' => 'center',
                //'width' => '50px',
                'vAlign' => 'middle',
                'contentOptions' => ['style' => 'max-width:150px; white-space:normal']

                
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => (Yii::$app->user->identity->username !== "sale") ? '{update} {delete}' : '',
                'buttons' => [
                    'update' => 
                            function($url, $model, $key){
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['unit/update/'.$key], 
                                    [
                                        'class' => 'create-unit',
                                        'title' => Yii::t('app', 'Редактировать'),
                                        'data-pjax' => 0
                                    ]);
                            }
                ]

            ]
            
            
        ]
    ?>
    
    

    <?= GridView::widget([
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
            return $model->status ? ['style' => 'word-wrap:break-word'] : ['style' => 'word-wrap:break-word', 'class' => GridView::TYPE_DANGER];
        },
        
        'layout' => $layout,

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
            'heading' => 'Блоки',
            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Добавить блок', 
                            ['create'], 
                            [
                                'data-pjax'=>1, 
                                'class' => (Yii::$app->user->identity->username == "sale") ? 'btn create create-unit disabled' : 'btn create create-unit',
                                'title' => Yii::t('app', 'Добавить блок'),
                            ])

        ],
    ]); ?>
</div>


<?php

?>






