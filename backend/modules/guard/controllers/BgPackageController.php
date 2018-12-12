<?php

namespace backend\modules\guard\controllers;

use Yii;
use backend\modules\guard\models\BgPackage;
use backend\modules\guard\models\BgPackageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * BgPackageController implements the CRUD actions for BgPackage model.
 */
class BgPackageController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        Yii::$app->view->params['item'] = 'bg-package';
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
     * Lists all BgPackage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BgPackageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BgPackage model.
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
     * Creates a new BgPackage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BgPackage();
        $post = Yii::$app->request->post();
        if(Yii::$app->request->isAjax && isset($post)){
            $data = $_POST['data'];
            if ($data){
                $model->name_package = $data;
                
                return $model->save() ? true : false;
            }
        }
    }
    /*Update edittable Name in gridview*/
    public function actionEditName(){

        if(Yii::$app->request->post('hasEditable')){

            $id = Yii::$app->request->post('editableKey');
           
            $model = BgPackage::findOne($id);

            //$out = Json::encode(['output'=>'','message'=>'']);
            $post = [];
            $posted = current($_POST['BgPackage']);

            $post['BgPackage'] = $posted;
            
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
     * Updates an existing BgPackage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_package]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BgPackage model.
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
     * Finds the BgPackage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BgPackage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BgPackage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
