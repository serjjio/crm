<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\guard\models\BgDillerInstaller */

$this->title = 'Create Bg Diller Installer';
$this->params['breadcrumbs'][] = ['label' => 'Bg Diller Installers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bg-diller-installer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
