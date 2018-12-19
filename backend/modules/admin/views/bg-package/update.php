<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\guard\models\BgPackage */

$this->title = 'Update Bg Package: ' . $model->id_package;
$this->params['breadcrumbs'][] = ['label' => 'Bg Packages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_package, 'url' => ['view', 'id' => $model->id_package]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bg-package-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
