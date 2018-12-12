<?php

namespace backend\modules\guard\controllers;

use Yii;
use backend\modules\guard\models\BgOperators;
use backend\modules\guard\models\BgOperatorsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\filters\AccessControl;

/**
 * BgOperatorsController implements the CRUD actions for BgOperators model.
 */
class BgOperatorsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        Yii::$app->view->params['item'] = 'bg-tester-operator';
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['viewGuard'],
                    ],
                    [
                        'actions' => ['create', 'edit-name', 'edit-status'],
                        'allow' => true,
                        'roles' => ['createGuard'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all BgOperators models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BgOperatorsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BgOperators model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BgOperators model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BgOperators();
        $post = Yii::$app->request->post();
        if(Yii::$app->request->isAjax && isset($post)){
            $data = $_POST['data'];
            if ($data){
                $model->name_operator = $data;
                return $model->save() ? true : false;
            }
        }
        
    }
/*Update edittable in gridview*/
    public function actionEditStatus(){

        if(Yii::$app->request->post('hasEditable')){

            $id = Yii::$app->request->post('editableKey');
           
            $model = BgOperators::findOne($id);

            //$out = Json::encode(['output'=>'','message'=>'']);
            $post = [];
            $posted = current($_POST['BgOperators']);

            $post['BgOperators'] = $posted;
            
            if($model->load($post)){
                $output = $model->status_operator==1 ? 'Активный' : 'Неактивный';
                $model->save();
                //$output = 'record update';
                $out = Json::encode(['output' => $output, 'message'=>'']);
            }
            echo $out;
            return;
        }
    }

/*Update edittable Name in gridview*/
    public function actionEditName(){

        if(Yii::$app->request->post('hasEditable')){

            $id = Yii::$app->request->post('editableKey');
           
            $model = BgOperators::findOne($id);

            //$out = Json::encode(['output'=>'','message'=>'']);
            $post = [];
            $posted = current($_POST['BgOperators']);

            $post['BgOperators'] = $posted;
            
            if($model->load($post)){
                //$output = $model->status_operator==1 ? 'Активный' : 'Неактивный';
                $model->save();
                //$output = 'record update';
                //$out = Json::encode(['output' => $output, 'message'=>'']);
            }
            //echo $out;
            return '{}';
        }
    }


    /**
     * Updates an existing BgOperators model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_operator]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BgOperators model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BgOperators model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BgOperators the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BgOperators::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
