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
use backend\modules\guard\models\BgDiller;
use backend\modules\guard\models\BgPackage;

$this->title = 'Детали';
$this->params['breadcrumbs'][] = ['label' => 'Клиенты охраны', 'url' => ['index']];
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

	<div class="col-sm-10">

	<?php
    Pjax::begin(['id' => 'test-test']);
		echo DetailView::widget([
                
                'model' => $model,
                'condensed' => true,
                'hover' => true,
                'responsive' => true,
                'mode' => DetailView::MODE_VIEW,
                //'container' => ['id'=>'detail-container'],
                'attributes' => [
            
            		[
                		'columns' => [
                			[
                        		'attribute' => 'status',
                        		'label' => 'Статус',
                        		'format' => 'raw',
                        		//'valueColOptions' => ['style' => 'width:30%'],
                        		'value' => $model->status? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>',
                        		'type' => DetailView::INPUT_SWITCH,
                        		'widgetOptions' => [
                            		'pluginOptions' => [
                                		'onText' => 'Активный',
                                		'offText' => 'Неактивный',
                            		]
                        		],
		                        //'labelColOptions' => ['style'=>'width:15%; text-align:right'],
		                        //'valueOtions' => ['style' => 'width:35%']
                        	],
                		]
                	],
                	[
                		'columns' => [
                			[
		                        'attribute' => 'client_name',
		                        'label' => 'Имя клиента',
		                        //'displayOnly' => true,
		                        //'valueOptions' => ['style' => 'width:30%'],
		                    ],
		                    
                		]
                	],
                	
                	
                	[
                		'columns' => [
                			[
		                        'attribute' => 'name_manager',
		                        'label' => 'Менеджер',
		                        //'displayOnly' => true,
		                        'valueOptions' => ['style' => 'width:30%'],
		                    ],
		                    
                		]
                	],
                	[
                		'columns' => [
                			[
                                'attribute'=> 'id_diller_reteiler',
                                'label' => 'Диллер',
                                'value' => ArrayHelper::getValue(BgDiller::findOne($model->id_diller_reteiler), 'name_diller_reteiler'),
                                'type' => DetailView::INPUT_SELECT2,
                                'widgetOptions'=>[
                                    'data'=>ArrayHelper::map(BgDiller::find()->orderBy('name_diller_reteiler')->asArray()->all(), 'id_diller_reteiler', 'name_diller_reteiler'),
                                    'options'=> ['placeholder'=> 'Укажите диллера...'],
                                    'pluginOptions'=>['allowClear'=>true, 'width'=>'37%']
                                ],

                            ],
                		]
                	],
                	[
                		'columns' => [
                			[
                                'attribute'=> 'id_package',
                                'label' => 'Тарифный план',
                                'valueOptions' => ['style' => 'width:30%'],
                                'value' => ArrayHelper::getValue(BgPackage::findOne($model->id_package), 'name_package'),
                                'type' => DetailView::INPUT_SELECT2,
                                'widgetOptions'=>[
                                    'data'=>ArrayHelper::map(BgPackage::find()->orderBy('name_package')->asArray()->all(), 'id_package', 'name_package'),
                                    'options'=> ['placeholder'=> 'Укажите тп...'],
                                    'pluginOptions'=>['allowClear'=>true, 'width'=>'37%']
                                ],

                            ],
                		]
                	],
                	[
                		'columns' => [
                			[
		                        'attribute' => 'contract_number',
		                        'label' => 'Номер договора',
		                        //'displayOnly' => true,
		                        'valueOptions' => ['style' => 'width:30%'],
		                    ],
		                    [
		                        'attribute' => 'contract_date',
		                        //'displayOnly' => true,
		                        //'labelColOptions' => ['float:right'],
		                        'label' => 'Дата',
		                        'valueColOptions' => ['style' => 'width:30%'],
		                        'format' => ['date', 'php:Y-m-d'],
		                        'type' => DetailView::INPUT_DATE,
		                        'widgetOptions' => [
		                        	'pluginOptions' => ['format'=>'yyyy-m-dd']
		                        ],
		                        //'inputWidth' => '230px'
		                        //'displayOnly' => true,
                    		],
		                    
                		]
                	],
                	[
                		'group' => true,
                		'label' => 'Контактная информация',
                		'rowOptions' => ['class' => 'info']
                	],
                	[
                		'columns' => [
                			[
			                    'attribute' => 'contact1',
			                    'label' => 'Контакт 1',
			                     //'displayOnly' => true,
			                    'valueColOptions' => ['style' => 'width:30%'],
			                    //'inputWidth' => '200px',
		                    ],
                            [
                                'attribute' => 'contact2',
                                'label' => 'Контакт 2',
                                 //'displayOnly' => true,
                                'valueColOptions' => ['style' => 'width:30%'],
                                //'inputWidth' => '200px',
                            ],
		                    
                            

                		],
                	],
                	[
                		'columns' => [
                            [
                                'attribute' => 'email',
                                'label' => 'Электронная почта',
                                 //'displayOnly' => true,
                                //'valueColOptions' => ['style' => 'width:30%'],
                                //'inputWidth' => '200px',
                            ],
                		],
                	],
                	[
                		'columns' => [
                			[
                				'attribute' => 'comment',
			                    'format' => 'raw',
			                    'label' => 'Примечание',
			                    'value' => '<span class="text-justify"><em>' . $model->comment . '</em></span>',
			                    'type' => DetailView::INPUT_TEXTAREA,
			                    'options' => ['rows'=>4]
                			]
                		]
                	],
                ],

                'panel'=> [
                    'heading'=> 'Информация о клиенте',
                    'type'=>DetailView::TYPE_INFO,
                ],
                'buttons1' => !Yii::$app->user->can('createGuard') ? '' : '{update}',
                'deleteOptions' => [
                    'url' => ['delete', 'id' => $model->id_client],
                    'method' => 'post',
                ],
                'formOptions' => [
                    'options' => ['data-pjax' => 1],
                    'enableClientValidation' => true
                    //'action' => Url::to('delete')
                ],
                'container' => ['id'=>'client-container'],
        ]);
