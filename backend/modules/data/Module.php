<?php

namespace backend\modules\data;


use Yii;
use yii\web\ForbiddenHttpException;

/**
 * data module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\data\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        if (Yii::$app->user->identity->username = 'sale'){
            throw new ForbiddenHttpException('Доступ закрыт');
        }
        Yii::$app->view->params['status'] = 'data';
        $this->setLayoutPath('@app/views/layouts');
        $this->layout = 'main-reference';
        \Yii::$app->language = 'ru-RU';
        parent::init();

        // custom initialization code goes here
    }
}
