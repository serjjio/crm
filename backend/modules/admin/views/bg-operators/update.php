<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\guard\models\BgOperators */

$this->title = 'Update Bg Operators: ' . $model->id_operator;
$this->params['breadcrumbs'][] = ['label' => 'Bg Operators', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_operator, 'url' => ['view', 'id' => $model->id_operator]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bg-operators-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
