<?php

namespace backend\modules\guard\controllers;

use Yii;
use backend\modules\guard\models\BgModel;
use backend\modules\guard\models\BgModelSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;

/**
 * BgModelController implements the CRUD actions for BgModel model.
 */
class BgModelController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        Yii::$app->view->params['item'] = 'bg-model';
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
                        'actions' => ['create', 'model-list', 'edit-name'],
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
     * Lists all BgModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BgModelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BgModel model.
     * @param integer $id
     * @return mixed
     */
    /*public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }*/

    /**
     * Creates a new BgModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        Yii::$app->language = 'ru-RU';
        $model = new BgModel();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('/guard/bg-model');
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /*Ajax request for to search Models*/
    public function actionModelList($q = null, $id = null){

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $out = ['results' => ['id' => '', 'text' => '']];
        if(!is_null($q)){
            
            $query = new Query;
            $query->select(['name_model AS id', 'name_model AS text'])
                    ->from('bg_model')
                    ->where(['like', 'name_model', $q])
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
            
            $out['results'] = ['id' => $id, 'text' => BgModel::find($id_model)->name_model];
        }
       
        return $out;
    }

/*Update edittable Name in gridview*/
    public function actionEditName(){

        if(Yii::$app->request->post('hasEditable')){

            $id = Yii::$app->request->post('editableKey');
           
            $model = BgModel::findOne($id);

            //$out = Json::encode(['output'=>'','message'=>'']);
            $post = [];
            $posted = current($_POST['BgModel']);

            $post['BgModel'] = $posted;
            
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
     * Updates an existing BgModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_model]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BgModel model.
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
     * Finds the BgModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BgModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BgModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
