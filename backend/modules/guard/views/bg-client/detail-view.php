<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;
use kartik\editable\Editable;
use yii\bootstrap\Modal;
use backend\modules\guard\models\BgUnit;

$this->title = 'Детали';
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php

    Modal::begin([
                'options' => ['tabindex' => false],
                'id' => 'root',
                //'size' => 'modal-sm',
                'options' => ['tabindex' => false]

            ]);
        //echo "<div id='alert-message' style='display:none'></div>";
        echo "<div id='modalContent'></div>";
        Modal::end();

?>

<div class="row">
	<div class="col-sm-2 my-table">

		<?= Html::img("/images/logo/user.png", ['class' => 'img-thumbnail', 'style' => 'border:none'])?>

		<div>
		 	<?php

		        echo DetailView::widget([
		                'model' => $model,
		                'condensed' => true,
		                'hover' => true,
		                'attributes' => [
		            		[
		            			'columns' => [
		            				[
		            					'attribute' => 'count_obj',
				                        'label' => 'Объектов',
				                        'format' => 'raw',
				                        'value' => Html::a($model->count_obj, ['/guard/bg-unit/'.$model->id_client], ['data-pjax'=>0]),
				                        'displayOnly' => true,
				                        'valueOtions' => ['style' => 'width:30%'],
				                        'labelColOptions' => ['style' => 'width:70%']
		            				]
		            			]
		            		],
		                    [
		                        'columns' => [
		                            [
		                                'attribute' => 'active_obj',
		                                'label' => 'Активных',
		                                'format' => 'raw',
		                                'value' => BgUnit::find()->where(['id_client'=>$model->id_client, 'status' => 1])->count(),
		                                'displayOnly' => true,
		                                'valueOtions' => ['style' => 'width:30%'],
		                                'labelColOptions' => ['style' => 'width:70%']
		                            ]
		                        ]
		                    ],
		                    [
		                        'columns' => [
		                            [
		                                'attribute' => 'inactive_obj',
		                                'label' => 'Неактивных',
		                                'format' => 'raw',
		                                'value' => BgUnit::find()->where(['id_client'=>$model->id_client, 'status' => 0])->count(),
		                                'displayOnly' => true,
		                                'valueOtions' => ['style' => 'width:30%'],
		                                'labelColOptions' => ['style' => 'width:70%']
		                            ]
		                        ]
		                    ],
		                ],
		                'responsive' => false,
		                'mode' => 'view',
		                'enableEditMode' => 'true',
		                'formOptions' => [
		                    'options' => ['data-pjax' => 0],
		                    'enableClientValidation' => true
		                ],
		            ]);




		    ?>
		</div>
	</div>
</div>
