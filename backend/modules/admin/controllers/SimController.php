<?php

namespace backend\modules\admin\controllers;


use Yii;
use app\models\Sim;
use app\models\Unit;
use app\models\Client;
use app\models\SimSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * SimController implements the CRUD actions for Sim model.
 */
class SimController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        Yii::$app->view->params['item'] = 'sim';
        
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
     * Lists all Sim models.
     * @return mixed
     */
    public function actionIndex()
    {
        Yii::$app->language = "ru-RU";
        $searchModel = new SimSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sim model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionUploadExcel()
    {
        $model = new Sim;
        if ($model->load(Yii::$app->request->post())){

            $model->excel= UploadedFile::getInstance($model, 'excel');
            if ($model->excel !== NULL){
                try{
                    $inputFileType = \PHPExcel_IOFactory::identify($model->excel->tempName);
                    $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($model->excel->tempName);
                }catch(Exception $e)
                {
                    die('Error');
                }
                
                $sheet = $objPHPExcel->getSheet(0);
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                for($row = 0; $row<= $highestRow; $row++)
                {
                    $rowData = $sheet->rangeToArray('A'.$row.':'.$highestColumn.$row,NULL,TRUE,FALSE);
                    if($row == 0){
                        continue;
                    }
                    $unit = new Unit;
                    $unit->number = $rowData[0][0];
                    $unit->imei = number_format($rowData[0][1],0,'','');
                    if(!$unit->imei){
                        $unit->imei = 0;
                    }
                    $unit->idTypeUnit = $rowData[0][2];
                    $unit->idClient = $rowData[0][4];                                    
                    $num_sim = $rowData[0][3];

                    if (strlen($num_sim) > 9){
                        $num_sim = substr($num_sim, -9);
                       }
                    if($sim = Sim::find()->where(['sim' => $num_sim])->one()){
                        $unit->idSim = $sim->idSim;
                        $unit->idIcc = $sim->idSim;
                    }else{
                        $sim = new Sim;
                        $sim->sim = $num_sim;
                        $sim->save();
                        $unit->idSim = $sim->idSim;
                        $unit->idIcc = $sim->idSim;
                    }
                    if (!$unit->save()){
                        print_r($unit->getErrors());
                    }else{
                        $count_client = Client::findOne($unit->idClient);
                        $count_client->clientCountObj++;
                        $count_client->save();
                    }
                    
                    /*$number = number_format($rowData[0][1],0,'','');
                    echo strval($number);*/
                    //echo $rowData[0][0].' '.number_format($rowData[0][1],0,'','').' '.$rowData[0][2].' '.$rowData[0][3].'<br>';
                   /* $sim = new Sim;
                    if ($rowData[0][1] == "Действующий"){
                        $sim->status = 1;
                    }else{
                        $sim->status = 0;
                    }
                    $sim->code = '40926020';
                    $sim->sim = $rowData[0][0];
                    
                    if(!$sim->save()){
                         //print_r($row.' - '.$sim->getErrors());
                         continue;
                    }
*/
                    //echo $model->sim;

                }
                return $this->redirect('/unit');

            }else{
                echo "Bad";
                exit;
            }
            //return $this->redirect(['/data/sim']);
        }else{
            return $this->render('upload',
                ['model' => $model]);
        }   
    }


    /**
     * Creates a new Sim model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sim();

        if ($model->load(Yii::$app->request->post())) {
            $count = Sim::find()->where(['sim' => $model->sim])->count();
            if ($count > 0){
                echo 3;
            }
            else{
                if($model->save()){
                    echo 1;
                }else{
                    echo 2;
                }
            }
            
            //return $this->redirect(['view', 'id' => $model->Id]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Sim model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if($model->save()){
                echo 1;
            }else{
                echo 2;
            }
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Sim model.
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
     * Finds the Sim model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sim the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sim::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
