<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

?>

<header class="main-header">
	<?php
    NavBar::begin([
        'brandLabel' => Html::img("/images/logo/logo.png"),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-default navbar-fixed-top',
        ],
    ]);
    
    if (Yii::$app->user->isGuest) {
        $menuItems = [

        ];
        $menuLogin[] = ['label' => 'Войти', 'url' => ['/site/login']];
    } else {

        $menuItems = [
            //['label' => 'Главная', 'url' => ['/site/index']],
            ['label' => 'Клиенты', 'url' => ['/client/index'], 'active'=> ($status == 'client')],
            ['label' => 'Объекты', 'url' => ['/unit/index']],
            ['label' => 'Данные', 'url' => ['/data/default/index'], 'active'=> ($status == 'data')],
            
        ];

        $menuLogin[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Выйти (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left' ],
        'items' => $menuItems,
    ]);
   

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuLogin,
    ]);
    NavBar::end();
    ?>
</header>