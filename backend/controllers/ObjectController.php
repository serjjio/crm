<?php

namespace backend\controllers;

use Yii;
use app\models\Object;
use app\models\ObjectSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use app\models\Client;
use yii\data\ActiveDataProvider;

/**
 * ObjectController implements the CRUD actions for Object model.
 */
class ObjectController extends Controller
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
     * Lists all Object models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ObjectSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id=false);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Object model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $searchModel = new ObjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id);
        /*$dataProvider = new ActiveDataProvider([
                'query' => Object::find()
                                    ->where(['idClient' => $id]),
                'pagination' => ['pageSize' => 20]
            ]);*/
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id' => $id,
        ]);
    }

    /**
     * Creates a new Object model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new Object();

        if ($model->load(Yii::$app->request->post())) {
            $count = Client::findOne($model->idClient);
            
            $count->clientCountObj ++;
            $count->save();
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Object model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $idClientCurrent = $model->idClient;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($idClientCurrent != $model->idClient){
                $countOld = Client::findOne($idClientCurrent);
                $countOld->clientCountObj --;
                $countOld->save();
                $countNew = Client::findOne($model->idClient);
                $countNew->clientCountObj ++;
                $countNew->save();
            }
            return $this->redirect(['view', 'id' => $idClientCurrent]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Object model.
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
     * Finds the Object model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Object the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Object::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
