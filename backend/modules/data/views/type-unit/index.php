<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Marka;
use app\models\Model;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MarkaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="type-unit-index">


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
            /*[
                'class' => 'yii\grid\SerialColumn',
                //'value' => 'idTypeUnit',
            ],*/

            //'idTypeUnit',
            [
                'attribute' => 'idTypeUnit',
                'label' => '#',
                //'hAlign' => 'center',
                'width' => '50px',
                
            ],
            'name',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                        'update' => function($url, $model, $key){
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#root',
                                    [
                                        'data-attribute-url' => '/data/type-unit/update/'.$key,
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

            <button class="btn btn-sm btn-create" data-attribute-url="/data/type-unit/create"><i class="glyphicon glyphicon-plus"></i> Добавить оборудование</button>
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
        //'beforeFooter' => 'My fancy content',
        'toolbar' => [
            '{toggleData}'
        ],
        'panel' => [
            'type' => 'default',
            'heading' => 'Тип оборудования',
            'before' => $beforePanel,
        ]
    ]); ?>


</div>
