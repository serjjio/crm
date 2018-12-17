<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\guard\models\BgDillerInstaller */

$this->title = 'Update Bg Diller Installer: ' . $model->id_diller_installer;
$this->params['breadcrumbs'][] = ['label' => 'Bg Diller Installers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_diller_installer, 'url' => ['view', 'id' => $model->id_diller_installer]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bg-diller-installer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
