<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\guard\models\BgCity */

$this->title = 'Update Bg City: ' . $model->id_city;
$this->params['breadcrumbs'][] = ['label' => 'Bg Cities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_city, 'url' => ['view', 'id' => $model->id_city]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bg-city-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
