<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Sim */


?>
<div class="sim-create">



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
			if ($(document).find('#alert-message').addClass('alert alert-success').css('display', 'block').html('Сим-карта создана! Можете добавить еще Сим-карту, либо закройте окно!')){
				$('#sim-sim').click(function(){
					$('#alert-message').css('display', 'none').removeClass('alert alert-success');
					$('#sim-sim').val('');
					$('#sim-icc').val('');

				})
			}

			$.pjax.reload({container:'#model-pjax-container'})
		}else if(result == 2){
			$(\$form).trigger("reset");
			$("#message").html(result.message);
		}else if(result == 3){
			if ($(document).find('#alert-message').addClass('alert alert-danger').css('display', 'block').html('Сим-карта с таким номером уже существует! Проверьте правильность написания!')){
				$('#sim-sim').click(function(){
					$('#alert-message').css('display', 'none').removeClass('alert alert-danger');
					$('#sim-sim').val('');
					$('#sim-icc').val('');
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
