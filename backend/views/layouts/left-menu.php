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
$type = 'info';


	echo SideNav::widget([
			'type' => $type,
			'encodeLabels' => false,
			//'heading' => 'Меню',
			'items' => [
				['label' => 'Главная', 'icon' => 'home', 'url' => Url::to(['/']), 'active'=> ($item == 'index')],
				['label' => 'СИМ-карты', 'icon' => 'th', 'url' => Url::to(['sim/']), 'active'=> ($item == 'sim')],
				['label' => 'Тип оборудования', 'icon' => 'th', 'url' => Url::to(['type-unit/']), 'active'=> ($item == 'type-unit')],
				['label' => 'Програмное обеспечение', 'icon' => 'th', 'url' => Url::to(['server/']), 'active'=> ($item == 'server')],
				['label' => 'Сегмент', 'icon' => 'th', 'url' => Url::to(['segment/']), 'active'=> ($item == 'segment')],
				
				/*['label'=>'УТГ', 'icon'=>'list', 'items' => [
					['label' => 'Филиал', 'url' => Url::to(['fil/']), 'active' => ($item == 'fil')],
					['label' => 'Подразделение', 'url' => Url::to(['pod/']), 'active' => ($item == 'pod')],
				]],*/
			]

		])

?>
	</div>

</div>

</div>
