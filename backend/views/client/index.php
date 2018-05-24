<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;
use kartik\export\ExportMenu;
use app\models\Type;
use app\models\Segment;


/* @var $this yii\web\View */
/* @var $searchModel app\models\InstSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Клиенты';
$this->params['breadcrumbs'][] = $this->title;



?>



<div class="client-index">


   

    <?php

        Modal::begin([
                'options' => ['tabindex' => false],
                'id' => 'root',

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
        }elseif(Yii::$app->session->hasFlash('kv-detail-error')){
            Alert::begin([
                'options' => ['class'=>'alert-warning']
            ]);
                echo Yii::$app->session->getFlash('kv-detail-error');
            Alert::end();
        }
    ?>


    <?php

        
        $columns = [
            //['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'idClient',
                'label' => 'id',
                'format' => 'raw'
            ],
            [
                'vAlign' => 'middle',
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear'=>true],
                ],
                'attribute' => 'clientName',
                'label' => 'Имя клиента',
                'format' => 'raw',
                'value' => function($model, $key, $index){
                    return Html::a($model->clientName, [Url::to('client/detail-view/'.$key)], ['data-pjax' => 0]);
                },
                'contentOptions' => ['style' => 'max-width:300px; white-space:normal']
            ],
            [
                'attribute' => 'idSegment',
                'value' => 'idSegment0.nameSegment',
                'label' => 'Сегмент',
                'width' => '120px',
                'filterType' => GridView::FILTER_SELECT2,
               'filter' => ArrayHelper::map(Segment::find()->orderBy('nameSegment')->asArray()->all(), 'idSegment', 'nameSegment'),
               'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear'=>true]
               ],
               'format' => 'raw',
               'filterInputOptions' => ['placeholder' => 'Сегмент'],
            ],
            [
                'attribute' => 'edrpou',
                'label' => 'ЕРДПОУ'
            ],
            [
                'attribute' => 'idConract',
                'value' => 'idConract0.serviceContract',
                'label' => 'Договор обслуживания',
                'format' => 'raw'
            ],
            /*[
                'attribute' =>'structure',
                'label' => 'Структура'
            ],*/
            [
                'attribute' =>'prManager',
                'label' => 'Менеджер проекта',
                'contentOptions' => ['style' => 'max-width:150px; white-space:normal']
            ],
            /*[
                'attribute' => 'idType',
                'value' => 'idType0.nameType',
                'label' => 'Тип',
                'filterType' => GridView::FILTER_SELECT2,
               'filter' => ArrayHelper::map(Type::find()->orderBy('nameType')->asArray()->all(), 'idType', 'nameType'),
               'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear'=>true,]
               ],
               'format' => 'raw',
               'filterInputOptions' => ['placeholder' => 'Тип клиента'],
            ],*/
            
            /*[
                'attribute' => 'idConract',
                'value' => 'idConract0.number',
                'label' => 'Договор',
                'format' => 'raw'

            ],*/
            
            
            /*[
                'attribute' => 'publicTel',
                'label' => 'Телефон'
            ],*/
            [
                'class' => 'kartik\grid\BooleanColumn',
                'attribute' => 'active',
                'vAlign' => 'middle',
                'label' => 'Статус',
                'width' => '100px',
                'trueLabel' => 'Активный',
                'falseLabel' => 'Неактивный',
                'width' => '20px',
            ],
            [
                'attribute' => 'clientCountObj',
                'label' => 'Объектов',
                'format' => 'raw',
                'width' => '20px',
                'hAlign' => 'center',
                'value' => function($model, $key){
                    return Html::a($model->clientCountObj, [Url::to('unit/'.$key)], ['data-pjax'=>0]);
                },
                
            ],
            
            /*[
                'class' => 'yii\grid\ActionColumn',
            ]*/
            
            
            

           
            
            
            
            
           
        ]
    ?>







    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        
        'tableOptions' => ['class' => 'mytable kv-grid-table table table-hover table-bordered table-condensed' ],
        'columns' => $columns,
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'pjax'=>true, // pjax is set to always true for this demo
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
        'responsive' => true,
        'striped' => true,
        'responsiveWrap' => true,
        'hover' => true,
        'persistResize' => false,
        'rowOptions' => function($model){
            return $model->active ? ['style' => 'word-wrap:break-word'] : ['style' => 'word-wrap:break-word', 'class' => GridView::TYPE_DANGER];
        },
        'export' => false,
        'toggleDataOptions' => [
            'type'=>30,
        ],
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            //'type' => 'success',
            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], ['data-pjax'=>0, 'class'=> (Yii::$app->user->identity->username=="sale") ? "btn btn-default disabled" : "btn btn-default", 'title' => Yii::t('app', 'Добавить клиента')]),
            
        ],
        

        
    ]); ?>
</div>


