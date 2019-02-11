<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\guard\models\BgUnit */

/*$this->title = 'Update Bg Unit: ' . $model->id_unit;
$this->params['breadcrumbs'][] = ['label' => 'Bg Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_unit, 'url' => ['view', 'id' => $model->id_unit]];
$this->params['breadcrumbs'][] = 'Update';*/
?>
<div class="bg-unit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'id' => $id,
        'initialPreview' => $initialPreview,
        'initialPreviewConfig' => $initialPreviewConfig
    ]) ?>

</div>
