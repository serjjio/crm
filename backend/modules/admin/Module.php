<?php

namespace backend\modules\admin;

use Yii;
use yii\web\ForbiddenHttpException;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\admin\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        if (Yii::$app->user->identity->username == 'sale'){
            throw new ForbiddenHttpException('Доступ закрыт');
        }
        //Yii::$app->view->params['status'] = 'data';
        $this->setLayoutPath('@app/views/admin/layouts');
        $this->layout = 'main';
        \Yii::$app->language = 'ru-RU';
        parent::init();

        // custom initialization code goes here
    }
}
