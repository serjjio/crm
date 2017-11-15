<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Segment */

?>
<div class="segment-update">

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
			$(document).find('#root').modal('hide');

			$.pjax.reload({container:'#model-pjax-container'});
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