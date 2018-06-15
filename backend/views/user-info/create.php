<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UserInfo */


?>
<div class="user-info-create">



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
			$(document).find('#root').modal('hide');
			//$.pjax.reload({container:'#test-test'});
			$.pjax.reload({container:'#user-pjax-container'})
		}else if(result == 2){
			$(\$form).trigger("reset");
			$("#message").html(result.message);
		}
	}).fail(function(){
		console.log("server error");
	});
	return false;
})

JS;


$this->registerJs($script)
?>
