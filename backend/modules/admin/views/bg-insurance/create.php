<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\guard\models\BgInsurance */

$this->title = 'Create Bg Insurance';
$this->params['breadcrumbs'][] = ['label' => 'Bg Insurances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bg-insurance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
