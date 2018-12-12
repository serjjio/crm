<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\guard\models\BgOperators */

$this->title = $model->id_operator;
$this->params['breadcrumbs'][] = ['label' => 'Bg Operators', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bg-operators-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_operator], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_operator], [
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
            'id_operator',
            'name_operator',
            'status_operator',
        ],
    ]) ?>

</div>
