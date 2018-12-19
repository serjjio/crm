<?php

namespace backend\modules\admin\controllers;

use Yii;
use backend\modules\guard\models\BgDillerAll;
//use backend\modules\guard\models\BgDiller;
use backend\modules\guard\models\BgDillerAllSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\widgets\ActiveForm;
use backend\modules\guard\models\BgCity;

/**
 * BgDillerInstallerController implements the CRUD actions for BgDillerInstaller model.
 */
class BgDillerAllController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        Yii::$app->view->params['item'] = 'bg-diller';
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
                        'actions' => ['create', 'edit-name'],
                        'allow' => true,
                        'roles' => ['createGuard'],
                    ],
                    [
                        'actions' => ['delete-selected'],
                        'allow' => true,
                        'roles' => ['admin'],
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
     * Lists all BgDillerInstaller models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BgDillerAllSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BgDillerInstaller model.
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
     * Creates a new BgDillerInstaller model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BgDillerAll();
        //$diller = new BgDiller();
            
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {

            //$diller->name_diller_reteiler = $model->name_diller_installer;
            $name_city = BgCity::findOne($model->id_city)->name_sity;
            
            $model->name_city = $name_city;
            //$diller->id_city = $model->id_city;
            $model->save();
            //$diller->save();


            return $this->redirect('/admin/bg-diller-all');
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
           
            $model = BgDillerAll::findOne($id);

            //$out = Json::encode(['output'=>'','message'=>'']);
            $post = [];
            $posted = current($_POST['BgDillerAll']);

            $post['BgDillerAll'] = $posted;
            
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
     * Updates an existing BgDillerInstaller model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_diller_installer]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BgDillerInstaller model.
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
                
                $unit->delete();

            }
            return true;
        }
    }

    /**
     * Finds the BgDillerInstaller model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BgDillerInstaller the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BgDillerAll::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
