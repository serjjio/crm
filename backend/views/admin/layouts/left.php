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
                        'label' => 'Спаравочник монитор',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Сим-карты', 'icon' => 'dashboard', 'url' => ['sim/'], 'active' => ($item == 'sim')],
                            ['label' => 'Тип оборудования', 'icon' => 'dashboard', 'url' => ['type-unit/'], 'active' => ($item == 'type-unit')],
                            ['label' => 'Програмное обеспечение', 'icon' => 'dashboard', 'url' => ['server/'], 'active' => ($item == 'server')],
                            ['label' => 'Сегмент', 'icon' => 'dashboard', 'url' => ['segment/'], 'active' => ($item == 'segment')],
                            
                        ],
                    ],
                    [
                        'label' => 'Спаравочник охрана',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Тип устройства', 'icon' => 'dashboard', 'url' => Url::to(['bg-type-unit/']), 'active' => ($item == 'bg-type-unit')],
                            ['label' => 'Диллер', 'icon' => 'dashboard', 'url' => Url::to(['bg-diller-all/']), 'active' => ($item == 'bg-diller')],
                            ['label' => 'Операторы', 'icon' => 'dashboard', 'url' => Url::to(['bg-operators/']), 'active' => ($item == 'bg-tester-operator')],
                            ['label' => 'Страховые', 'icon' => 'dashboard', 'url' => Url::to(['bg-insurance/']), 'active' => ($item == 'bg-insurance')],
                            ['label' => 'Тарифный план', 'icon' => 'dashboard', 'url' => Url::to(['bg-package/']), 'active' => ($item == 'bg-package')],
                            ['label' => 'Модель ТС', 'icon' => 'dashboard', 'url' => Url::to(['bg-model/']), 'active' => ($item == 'bg-model')],
                            ['label' => 'Города', 'icon' => 'dashboard', 'url' => Url::to(['bg-city/']), 'active' => ($item == 'bg-city')],
                            
                            
                        ],
                    ],
                    ['label' => 'Журнал', 'icon' => 'user', 'url' => '#', 'active' => ($item == 'jornual')],
                ],
            ]
        ) ?>

    </section>

</aside>
