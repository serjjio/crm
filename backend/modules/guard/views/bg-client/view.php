<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\guard\models\BgClient */

$this->title = $model->id_client;
$this->params['breadcrumbs'][] = ['label' => 'Bg Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bg-client-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_client], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_client], [
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
            'id_client',
            'client_name',
            'id_diller_reteiler',
            'name_manager',
            'id_package',
            'contract_number',
            'contract_date',
            'contact1',
            'contact2',
            'email:email',
            'comment:ntext',
        ],
    ]) ?>

</div>
