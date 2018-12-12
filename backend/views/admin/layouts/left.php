<?php
use yii\helpers\Url;
?>

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?=Yii::$app->user->identity->username?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form> -->
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Меню', 'options' => ['class' => 'header']],
                    ['label' => 'Главная', 'icon' => 'home', 'url' => Url::to(['/'])],
                    ['label' => 'Пользователи', 'icon' => 'user', 'url' => Url::to(['user/']), 'active' => ($item == 'user')],
                    //['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Данные',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Сим-карты', 'icon' => 'dashboard', 'url' => ['sim/'], 'active' => ($item == 'sim')],
                            ['label' => 'Тип оборудования', 'icon' => 'dashboard', 'url' => ['type-unit/'], 'active' => ($item == 'type-unit')],
                            ['label' => 'Програмное обеспечение', 'icon' => 'dashboard', 'url' => ['server/'], 'active' => ($item == 'server')],
                            ['label' => 'Сегмент', 'icon' => 'dashboard', 'url' => ['segment/'], 'active' => ($item == 'segment')],
                            
                        ],
                    ],
                    ['label' => 'Журнал', 'icon' => 'user', 'url' => '#', 'active' => ($item == 'jornual')],
                ],
            ]
        ) ?>

    </section>

</aside>
