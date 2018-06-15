<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ServiceContractSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Service Contracts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-contract-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Service Contract', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_service_contract',
            'name_service_contract',
            'date_service_contract',
            'idClient',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
