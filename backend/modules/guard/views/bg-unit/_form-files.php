<?php

use kartik\file\FileInput;
use yii\helpers\Url;
use yii\helpers\Html;

?>

<?php

$download = <<< HTML
        
        <button class="kv-file-download btn btn-xs btn-default download-doc" {dataKey} title="Скачать документ">
            <i class="glyphicon glyphicon-floppy-save"></i>
        </button>
HTML;

?>

        <?php

        	echo FileInput::widget([
                    //'name' => 'Test',
        			'model' => $model,
        			'attribute' => 'file',
        			'options' => [
        				'multiple' => true,
        			],
        			'language' => 'ru',

        			'pluginOptions' => [
                        'showUpload' => false,
                        'dropZoneEnabled' => true,

                        //'browseClass' => 'btn btn-success',
                        'uploadUrl' => false,
                        'uploadClass' => '',
        				//'removeIcon' => false,
        				/*'uploadExtraData' => [
        					'idClient' => $id,
        				],*/
                        'previewZoomSettings' => [
                            'image' => ['width' => 'auto', 'height'=> '100%'],
                            //'text' => ['width' => '100%', 'min-height'=> '480px'],
                            'flash' => ['width' => 'auto', 'height'=> '480px'],
                            'object' => ['width' => 'auto', 'height'=> '480px'],
                            'pdf' => ['width' => '100%', 'height'=>'100%', 'min-height'=> '480px'],
                            'other' => ['width' => 'auto',  'max-height'=> '90%'],
                        ],
        				'showPreview' => true,
        				//'initialPreview' => $initialPreview,
        				'initialPreviewAsData' => true,
        				'uploadAsync' => true,
        				'overwriteInitial' => false,
        				//'initialPreviewConfig' => $initialPreviewConfig,
        				'browseLabel' => 'Выберите файлы',
                        'otherActionButtons' => $download,
                        'fileActionSettings' => [
                            'showUpload' => false,
                        ],
                        'previewFileIconSettings' => [
                            'docx' => '<i class="fa fa-file-word-o text-primary"></i>',

                        ]
        			]
        		]);
        ?>