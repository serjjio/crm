<?php

namespace backend\modules\guard\controllers;

use Yii;
use backend\modules\guard\models\BgInsurance;
use backend\modules\guard\models\BgInsuranceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * BgInsuranceController implements the CRUD actions for BgInsurance model.
 */
class BgInsuranceController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        Yii::$app->view->params['item'] = 'bg-insurance';
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
     * Lists all BgInsurance models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BgInsuranceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BgInsurance model.
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
     * Creates a new BgInsurance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BgInsurance();
        $post = Yii::$app->request->post();
        if(Yii::$app->request->isAjax && isset($post)){
            $data = $_POST['data'];
            if ($data){
                $model->name_insurance = $data;
                return $model->save() ? true : false;
            }
        }
    }

    /*Update edittable Name in gridview*/
    public function actionEditName(){

        if(Yii::$app->request->post('hasEditable')){

            $id = Yii::$app->request->post('editableKey');
           
            $model = BgInsurance::findOne($id);

            //$out = Json::encode(['output'=>'','message'=>'']);
            $post = [];
            $posted = current($_POST['BgInsurance']);

            $post['BgInsurance'] = $posted;
            
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
     * Updates an existing BgInsurance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_insurance]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BgInsurance model.
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
     * Finds the BgInsurance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BgInsurance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BgInsurance::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