Pjax::end();
	?>

	</div>

<?php

$beforePanel = !Yii::$app->user->can('createGuard') ? '' : <<<HTML

            <a id="user-create" href="/guard/bg-client/create-login/$id"><u>Создать пользователя</u></a>
HTML;

?>

<?php
	$columns = [
		['class' => 'yii\grid\SerialColumn'],

        [
            'attribute' => 'name_login',
            'hAlign' => 'center',
            'label' => 'Логин'
        ],
        [
            'attribute' => 'name_user',
            'hAlign' => 'center',
            'label' => 'Имя пользователя',
        ],
        [
            'attribute' => 'email',
            'hAlign' => 'center',
            'label' => 'Email',
        ],
      
        [
                'class' => 'yii\grid\ActionColumn',
                'template' => Yii::$app->user->can('createGuard') ? '{update} {delete}': '',
                'buttons' => [
                        'update' => function($url, $model, $key){
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#root',
                                    [
                                        'data-attribute-url' => '/guard/bg-client/update-login/'.$key,
                                        'data-target'=>'#root',
                                        'class' => 'modalLink',
                                        'title' => Yii::t('app', 'Редактировать'),
                                        'data-pjax' => 0
                                    ]);
                        },
                        'delete' => function($url, $model, $key){
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', '#',
                                    [
                                        'title' => Yii::t('app', 'Удалить'),
                                        'class' => 'ajax-delete',
                                        'data' => [
                                        	//'confirm' => 'Вы действительно хотите удалить пользователя?',
                                        	//'method' => 'post',
                                        ],
                                        'delete-url' => '/guard/bg-client/delete-login/'.$key,
                                        
                                        'data-pjax' => 0
                                        
                                        
                                    ]);
                        }
                ]
            ],
	]
?>
    <!-- Information about users for this client -->
	<?= GridView::widget([
	        'dataProvider' => $dataProvider,
	        //'filterModel' => $searchModel,
	        'columns' => $columns,
	        'pjax' => true,
	        'pjaxSettings' => ['options' => ['id' => 'user-pjax-container']],
	        'striped' => true,
	        'hover' => true,
	        //'beforeFooter' => 'My fancy content',
	        'toolbar' => [
	            '{toggleData}'
	        ],
	        'panel' => false,
	        'panel' => [
	            'type' => 'default',
	            'heading' => 'Пользователи',
	            'before' => $beforePanel,
	        ]
	    ]); ?>

</div>
