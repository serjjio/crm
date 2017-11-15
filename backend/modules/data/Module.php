<?php

namespace backend\modules\data;


use Yii;

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
        Yii::$app->view->params['status'] = 'data';
        $this->setLayoutPath('@app/views/layouts');
        $this->layout = 'main-reference';
        \Yii::$app->language = 'ru-RU';
        parent::init();

        // custom initialization code goes here
    }
}
