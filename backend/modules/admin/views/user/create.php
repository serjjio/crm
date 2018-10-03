<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\admin\models\User */


$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

   

    <?= $this->render('cr_form', [
        'model' => $model,
        'permissions_list' => $permissions_list,
    ]) ?>

</div>
