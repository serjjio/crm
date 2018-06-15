<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Installer */

?>
<div class="type-unit-create">


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
			if ($(document).find('#alert-message').addClass('alert alert-success').css('display', 'block').html('Оборудование добавленно! Можете добавить еще, либо закройте окно!')){
				$('#typeunit-name').click(function(){
					$('#alert-message').css('display', 'none').removeClass('alert alert-success');
					$('#typeunit-name').val('');
				})
			}

			$.pjax.reload({container:'#model-pjax-container'})
		}else if(result == 2){
			$(\$form).trigger("reset");
			$("#message").html(result.message);
		}else if(result == 3){
			if ($(document).find('#alert-message').addClass('alert alert-danger').css('display', 'block').html('Оборудование с таким названием уже существует! Проверьте правильность написания!')){
				$('#typeunit-name').click(function(){
					$('#alert-message').css('display', 'none').removeClass('alert alert-danger');
					$('#typeunit-name').val('');
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
