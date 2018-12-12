<?php

namespace backend\modules\guard\controllers;

use Yii;
use backend\modules\guard\models\BgClient;
use backend\modules\guard\models\BgClientSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * BgClientController implements the CRUD actions for BgClient model.
 */
class BgClientController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        Yii::$app->view->params['item'] = 'bg-client';
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index', 'update', 'detail-view'],
                        'allow' => true,
                        'roles' => ['viewGuard'],
                    ],
                    [
                        'actions' => ['create', 'delete-selected'],
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
     * Lists all BgClient models.
     * @return mixed
     */
    public function actionIndex()
    {
         
        $searchModel = new BgClientSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BgClient model.
     * @param integer $id
     * @return mixed
     */
   /* public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }*/

    /**
     * Creates a new BgClient model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        Yii::$app->language = 'ru-RU';
        $model = new BgClient();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {

            if($model->contract_date){
                $contract_date= strtotime($model->contract_date);
                $model->contract_date = date('Y-m-d', $contract_date);
            }

            if($model->count_obj < 1){
                $model->count_obj = 0;
            }
            if ($model->save()) return $this->redirect('/guard/bg-client');
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /*View end edit to clients*/

    public function actionDetailView($id){

        //$this->setLayoutPath('@app/views/layouts');
        $this->layout = 'main-view';
        Yii::$app->language = 'ru-RU';
        $post = Yii::$app->request->post();
        $model = $this->findModel($id);



        return $this->render('detail-view', [
                'model' => $model,
                //'searchModel' => $searchModel,
                //'dataProvider' => $dataProvider,
                'id' => $id,
                'serviceContract' => $serviceContract,
            ]);

    }

    /**
     * Updates an existing BgClient model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }


        if ($model->load(Yii::$app->request->post())) {  

            if($model->contract_date){
                $contract_date= strtotime($model->contract_date);
                $model->contract_date = date('Y-m-d', $contract_date);
            }
            $model->save() ? $this->redirect('/guard/bg-client') : print_r($model->getErrors());
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BgClient model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionDeleteSelected(){
        $post = Yii::$app->request->post();
        if (Yii::$app->request->isAjax && isset($post['keys'])){
            $keys = $post[keys];
            for ($i=0; $i<count($keys); $i++){
                $unit = $this->findModel($keys[$i]);
                /*if(!is_null($unit->idClient)){
                    $client = Client::findOne($unit->idClient);
                    $client->clientCountObj--;
                    $client->save();
                }*/
                $unit->delete();

            }
            return true;
        }
    }

    /**
     * Finds the BgClient model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BgClient the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BgClient::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
