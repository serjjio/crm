<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Menu;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\widgets\Pjax;
use kartik\sidenav\SideNav;
use yii\helpers\Url;
?>


<div class="col-md-3">
<div id="navigation" class="list-group">
	
	<a class="list-group-item active" href="#navigation-10612" data-toggle="collapse" data-parent="navigation">Меню <b class="caret"></b></a>
	<div id="navigation-10612" class="submenu panel-collapse collapse in">

<?php
	if (!Yii::$app->user->can('viewGuard')){
		$items = [
					['label'=>'Мониторинг', 'icon'=>'list', 'items' => [
						['label' => 'Клиенты', 'icon' => 'th', 'url' => Url::to(['/client/']), 'active'=> ($item == 'client')],
						['label' => 'Объекты', 'icon' => 'th', 'url' => Url::to(['/unit/']), 'active'=> ($item == 'unit')],
					]],
					
				];
	}else{
		$items = [
					['label'=>'Мониторинг', 'icon'=>'list', 'items' => [
						['label' => 'Клиенты', 'icon' => 'th', 'url' => Url::to(['/client/']), 'active'=> ($item == 'client')],
						['label' => 'Объекты', 'icon' => 'th', 'url' => Url::to(['/unit/']), 'active'=> ($item == 'unit')],
					]],
					['label'=>'Охрана', 'icon'=>'list', 'items' => [
						//['label' => 'Главная', 'icon' => 'home', 'url' => Url::to(['/']), 'active'=> ($item == 'index')],
						['label' => 'Клиенты', 'icon' => 'th', 'url' => Url::to(['/guard/bg-client/']), 'active'=> ($item == 'bg-client')],
						['label' => 'Объекты', 'icon' => 'th', 'url' => Url::to(['/guard/bg-unit/']), 'active'=> ($item == 'bg-unit')],
						//['label' => 'Програмное обеспечение', 'icon' => 'th', 'url' => Url::to(['server/']), 'active'=> ($item == 'server')],
						//['label' => 'Сегмент', 'icon' => 'th', 'url' => Url::to(['segment/']), 'active'=> ($item == 'segment')],
					]],
					
					['label'=>'Справочник', 'icon'=>'list', 'items' => [
						['label' => 'Тип устройства', 'url' => Url::to(['/guard/bg-type-unit/']), 'active' => ($item == 'bg-type-unit')],
						['label' => 'Диллер', 'url' => Url::to(['/guard/bg-diller-installer/']), 'active' => ($item == 'bg-diller')],
						['label' => 'Операторы', 'url' => Url::to(['/guard/bg-operators/']), 'active' => ($item == 'bg-tester-operator')],
						['label' => 'Страховые', 'url' => Url::to(['/guard/bg-insurance/']), 'active' => ($item == 'bg-insurance')],
						['label' => 'Тарифный план', 'url' => Url::to(['/guard/bg-package/']), 'active' => ($item == 'bg-package')],
						['label' => 'Модель ТС', 'url' => Url::to(['/guard/bg-model/']), 'active' => ($item == 'bg-model')],
						['label' => 'Города', 'url' => Url::to(['/guard/bg-city/']), 'active' => ($item == 'bg-city')],
					]],
				];
	}
?>

<?php
$type = 'info';


	echo SideNav::widget([
			'type' => $type,
			'encodeLabels' => false,
			//'heading' => 'Меню',
			'items' => $items,

		])

?>
	</div>

</div>

</div>
