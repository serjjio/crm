<?php

namespace backend\controllers;

use Yii;
use app\models\Client;
use app\models\ClientSearch;
use app\models\ServiceContract;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use app\models\Contract;
use app\models\UserInfoSearch;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use app\models\Doc;
use yii\filters\AccessControl;

/**
 * ClientController implements the CRUD actions for Client model.
 */
class ClientController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        Yii::$app->view->params['status'] = 'monitoring';
        Yii::$app->view->params['item'] = 'client';
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index', 'detail-view', 'logout', 'doc'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['create', 'delete', 'update', 'doc-upload', 'download-doc', 'doc-delete'],
                        'allow' => true,
                        'roles' => ['createClient'],
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
     * Lists all Client models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        Yii::$app->language = 'ru-RU';
        $searchModel = new ClientSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Deteil Client model.
     * @param integer $id
     * @return mixed
     */
    public function actionDetailView($id)
    {
        $this->layout = 'main-view';
        Yii::$app->language = 'ru-RU';
        $post = Yii::$app->request->post();
        $model = $this->findModel($id);
        $contract = Contract::findOne($model->idConract);
        $serviceContract = ServiceContract::find()->where(['idClient' => $id])->asArray()->all();
        if($model->load($post)){
            
                if ($contract->numberContractProvider != $model->numberContractProvider || $contract->date_service_contract != $model->date_service_contract || $contract->serviceContract != $model->serviceContract){
                     
                    $date_service_contract = strtotime($model->date_service_contract);
                    $contract->date_service_contract = date('Y-m-d', $date_service_contract);
                    if ($contract->date_provider_contract != $model->date_provider_contract){
                        $date_provider_contract = strtotime($model->date_provider_contract);
                        $contract->date_provider_contract = date('Y-m-d', $date_provider_contract);
                    }
                    $contract->numberContractProvider = $model->numberContractProvider;
                    $contract->serviceContract = $model->serviceContract;
                    $contract->save();
                }
             


        //$model->number = $contract->number;
        $model->date_service_contract = $contract->date_service_contract;
        $model->date_provider_contract = $contract->date_provider_contract;
        $model->numberContractProvider = $contract->numberContractProvider;
        $model->serviceContract = $contract->serviceContract;


            $model->imgLogo= UploadedFile::getInstance($model, 'imgLogo');
            if ($model->imgLogo !== NULL){
                
                $fileName = uniqid();
                $folder_name = $model->idClient;
                
                if(!is_dir(Yii::getAlias('@webroot').'/images/'.$folder_name.'/logo')){
                        mkdir(Yii::getAlias('@webroot').'/images/'.$folder_name);
                        mkdir(Yii::getAlias('@webroot').'/images/'.$folder_name.'/logo');
                        chmod(Yii::getAlias('@webroot').'/images/'.$folder_name.'/logo', 0777);
                    };
               
                    $model->imgLogo->saveAs(Yii::getAlias('@webroot'.'/images/'.$folder_name.'/logo/'.$model->idClient.'.'.$model->imgLogo->extension));
    
                //save in DB
                $model->logo = $model->idClient.'.'.$model->imgLogo->extension;
                $model->imgLogo = NULL;
        
            }
            $model->save();
            Yii::$app->session->setFlash('kv-detail-success', 'Параметры успешно изменены');
            $success = true;
            return;
        }
        if(is_null($model->logo)){
            $model->logo = '';
        }
            $searchModel = new UserInfoSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id);
            

            return $this->render('detail-view', [
                'model' => $model,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'id' => $id,
                'serviceContract' => $serviceContract,
            ]);
   
        
    }

    /**
     * Creates a new Client model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->identity->username == 'sale'){
            throw new ForbiddenHttpException('Доступ закрыт');
        }
        Yii::$app->language = 'ru-RU';
        $model = new Client();
        $modelContract = new Contract();
        

        if ($model->load(Yii::$app->request->post()) && $modelContract->load(Yii::$app->request->post())) {
            $date= strtotime($modelContract->date_service_contract);
            $modelContract->date_service_contract = date('Y-m-d', $date);
            $modelContract->number = $modelContract->serviceContract;
            if (!$modelContract->save()) var_dump($modelContract->errors);
            
            
            $model->idConract = $modelContract->idContract;
            if($model->clientCountObj < 1){
                $model->clientCountObj = 0;
            }
            
            $model->imgLogo= UploadedFile::getInstance($model, 'imgLogo');
            
            if ($model->imgLogo !== NULL){
               
                $fileName = uniqid();
                $folder_name = $model->clientName;
                
                if(!is_dir(Yii::getAlias('@webroot').'/images/'.$folder_name.'/logo')){
                        mkdir(Yii::getAlias('@webroot').'/images/'.$folder_name);
                        mkdir(Yii::getAlias('@webroot').'/images/'.$folder_name.'/logo');
                        chmod(Yii::getAlias('@webroot').'/images/'.$folder_name.'/logo', 0777);
                    };
               
                    $model->imgLogo->saveAs(Yii::getAlias('@webroot'.'/images/'.$folder_name.'/logo/'.$model->clientName.'.'.$model->imgLogo->extension));
    
                //save in DB
                $model->logo = $model->clientName.'.'.$model->imgLogo->extension;
                $model->imgLogo = NULL;
        
            }
            if ($model->save()){
                Yii::$app->session->setFlash('kv-detail-success', 'Клиент успешно создан');
            }else{
                
                Yii::$app->session->setFlash('kv-detail-error', 'Error');
            }
           return $this->redirect(['detail-view', 'id' => $model->idClient]);
        } else {
            $modelContract->date_service_contract = date('d-M-Y');
            return $this->render('create', [
                'model' => $model,
                'modelContract' => $modelContract,
                
            ]);
        }
    }

    /**
     * Updates an existing Client model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idClient]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Client model.
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
     * Finds the Client model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Client the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Client::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds document.
     * @param integer $id
     * @return Client detail about document
     */
    public function actionDoc($id){
        $model = new Doc();
        $docs = Doc::find()
                    ->where(['idClient' => $id])
                    ->all();
        $client_name = Client::findOne($id)->clientName;

        if (!$docs){
            $model->idClient = $id;
            $initialPreview = [];
            $initialPreviewConfig=[];
        }else{
            foreach($docs as $doc){
                $explode = explode(".", $doc->docName);
                $type = array_pop($explode);
                
                if ($type == 'jpg' || $type =='png' || $type=='bmp' || $type=='jpeg'){
                    $initialPreview[] = '/docs/'.$id.'/'.$doc->docName;
                    $initialPreviewConfig[] = ['caption' => $doc->docName, 'size' => $doc->size, 'url' => '/client/doc-delete', 'key' => $doc->idDoc,];
                }elseif($type == 'docx'){

                    $initialPreview[] = '/docs/docs.png';

                    $initialPreviewConfig[] = [
                            'caption' => $doc->docName, 
                            'size' => $doc->size, 
                            'url' => '/client/doc-delete',
                            'key' => $doc->idDoc,
                    ];
                }elseif($type == 'zip'){
                    $initialPreview[] = '/docs/Zip-icon.png';
                    $initialPreviewConfig[] = ['caption' => $doc->docName, 'size' => $doc->size, 'url' => '/client/doc-delete', 'key' => $doc->idDoc,];
                }elseif($type == 'txt'){
                    $file = Yii::getAlias('@webroot').'/docs/'.$id.'/'.$doc->docName;
                    $text = utf8_encode(file_get_contents($file));
                    $initialPreview[] = $text;
                    $initialPreviewConfig[] = ['type' => 'text', 'caption' => $doc->docName, 'size' => $doc->size, 'url' => '/client/doc-delete', 'key' => $doc->idDoc,];
                }elseif($type == 'xlsx' || $type == 'xls'){
                    $initialPreview[] = '/docs/xls.jpg';
                    $initialPreviewConfig[] = ['caption' => $doc->docName, 'size' => $docName->size, 'url' => '/client/doc-delete', 'key' => $doc->idDoc,];
                }else{
                    $initialPreview[] = '/docs/'.$id.'/'.$doc->docName;
                    $initialPreviewConfig[] = ['type' => $type, 'caption' => $doc->docName, 'size' => $doc->size, 'url' => '/client/doc-delete', 'key' => $doc->idDoc,];
                }
  
            }
        }

            return $this->render('_document',[
                    'model' => $model,
                    'client_name' => $client_name,
                    'id' => $id,
                    'initialPreview' => $initialPreview,
                    'initialPreviewConfig' => $initialPreviewConfig

                ]);

    }

    /**
     * Deletes an existing Client documents.
     * If deletion is successful, the browser will be redirected success.
     * @param integer $id
     * @return mixed
     */
    public function actionDocDelete(){

        if(Yii::$app->request->isPost){
            $key = $_POST['key'];
            $model = Doc::findOne($key);
            $filename = Yii::getAlias('@webroot').'/docs/'.$model->idClient.'/'.$model->docName;
            if (file_exists($filename)){
                @unlink($filename);
            }
            $model->delete();
            return true;
        }
    }

    /**
     * To upload a new client documents.
     * If creation is successful, the browser will be required true.
     * @return mixed
     */
    public function actionDocUpload(){  
        $model = new Doc;

        if(Yii::$app->request->isPost){
            $model->doc_file = UploadedFile::getInstance($model, 'doc_file');
            if($model->doc_file == NULL){
                return true;
            }else{
                $folder_name = $_POST['idClient'];
                if(!is_dir(Yii::getAlias('@webroot').'/docs/'.$folder_name)){
                        mkdir(Yii::getAlias('@webroot').'/docs/'.$folder_name);
                        chmod(Yii::getAlias('@webroot').'/docs/'.$folder_name, 0777);
                    };
                $size = $model->doc_file->size;

                $model->docName = $model->doc_file->baseName.'.'.$model->doc_file->extension;
                $model->idClient = $folder_name;
                $model->size = "$size";

                if($model->save()){
                    $model->doc_file->saveAs(Yii::getAlias('@webroot').'/docs/'.$folder_name.'/'.$model->doc_file->baseName.'.'.$model->doc_file->extension);
  

                    $model->doc_file = NULL;

                    return TRUE;

                }else{
                    echo "Error save in DB";
                }


                

                
            }
        }
    }
    /**
     * Ajax download document.
     * If process is successful, the browser will be required true.
     * @return mixed
     */
    public function actionDownloadDoc($id){

            $model = Doc::findOne($id);
            $file = Yii::getAlias('@webroot').'/docs/'.$model->idClient.'/'.$model->docName;
            if(file_exists($file)){
                return Yii::$app->response->sendFile($file);

            }
        
    }
}



