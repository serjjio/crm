<?php

namespace backend\modules\guard\controllers;

use Yii;
use backend\modules\guard\models\BgCity;
use backend\modules\guard\models\BgCitySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\filters\AccessControl;

/**
 * BgCityController implements the CRUD actions for BgCity model.
 */
class BgCityController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        Yii::$app->view->params['item'] = 'bg-city';
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
                        'actions' => ['create', 'city-list', 'edit-name', 'cities-list'],
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
     * Lists all BgCity models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BgCitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BgCity model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /*Ajax request for to search Cities*/
    public function actionCityList($q = null, $id = null){

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $out = ['results' => ['id' => '', 'text' => '']];
        if(!is_null($q)){
            
            $query = new Query;
            $query->select(['name_sity AS id', 'name_sity AS text'])
                    ->from('bg_city')
                    ->where(['like', 'name_sity', $q])
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
            $out['results'] = ['id' => $id, 'text' => BgCity::find($id_city)->name_sity];
        }
       
        return $out;
    }
    /*Ajax request for to search Cities*/
    public function actionCitiesList($q = null, $id = null){

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $out = ['results' => ['id' => '', 'text' => '']];
        if(!is_null($q)){
            
            $query = new Query;
            $query->select(['id_city  AS id', 'name_sity AS text', 'name_oblast AS obl'])
                    ->from('bg_city')
                    ->where(['like', 'name_sity', $q])
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
            $cities = BgCity::find($id_city);
            $city = $cities->name_sity;
            $obl = $cities->name_oblast;
            $out['results'] = ['id' => $id, 'text' => $city];
        }
       
        return $out;
    }

    /**
     * Creates a new BgCity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BgCity();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_city]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /*Update edittable Name in gridview*/
    public function actionEditName(){

        if(Yii::$app->request->post('hasEditable')){

            $id = Yii::$app->request->post('editableKey');
           
            $model = BgCity::findOne($id);

            //$out = Json::encode(['output'=>'','message'=>'']);
            $post = [];
            $posted = current($_POST['BgCity']);

            $post['BgCity'] = $posted;
            
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
     * Updates an existing BgCity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_city]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BgCity model.
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
     * Finds the BgCity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BgCity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BgCity::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
