<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;
use kartik\editable\Editable;
use app\models\Type;
use app\models\Unit;
use app\models\Segment;
use app\models\Server;
use yii\bootstrap\Modal;

$this->title = 'Детали';
$this->params['breadcrumbs'][] = ['label' => 'Клиенты мониторинг', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
/*echo Html::submitButton('Hello', ['class' => 'btn btn-primary my-button']);*/
?>

<?php

foreach($serviceContract as $service){
    $id_serv = $service['id_service_contract'];
    $name_serv = $service['name_service_contract'];
    $date_serv = $service['date_service_contract'];
    $contract .= <<<HTML
            <a href="/service-contract/$id_serv" class="service-view"><h style='background-color:#2eb82e;color:#fff'>$name_serv</h> ($date_serv)</a>&nbsp&nbsp


HTML;
}

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

		<?= $model->logo ? Html::img("/images/".$model->idClient.'/logo/'.$model->logo, ['class' => 'img-thumbnail', 'style' => 'border:none']) : Html::img("/images/logo/empty.jpg", ['class' => 'img-thumbnail', 'style' => 'border:none'])?>
	<div>		
 	<?php

        echo DetailView::widget([
                
                'model' => $model,
                'condensed' => true,
                'hover' => true,

                'attributes' => [
                	[
		                'columns' => [
		                    /*[
		                        'attribute' => 'clientName',
		                        'label' => 'Имя',
		                        'displayOnly' => true,
		                        'valueOtions' => ['style' => 'width:30%'],
		                        'labelColOptions' => ['style' => 'width:50%']
		                    ],*/
  
		                ],
            		],
            		[
            			'columns' => [
            				[
            					'attribute' => 'clientCountObj',
		                        'label' => 'Объектов',
		                        'format' => 'raw',
		                        'value' => Html::a($model->clientCountObj, ['unit/'.$model->idClient], ['data-pjax'=>0]),
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
                                'value' => Unit::find()->where(['idClient'=>$model->idClient, 'status' => 1])->count(),
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
                                'value' => Unit::find()->where(['idClient'=>$model->idClient, 'status' => 0])->count(),
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
                    //'action' => Url::to('delete')
                ],
            ]);




    ?>
   </div>



   <div class="pl-button-group">
   		<?= Html::a('<span class="glyphicon glyphicon-file"></span>', ['client/doc/'.$id], ['class' => 'btn btn-default btn-lg', 'title' => 'Документы'])?>
	   <!-- <button type="button" class="btn btn-default btn-lg" title="Call for details"><span class="glyphicon glyphicon-earphone"></span></button> -->
	   <button type="button" class="btn btn-default btn-lg" title="Отправить письмо"><span class="glyphicon glyphicon-envelope"></span></button>
	   
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
                		'group' => true,
                		'label' => 'Информация о клиенте',
                		'rowOptions' => ['class' => 'info']
                	],
                	[
                		'columns' => [
                			[
		                        'attribute' => 'clientName',
		                        'label' => 'Имя',
		                        //'displayOnly' => true,
		                        //'valueOptions' => ['style' => 'width:30%'],
		                    ],
		                    
                		]
                	],
                	[
                		'columns' => [
                			[
		                        'attribute' => 'structure',
		                        'label' => 'Струкура',
		                        //'displayOnly' => true,
		                        'valueColOptions' => ['style' => 'width:30%'],
		                        //'inputWidth' => '100px',
		                    ],
		                    [
                                'attribute'=> 'idSegment',
                                'label' => 'Сегмент',
                                'value' => ArrayHelper::getValue(Segment::findOne($model->idSegment), 'nameSegment'),
                                'type' => DetailView::INPUT_SELECT2,
                                'valueColOptions' => ['style' => 'width:30%'],
                                'widgetOptions'=>[
                                    'data'=>ArrayHelper::map(Segment::find()->orderBy('nameSegment')->asArray()->all(), 'idSegment', 'nameSegment'),
                                    'options'=> ['placeholder'=> 'Укажите сегмент'],
                                    'pluginOptions'=>['allowClear'=>true, 'width'=>'100%']
                                ],

                            ],
		                    
                		]
                	],
                	[
                		'columns' => [
                			[
                				'attribute'=> 'idType',
                				'label' => 'Тип',
                				'value' => ArrayHelper::getValue(Type::findOne($model->idType), 'nameType'),
                				'type' => DetailView::INPUT_SELECT2,
                				'valueColOptions' => ['style' => 'width:30%'],
                       			'widgetOptions'=>[
                            		'data'=>ArrayHelper::map(Type::find()->orderBy('nameType')->asArray()->all(), 'idType', 'nameType'),
                            		'options'=> ['placeholder'=> 'Укажите Тип'],
                            		'pluginOptions'=>['allowClear'=>true, 'width'=>'100%']
                        		],

                        	],
                        	[
		                        'attribute' => 'edrpou',
		                        'label' => 'Код ЕДРПОУ',
		                        //'displayOnly' => true,
		                        'valueColOptions' => ['style' => 'width:30%'],
		                        //'inputWidth' => '100px',
		                    ],
                        	
                        	/*[
			                    'attribute' => 'number',
			                    'label' => 'Contract',
			                     //'displayOnly' => true,
			                    'valueOtions' => ['style' => 'width:30%'],
			                    'inputWidth' => '100px',
		                    ],*/
                			
                		]
                	],
                	[
                		'columns' => [
                			[
                        		'attribute' => 'active',
                        		'label' => 'Статус',
                        		'format' => 'raw',
                        		'valueColOptions' => ['style' => 'width:30%'],
                        		'value' => $model->active ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>',
                        		'type' => DetailView::INPUT_SWITCH,
                        		'widgetOptions' => [
                            		'pluginOptions' => [
                                		'onText' => 'Active',
                                		'offText' => 'Inactive',
                            		]
                        		],
		                        //'labelColOptions' => ['style'=>'width:15%; text-align:right'],
		                        //'valueOtions' => ['style' => 'width:35%']
                        	],
                        	[
                        		'attribute' => 'imgLogo',
                        		'label' => 'Логотип',
                                'format' => 'raw',
                        		'value' => $model->logo ? $model->logo : '<span class="not-set">(не задано)</span>',
                        		'valueColOptions' => ['style' => 'width:30%'],
                        		'type' => DetailView::INPUT_FILEINPUT,
		                        'widgetOptions' => [
		                        	'pluginOptions' => [
		                        		'showPreview' => false,
	                                    'showCaption' => true,
	                                    'showRemove' => true,
	                                    'showUpload' => false,
	                                    'initialPreviewAsData' => true,
	                                    'initialPreview' => $model->logo,
		                        	],
		            
		                        ],
                        	]
                		]
                	],
                    [
                        'columns' => [
                            [
                                'attribute' => 'prManager',
                                'label' => 'Менеджер проекта',
                            ],
                            
                        ]
                    ],
                	[
                		'group' => true,
                		'label' => 'Информация о договорах',
                		'rowOptions' => ['class' => 'info']
                	],
                	[
                		'columns' => [
                			/*[
			                    'attribute' => 'number',
			                    'label' => 'Договор',
			                     //'displayOnly' => true,
			                    'valueColOptions' => ['style' => 'width:30%'],
			                    //'inputWidth' => '100px',
		                    ],*/
                            [
                                'attribute' => 'serviceContract',
                                'label' => 'Договор обслуживания',
                                'valueColOptions' => ['style' => 'width:30%'],
                            ],
		     
		                    [
		                        'attribute' => 'date_service_contract',
		                        //'displayOnly' => true,
		                        //'labelColOptions' => ['float:right'],
		                        'label' => 'Дата',
		                        'valueColOptions' => ['style' => 'width:30%'],
		                        'format' => ['date', 'php:Y-m-d'],
		                        'type' => DetailView::INPUT_DATE,
		                        'widgetOptions' => [
		                        	'pluginOptions' => ['format'=>'yyyy-mm-dd']
		                        ],
		                        //'inputWidth' => '230px'
		                        //'displayOnly' => true,
                    		],
                		]
                	],
                	[
                		'columns' => [
                			[
			                    'attribute' => 'numberContractProvider',
			                    'label' => 'Договор поставки',
			                    'valueColOptions' => ['style' => 'width:30%'],
		                    ],
                            [
                                'attribute' => 'date_provider_contract',
                                //'displayOnly' => true,
                                //'labelColOptions' => ['float:right'],
                                'label' => 'Дата',
                                'valueColOptions' => ['style' => 'width:30%'],
                                'format' => ['date', 'php:Y-m-d'],
                                'type' => DetailView::INPUT_DATE,
                                'widgetOptions' => [
                                    'pluginOptions' => ['format'=>'yyyy-mm-dd']
                                ],
                                //'inputWidth' => '230px'
                                //'displayOnly' => true,
                            ],
                            
                		]
                	],
                    /*
                    *Тестирование вывода массива договоров
                    */
                    [
                        'columns' => [
                            [
                                'attribute' => 'service_cont',
                                'label' => 'Доп. соглашения',
                                'format' => 'raw',
                                'displayOnly' => true,
                                'value' => $contract ? $contract.'<br>'.Html::a('Добавить новый договор', ['/service-contract/create/?value='.$model->idClient], ['class' => 'service-view', 'style' => 'color:green']) : Html::a('Добавить новый договор', ['/service-contract/create/?value='.$model->idClient], ['class' => 'service-view','style' => 'color:green']),
                                
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
			                    'attribute' => 'publicTel',
			                    'label' => 'Телефон 1',
			                     //'displayOnly' => true,
			                    'valueColOptions' => ['style' => 'width:30%'],
			                    'inputWidth' => '200px',
		                    ],
                            [
                                'attribute' => 'otherTel1',
                                'label' => 'Телефон 2',
                                 //'displayOnly' => true,
                                'valueColOptions' => ['style' => 'width:30%'],
                                'inputWidth' => '200px',
                            ],
		                    
                            

                		],
                	],
                	[
                		'columns' => [
                            [
                                'attribute' => 'publicEmail',
                                'label' => 'Почта 1',
                                 //'displayOnly' => true,
                                'valueColOptions' => ['style' => 'width:30%'],
                                'inputWidth' => '200px',
                            ],
                			[
                                'attribute' => 'otherEmail1',
                                'label' => 'Почта 2',
                                 //'displayOnly' => true,
                                'valueColOptions' => ['style' => 'width:30%'],
                                'inputWidth' => '200px',
                            ],
                            
		                    
                            

                		],
                	],
                    [
                        'columns' => [
                            [
                                'attribute' => 'name1',
                                'label' => 'Имя 1',
                                 //'displayOnly' => true,
                                'valueColOptions' => ['style' => 'width:30%'],
                                'inputWidth' => '200px',
                            ],
                            [
                                'attribute' => 'name2',
                                'label' => 'Имя 2',
                                 //'displayOnly' => true,
                                'valueColOptions' => ['style' => 'width:30%'],
                                'inputWidth' => '200px',
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
                    'heading'=>  $model->logo ? Html::img("/images/".$model->idClient.'/logo/'.$model->logo, ['style'=>'max-width:5%;max-height:5%']) : Html::img("/images/logo/empty.jpg", ['style'=>'max-width:5%;max-height:5%']),
                    'type'=>DetailView::TYPE_INFO,
                ],
                'buttons1' => !Yii::$app->user->can('createClient') ? '' : '{update}{delete}',
                'deleteOptions' => [
                    'url' => ['delete', 'id' => $model->idClient],
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

$beforePanel = !Yii::$app->user->can('createClient') ? '' : <<<HTML

            <a id="user-create" href="/user-info/create/$id"><u>Создать пользователя</u></a>
HTML;

?>
<?php
	$columns = [
		['class' => 'yii\grid\SerialColumn'],

        [
            'attribute' => 'login',
            'hAlign' => 'center',
            'label' => 'Логин'
        ],
        [
        	'attribute' => 'idServer',
        	'label' => 'Софт',
        	'format' => 'raw',
        	'value' => function($model, $key){
        		$server = Server::findOne($model->idServer);
        		return Html::a($server->nameSoft, $server->link, ['target' => '_blank']);
        	}
        ],
        [
            'attribute' => 'nameUser',
            'hAlign' => 'center',
            'label' => 'Имя пользователя',
        ],
        [
            'attribute' => 'email',
            'hAlign' => 'center',
            'label' => 'Email',
        ],
        [
            'attribute' => 'comment',
            'format' => 'html',
            'label' => 'Примечание',
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'contentOptions' => ['style' => 'max-width:150px; white-space:normal']

                
        ],
        [
                'class' => 'yii\grid\ActionColumn',
                'template' => Yii::$app->user->can('createClient') ? '{update} {delete}': '',
                'buttons' => [
                        'update' => function($url, $model, $key){
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#root',
                                    [
                                        'data-attribute-url' => '/user-info/update/'.$key,
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
                                        'delete-url' => '/user-info/delete/'.$key,
                                        
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


<?php
$script = <<<JS

/*$(document).ready(function(){
	if($('.kv-alert-container').is(':visible')){
		setTimeout(function(){
			$('.kv-alert-container').fadeOut('slow')
		},3000);
	}
});*/
$('.my-button').click(function(){
    $.ajax({
        url: '/service-contract/create-ajax',
        type: 'post',
        success: function(){
            $.pjax.reload({container:'#test-test'});
            return;
        }
        
    })
    //$.pjax.reload({container:'#test-test'});
    //$.pjax.reload({container:'#user-pjax-container'})
})
JS;

$this->registerJs($script);


?>