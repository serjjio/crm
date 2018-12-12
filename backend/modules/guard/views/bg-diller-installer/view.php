<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\guard\models\BgDillerInstaller */

$this->title = $model->id_diller_installer;
$this->params['breadcrumbs'][] = ['label' => 'Bg Diller Installers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bg-diller-installer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_diller_installer], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_diller_installer], [
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
            'id_diller_installer',
            'name_diller_installer',
        ],
    ]) ?>

</div>
