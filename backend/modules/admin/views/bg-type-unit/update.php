<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\guard\models\BgTypeUnit */

$this->title = 'Update Bg Type Unit: ' . $model->id_type_unit;
$this->params['breadcrumbs'][] = ['label' => 'Bg Type Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_type_unit, 'url' => ['view', 'id' => $model->id_type_unit]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bg-type-unit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
