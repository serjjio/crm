<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\guard\models\BgPackage */

$this->title = $model->id_package;
$this->params['breadcrumbs'][] = ['label' => 'Bg Packages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bg-package-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_package], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_package], [
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
            'id_package',
            'name_package',
        ],
    ]) ?>

</div>
