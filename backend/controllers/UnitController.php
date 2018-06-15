<?php

namespace backend\controllers;

use Yii;
use app\models\Unit;
use app\models\UnitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use app\models\Sim;
use yii\db\Query;
use app\models\Client;

/**
 * UnitController implements the CRUD actions for Unit model.
 */
class UnitController extends Controller
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
     * Lists all Unit models.
     * @return mixed
     */
    public function actionIndex()
    {
        Yii::$app->language = ('ru-RU');
        $searchModel = new UnitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id=false);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Unit model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        /*return $this->render('view', [
            'model' => $this->findModel($id),
        ]);*/
        Yii::$app->language = ('ru-RU');
        $searchModel = new UnitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Unit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->identity->username == 'sale'){
            throw new ForbiddenHttpException('Доступ закрыт');
        }
        $model = new Unit();

        if ($model->load(Yii::$app->request->post())) {
            $model->idIcc = $model->idSim;
            if(!empty($model->dateInstaller)){
                $date = strtotime($model->dateInstaller);
                $model->dateInstaller = date('Y-m-d', $date);
            }
            
            if($model->idClient != ""){
                $client = Client::findOne($model->idClient);
                $client->clientCountObj++;
                $client->save();
            }
            if(!$model->save()){
                var_dump($model->getErrors());
                exit;
            };    
            

            Yii::$app->session->setFlash('kv-detail-success', 'Объект успешно создан!');
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }
    public function actionSimList($q = null, $id = null){

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $out = ['results' => ['id' => '', 'text' => '']];
        if(!is_null($q)){
            
            $query = new Query;
            $query->select(['idSim AS id', 'sim AS text'])
                    ->from('Sim')
                    ->where(['like', 'sim', $q])
                    ->limit(50);
            $command = $query->createCommand();
            $data = $command->queryAll();
            //var_dump($id);
            //exit;
            $out['results'] = array_values($data);
            //var_dump($out);
            //exit;
            
        }
        elseif ($id > 0){
            
            $out['results'] = ['id' => $id, 'text' => Sim::find($id)->sim];
        }
       
        return $out;
    }
    public function actionGetIcc1($id){
        $ICC = Sim::find()
                        ->where(['id' => $id])
                        ->one();
        if($ICC){
            echo $ICC->icc;
        }else
            echo "";
    }

    public function actionGetIcc($id){

        $ICC = Sim::findOne($id);

        if(ICC)
            echo $ICC->icc;
        else
            echo "";
    }

    /**
     * Updates an existing Unit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->identity->username == 'sale'){
            throw new ForbiddenHttpException('Доступ закрыт');
        }
        $model = $this->findModel($id);
        $idClientCurrent = $model->idClient;
        if ($model->load(Yii::$app->request->post())) {

            $model->idIcc = $model->idSim;
            if(!empty($model->dateInstaller)){
                $date = strtotime($model->dateInstaller);
                $model->dateInstaller = date('Y-m-d', $date);
            }
            $model->save();
            if($idClientCurrent != $model->idClient){
                $countOld = Client::findOne($idClientCurrent);
                if (!is_null($idClientCurrent)){
                    $countOld->clientCountObj --;
                    $countOld->save();
                } 
                if($model->idClient != ""){
                    $countNew = Client::findOne($model->idClient);
                    $countNew->clientCountObj++;
                    $countNew->save();
                    
                }

                
            }
            return $this->redirect(Yii::$app->request->referrer);
            //return $this->redirect(['view', 'id' => $modelUnit->blok]);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionAddSim(){
        if(Yii::$app->request->post()){
            $model = new Sim;

            $sim = $_POST['sim'];
            if(isset($_POST['icc'])){
                $icc = $_POST['icc'];
                $model->icc = $icc;
            }

            $model->sim = $sim;
            
            if($model->save()){
                echo 1;
            }else{
                echo 0;
            }
        }
    }

    /**
     * Deletes an existing Unit model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $unit = $this->findModel($id);
        if(!is_null($unit->idClient)){
            $client = Client::findOne($unit->idClient);
            $client->clientCountObj--;
            $client->save();
        }
        $unit->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the Unit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Unit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Unit::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
