<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        Если вам не понятна возникшая ошибка вашего запроса. Обратитесь к администратору: <h style="color:#a94442"><?=Yii::$app->params['adminEmail']?></h>.
    </p>
    

</div>
