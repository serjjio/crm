<?php

use kartik\file\FileInput;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Документы';
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['client/']];
$this->params['breadcrumbs'][] = ['label' => 'Детали', 'url' => ['client/detail-view/'.$id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inst-document">
    <div class="panel panel-success">
        <div class="panel-heading" style="background-color: #3CB371; color: white">
            <h>Документы <?=$client_name?></h>
        </div>
        <div class="panel-body my-panel">

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
        			'attribute' => 'doc_file',
        			'options' => [
        				'multiple' => true,
        			],
        			'language' => 'ru',
        			'pluginOptions' => [
                        'dropZoneEnabled' => true,
                        'browseClass' => 'btn btn-success',
        				'uploadUrl' => Url::to(['client/doc-upload']),
        				'uploadExtraData' => [
        					'idClient' => $id,
        				],
                        'previewZoomSettings' => [
                            'image' => ['width' => 'auto', 'height'=> '100%'],
                            //'text' => ['width' => '100%', 'min-height'=> '480px'],
                            'flash' => ['width' => 'auto', 'height'=> '480px'],
                            'object' => ['width' => 'auto', 'height'=> '480px'],
                            'pdf' => ['width' => '100%', 'height'=>'100%', 'min-height'=> '480px'],
                            'other' => ['width' => 'auto',  'max-height'=> '90%'],
                        ],
        				'showPreview' => true,
        				'initialPreview' => $initialPreview,
        				'initialPreviewAsData' => true,
        				'uploadAsync' => true,
        				'overwriteInitial' => false,
        				'initialPreviewConfig' => $initialPreviewConfig,
        				'browseLabel' => 'Выберите файлы',
                       'otherActionButtons' => $download,
                        'previewFileIconSettings' => [
                            'docx' => '<i class="fa fa-file-word-o text-primary"></i>',

                        ]
        			]
        		]);
        ?>
    	</div>
    </div>


    <?php
    $script = <<<JS
    $('.download-doc').click(function(){
        var key = $(this).attr('data-key');
        var url = "/client/download-doc/"
        $('body').append('<a href="'+url+ key+'" style="display:none" id="clickk"></a>');
        document.getElementById('clickk').click();
        $('#clickk').remove();
    });

JS;


    $this->registerJs($script);
    ?>

</div>

