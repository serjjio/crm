<?php

namespace backend\modules\guard;
use Yii;
use yii\web\ForbiddenHttpException;

/**
 * guard module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\guard\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
         if(Yii::$app->user->isGuest){
            return Yii::$app->response->redirect(['site/login']);

            //Yii::$app->getResponse()->redirect('site/login');
        }
        if (!Yii::$app->user->can('viewGuard')){
            throw new ForbiddenHttpException('Access denied');
        }
        //Yii::$app->view->params['status'] = 'data';
        Yii::$app->view->params['status'] = 'guard';
        //$this->setLayoutPath('@app/views/layouts');
        //$this->layout = 'main-reference';
        \Yii::$app->language = 'ru-RU';
        parent::init();

        // custom initialization code goes here
    }
}
