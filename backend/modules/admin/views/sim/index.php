<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SimSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = false;

?>
<div class="sim-index">

<?php

    Modal::begin([
                'options' => ['tabindex' => false],
                'id' => 'root',
                'size' => 'modal-sm',
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
                'attribute' => 'sim',
                'hAlign' => 'center',
                'label' => 'Сим-карта'
            ],
            [
                'attribute' => 'icc',
                'hAlign' => 'center',
                'label' => 'ICC'
            ],
            [
                'class' => 'kartik\grid\BooleanColumn',
                'attribute' => 'status',
                'vAlign' => 'middle',
                'label' => 'Статус',
                'width' => '100px',
                'trueLabel' => 'Active',
                'falseLabel' => 'Inactive',
            ],
            [
                'attribute' => 'code',
                'hAlign' => 'center',
                'label' => 'ОКПО',
                'width' => 'auto',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                        'update' => function($url, $model, $key){
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#root',
                                    [
                                        'data-attribute-url' => '/data/sim/update/'.$key,
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

            <button class="btn btn-create" data-attribute-url="/data/sim/create"><i class="glyphicon glyphicon-plus"></i> Создать СИМ-карту</button>
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
            'heading' => 'СИМ-карты',
            'before' => $beforePanel,
        ]
    ]); ?>


</div>
