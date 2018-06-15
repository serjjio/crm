<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ServiceContract */

$this->title = 'Create Service Contract';
$this->params['breadcrumbs'][] = ['label' => 'Service Contracts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-contract-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
