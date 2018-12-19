<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\guard\models\BgCity */

$this->title = 'Create Bg City';
$this->params['breadcrumbs'][] = ['label' => 'Bg Cities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bg-city-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
