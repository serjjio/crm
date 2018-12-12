<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\guard\models\BgUnit */

$this->title = $model->id_unit;
$this->params['breadcrumbs'][] = ['label' => 'Bg Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bg-unit-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_unit], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_unit], [
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
            'id_unit',
            'unit_number',
            'id_type_unit',
            'sim_number',
            'test_date',
            'id_city',
            'id_diller_installer',
            'installer',
            'contact_installer',
            'test_status',
            'can_module',
            'shock_sensor',
            'volume_sensor',
            'rfid_tags',
            'vin_number',
            'id_tester_operator',
            'activate_date',
            'activate_status',
            'id_activate_operator',
            'garant_term',
            'id_marka',
            'name_model',
            'gos_number',
            'color',
            'id_model',
            'made_auto_date',
            'passport_number',
            'name_owner',
            'comment',
        ],
    ]) ?>

</div>
