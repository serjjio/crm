<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
/*
initialization - yii rbac/init
*/
class RbacController extends Controller {

	public function actionInit(){
		$auth = Yii::$app->authManager;

		//$auth->removeAll();

		//Create roles
		//$mainAdmin = $auth->createRole('mainAdmin');
		//$mainAdmin->description = 'Главный администратор';
		//$editor = $auth->createRole('editor');

		//Write roles to DB
		//$auth->add($mainAdmin);
		//$auth->add($editor);

		//Create permissions.
		//$viewAdminPage = $auth->createPermission('viewAdminPage ');
		//$viewAdminPage->description = 'Доступ в админку';


		//$createObject = $auth->createPermission('createObject');
		//$createObject->description = 'Может создавать объекты';
		$createGuard = $auth->createPermission('createGuard');
		$createGuard->description = 'Может создавать охрану';

		$viewGuard = $auth->createPermission('viewGuard');
		$viewGuard->description = 'Может просматривать охрану';

		//$createClient = $auth->createPermission('createClient');
		//$createClient->description = 'Может создавать клиентов';

		//$admin = $auth->createPermission('admin');
		//$admin->description = 'Права администратора';

		//Write permission to DB
		//$auth->add($viewAdminPage);
		//$auth->add($createObject);
		//$auth->add($createClient);
		//$auth->add($admin);
		$auth->add($createGuard);
		$auth->add($viewGuard);

		//Create inheritance
		//$auth->addChild($editor,$editObject);

		//$auth->addChild($admin,$editor);
		//$auth->addChild($admin,$createObject);
		//$auth->addChild($admin,$createClient);

		$permit = $auth->getPermission('admin');

		$auth->addChild($permit,$createGuard);
		$auth->addChild($permit,$viewGuard);
		$auth->addChild($createGuard,$viewGuard);

		//$auth->addChild($mainAdmin,$admin);

		//Assign roles
		//$auth->assign($admin,1);
		//$auth->assign($editor,2);
	}
}



