<?php

namespace backend\controllers;

use Yii;
use app\models\ServiceContract;
use app\models\ServiceContractSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
     * Deletes an existing ServiceContract model.
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
