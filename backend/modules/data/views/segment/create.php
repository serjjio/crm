<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Segment */

?>
<div class="segment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php
$script = <<<JS

$('form#{$model->formName()}').on('beforeSubmit', function(e){
	var \$form = $(this);
	$.post(
		\$form.attr("action"),
		\$form.serialize()
	)
	.done(function(result){
		if(result == 1){
			if ($(document).find('#alert-message').addClass('alert alert-success').css('display', 'block').html('Сегмент добавлен! Можете добавить еще, либо закройте окно!')){
				$('#segment-namesegment').click(function(){
					$('#alert-message').css('display', 'none').removeClass('alert alert-success');
					$('#segment-namesegment').val('');
				})
			}

			$.pjax.reload({container:'#model-pjax-container'})
		}else if(result == 2){
			$(\$form).trigger("reset");
			$("#message").html(result.message);
		}else if(result == 3){
			if ($(document).find('#alert-message').addClass('alert alert-danger').css('display', 'block').html('Сегмент с таким названием уже существует! Проверьте правильность написания!')){
				$('#segment-namesegment').click(function(){
					$('#alert-message').css('display', 'none').removeClass('alert alert-danger');
					$('#segment-namesegment').val('');
				})
			}
		}
	}).fail(function(){
		console.log("server error");
	});
	return false;
})

JS;


$this->registerJs($script)
?>