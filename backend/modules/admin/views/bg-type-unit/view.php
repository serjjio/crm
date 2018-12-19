<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\guard\models\BgTypeUnit */

$this->title = $model->id_type_unit;
$this->params['breadcrumbs'][] = ['label' => 'Bg Type Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bg-type-unit-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_type_unit], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_type_unit], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_type_unit',
            'name_type_unit',
        ],
    ]) ?>

</div>
