<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


     <?php

        Modal::begin([
                'options' => ['tabindex' => false, 'class' => 'modal-dialog-user'],
                'id' => 'root',
                'size' => 'modal-lg',
                'header' => 'Создание пользователя',
                

            ]);
        echo "<div id='modalContent'></div>";
        Modal::end();

    ?>


<?php
    $columns = [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'username',
                'label' => 'Имя пользователя',
                'format' => 'raw',
                'value' => function($model, $key){
                    return Html::a($model->username, ['user/update/'.$key], 
                                    [
                                        'class' => 'create-object',
                                        'title' => Yii::t('app', 'Редактировать'),
                                        'data-pjax' => 0
                                    ]);
                }
   
            ],
            [
                'attribute' => 'email',
                'label' => 'Email'
            ],
            [
                'attribute' => 'full_name',
                'label' => 'ФИО'
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => 
                            function($url, $model, $key){
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['user/update/'.$key], 
                                    [
                                        'class' => 'create-object',
                                        'title' => Yii::t('app', 'Редактировать'),
                                        'data-pjax' => 0
                                    ]);
                            }
                ]
            ],
    ]            
?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        //'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
        'tableOptions' => ['class' => 'mytable kv-grid-table table table-hover table-bordered table-condensed' ],
        'columns' => $columns,
        'condensed' => true,
        //'id' => 'table-user',
        'resizableColumns'=>true,
        'persistResize' => false,
        'pjax' => true,

        'striped' => true,
        'pjaxSettings' => [
                'options' => [
                    'id' => 'pl-pjax-container'
                ],
        ],

        
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        /*'rowOptions' => function($model){
            return $model->status ? ['style' => 'word-wrap:break-word'] : ['style' => 'word-wrap:break-word', 'class' => GridView::TYPE_DANGER];
        },*/
        
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
            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Создать пользователя', 
                            ['create'], 
                            [
                                'data-pjax'=>1, 
                                'class' => 'btn create create-object',
                                'title' => Yii::t('app', 'Создать пользователя'),
                            ]),
            'after' => false,
            //'footer' => false,

        ],
    ]); ?>

 <!--    <?= Html::button(Html::a('Test', 'user/test'), ['class' => 'btn btn-default'])?> -->


