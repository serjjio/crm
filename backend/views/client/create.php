<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Client */

$this->title = 'Создание клиента';
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-create">


    <?= $this->render('_form', [
        'model' => $model,
        'modelContract' => $modelContract
    ]) ?>

</div>
