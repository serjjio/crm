<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\guard\models\BgClientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


?>
<div class="bg-client-index">

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

    <?php
            //'id_client',
            //'client_name',
            //'id_diller_reteiler',
            //'name_manager',
            //'id_package',
            // 'contract_number',
            // 'contract_date',
            // 'contact1',
            // 'contact2',
            // 'email:email',
            // 'comment:ntext',
        $columns = [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'client_name',
                'label' => 'Имя Клиента', 
                'format' => 'raw',
                'value' => function($model, $key){
                    return Html::a($model->client_name, ['/guard/bg-client/detail-view/'.$key], 
                                    [
                                        //'class' => 'create-object',
                                        'title' => Yii::t('app', 'Редактировать'),
                                        'data-pjax' => 0
                                    ]);
                },
                'contentOptions' => ['style' => 'max-width:300px; white-space:normal']
            ],

            

            [
                'attribute' => 'count_obj',
                'label' => 'Объекты',
                'format' => 'raw',
                'width' => '20px',
                'hAlign' => 'center',
                'value' => function($model, $key){
                    return Html::a($model->count_obj, [Url::to('/guard/bg-unit/'.$key)], ['data-pjax'=>0]);
                },
                
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
                'class' => 'kartik\grid\CheckboxColumn',
                'headerOptions' => ['class' => 'kartik-sheet-style']
            ],
            /*[
                'class' => 'yii\grid\ActionColumn',
            ]*/
        ]
?>

    <?= GridView::widget([
        'id' => 'pl-grid-units',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        
        'tableOptions' => ['class' => 'mytable kv-grid-table table table-hover table-bordered table-condensed'  ],
        'columns' => $columns,
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'pjax'=>true, // pjax is set to always true for this demo
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
        'responsive' => true,
        'striped' => true,
        'condensed' => true,
        'resizableColumns'=>true,
        'responsiveWrap' => true,
        'hover' => true,
        'persistResize' => false,
        'rowOptions' => function($model){
            return $model->status ? ['style' => 'word-wrap:break-word'] : ['style' => 'background-color:#DCDCDC'];
        },
        'export' => false,
        'toggleDataOptions' => [
            'type'=>30,
        ],
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            //'type' => 'success',
            'heading' => 'Охрана',
            'before' => Yii::$app->user->can('createGuard') ? Html::a('<i class="glyphicon glyphicon-plus"></i> Добавить клиента', 
                            ['create'], 
                            [
                                'data-pjax'=>0, 
                                'class' =>'btn create',
                                'title' => Yii::t('app', 'Добавить клиета'),
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
