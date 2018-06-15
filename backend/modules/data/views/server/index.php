<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ServerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="server-index">

<?php

    Modal::begin([
                'options' => ['tabindex' => false],
                'id' => 'root',
                'size' => 'modal-lg',
                'options' => ['tabindex' => false]

            ]);
        echo "<div id='alert-message' style='display:none'></div>";
        echo "<div id='modalContent'></div>";
        Modal::end();


?>

<?php

    $columns = [
            ['class' => 'yii\grid\SerialColumn'],

            //'Id',
            [
                'attribute' => 'server',
                'hAlign' => 'center',
                'label' => 'Имя сервера'
            ],
            [
                'attribute' => 'location',
                'hAlign' => 'center',
                'label' => 'Местонахождение'
            ],
            [
                'attribute' => 'nameSoft',
                'hAlign' => 'center',
                'label' => 'Имя софта',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a($model->nameSoft, Url::to($model->link), ['target' => '_blank']);
                }

            ],
            [
                'attribute' => 'version',
                'hAlign' => 'center',
                'label' => 'Версия',
                
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
                'template' => '{update}',
                'buttons' => [
                        'update' => function($url, $model, $key){
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#root',
                                    [
                                        'data-attribute-url' => '/data/server/update/'.$key,
                                        'data-target'=>'#root',
                                        'class' => 'modalLink',
                                        'title' => Yii::t('app', 'Редактировать'),
                                        'data-pjax' => 0
                                    ]);
                        }
                ]
            ],
        ]

?>

<?php

$beforePanel = <<<HTML

            <button class="btn btn-create" data-attribute-url="/data/server/create"><i class="glyphicon glyphicon-plus"></i> Добавить ПО</button>
HTML;

?>


<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'model-pjax-container']],
        'striped' => true,
        'hover' => true,
        'beforeFooter' => 'My fancy content',
        'toolbar' => [
            '{toggleData}'
        ],
        'panel' => [
            'type' => 'default',
            'heading' => 'Програмное обеспечение',
            'before' => $beforePanel,
        ]
    ]); ?>


</div>
