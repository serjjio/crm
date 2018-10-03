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
		$mainAdmin = $auth->createRole('mainAdmin');
		$mainAdmin->description = 'Главный администратор';
		//$editor = $auth->createRole('editor');

		//Write roles to DB
		$auth->add($mainAdmin);
		//$auth->add($editor);

		//Create permissions.
		//$viewAdminPage = $auth->createPermission('viewAdminPage ');
		//$viewAdminPage->description = 'Доступ в админку';


		$createObject = $auth->createPermission('createObject');
		$createObject->description = 'Может создавать объекты';

		$createClient = $auth->createPermission('createClient');
		$createClient->description = 'Может создавать клиентов';

		$admin = $auth->createPermission('admin');
		$admin->description = 'Права администратора';

		//Write permission to DB
		//$auth->add($viewAdminPage);
		$auth->add($createObject);
		$auth->add($createClient);
		$auth->add($admin);

		//Create inheritance
		//$auth->addChild($editor,$editObject);

		//$auth->addChild($admin,$editor);
		$auth->addChild($admin,$createObject);
		$auth->addChild($admin,$createClient);

		$auth->addChild($mainAdmin,$admin);

		//Assign roles
		$auth->assign($admin,1);
		//$auth->assign($editor,2);
	}
}



