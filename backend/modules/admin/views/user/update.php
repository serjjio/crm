<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\admin\models\User */


$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-update">



    <?= $this->render('up_form', [
        'model' => $model,
        'permissions_list' => $permissions_list,
        'permission_user' => $permission_user,
    ]) ?>

</div>
