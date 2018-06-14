<?php

namespace backend\controllers;

use Yii;
use app\models\ServiceContract;
use app\models\ServiceContractSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * ServiceContractController implements the CRUD actions for ServiceContract model.
 */
class ServiceContractController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ServiceContract models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServiceContractSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ServiceContract model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        Yii::$app->language = 'ru-RU';
        $post = Yii::$app->request->post();
        $model = $this->findModel($id);
        if($model->load($post)){

            Yii::$app->session->setFlash('kv-detail-success', 'Параметры договора успешно изменены');
            
            $model->save();
            //$this->refresh();
            return $this->redirect('/client/detail-view/'.$model->idClient);

        }
        return $this->renderAjax('view', [
            'model' => $model,
        ]);
    }
     /**
     * Deletes an existing ServiceContract model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete()
    {

        $post = Yii::$app->request->post();
        if (Yii::$app->request->isAjax && isset($post['pldelete'])){
            $id = $post['id'];
            if ($model = $this->findModel($id)){
                $idClient = $model->idClient;
                $model->delete();
                //Yii::$app->session->setFlash('kv-detail-success', 'Параметры договора успешно изменены');
                echo Json::encode([
                      //'deleted' => true,
                      'success' => true,
                      'messages' => ['kv-detail-success' => 'Deleted successfully'] 
                    ]);
                Yii::$app->session->setFlash('kv-detail-success', 'Договор удален');
            
            }else{
                echo Json::encode([
                      'success' => false,
                      'messages' => ['kv-detail-error' => 'Delete failed'] 
                    ]);
                Yii::$app->session->setFlash('kv-detail-error', 'Возникла ошибка, обратитесь к администратору');
            }
            return;
        }
        
        /*if ($model = $this->findModel($id)){
            Yii::$app->session->setFlash('kv-detail-success', 'Договор удален');
        };*/
        //var_dump($model->idClient);
        //return $this->redirect('/client/detail-view/'.$model->idClient);
    }

    /**
     * Creates a new ServiceContract model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        Yii::$app->language = 'ru-RU';
        $model = new ServiceContract();
        $model->idClient = $_GET['value'];

        if ($model->load(Yii::$app->request->post())) {
            $date= strtotime($model->date_service_contract);
            $model->date_service_contract = date('Y-m-d', $date);
            $model->save();
            Yii::$app->session->setFlash('kv-detail-success', 'Новый договор добавлен');
            return $this->redirect('/client/detail-view/'.$model->idClient);
        } else {
            $model->date_service_contract = date('d-M-Y');
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreateAjax(){
        $model = new ServiceContract();
        if (Yii::$app->request->isAjax && Yii::$app->request->isPost){
            $model->date_service_contract = date('d-M-Y');
            $model->idClient = 8;
            $model->name_service_contract = '556644';
            if($model->save()){
                return;
            }else{
                var_dump($model->getErrors());
            }
        }
    }

    /**
     * Updates an existing ServiceContract model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_service_contract]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

   

    /**
     * Finds the ServiceContract model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ServiceContract the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ServiceContract::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
