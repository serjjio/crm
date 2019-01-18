<?php

namespace backend\modules\guard\controllers;

use Yii;
use backend\modules\guard\models\BgUnit;
use backend\modules\guard\models\BgUnitSearch;
use backend\modules\guard\models\BgCommentSearch;
use backend\modules\guard\models\BgComment;
use backend\modules\guard\models\BgModel;
use backend\modules\guard\models\BgCity;
use backend\modules\guard\models\BgOblast;
use backend\modules\guard\models\BgClient;
use backend\modules\guard\models\BgDoc;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
//use yii\httpclient\XmlParser;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use yii\db\Query;

/**
 * BgUnitController implements the CRUD actions for BgUnit model.
 */
class BgUnitController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        Yii::$app->view->params['item'] = 'bg-unit';
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index', 'update', 'view'],
                        'allow' => true,
                        'roles' => ['viewGuard'],
                    ],
                    [
                        'actions' => ['create', 'delete', 'update', 'change-marka', 'delete-selected', 'cities-list', 'create-client', 'client-list', 'create-comment'],
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
     * Lists all BgUnit models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BgUnitSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id=false);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BgUnit model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $searchModel = new BgUnitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new BgUnit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        Yii::$app->language = 'ru-RU';
        //$this->setLayoutPath('@app/views/layouts');
        //$this->layout = 'main';
        
        $model = new BgUnit();


        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {   

            
            
            if($model->test_date){
                $test_date= strtotime($model->test_date);
                $model->test_date = date('Y-m-d', $test_date);
            }
            if($model->activate_date){
                $activate_date= strtotime($model->activate_date);
                $model->activate_date = date('Y-m-d', $activate_date);
            }
            if($model->contract_date){
                $contract_date= strtotime($model->contract_date);
                $model->contract_date = date('Y-m-d', $contract_date);
            }
            /*if($model->made_auto_date){
                $made_auto_date= strtotime($model->made_auto_date);
                $model->made_auto_date = date('Y', $made_auto_date);
            }*/
            if($model->id_client != null){
                $client = BgClient::findOne($model->id_client);
                $client->count_obj++;
                !$client->save() ? print_r($client->getErrors()) : '';
            }
            $comment = $model->comment;
            
            if ($model->save()){
                if($comment){
                    $model_comment = new BgComment;
                    $model_comment->text_comment = $comment;
                    $model_comment->date = date('Y-m-d H:m:s', time());
                    $model_comment->id_unit = $model->id_unit;
                    $model_comment->id_user = Yii::$app->user->identity->id;
                    $model_comment->username = Yii::$app->user->identity->username;
                    $model_comment->save();
                }
                return $this->redirect('/guard/bg-unit');
            }
                
                
            
        } else {
            
            $model->test_date = date('Y-m-d');
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /*Create Client*/

    public function actionCreateClient()
    {

        Yii::$app->language = 'ru-RU';
        $model = new BgClient();

        /*if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            return ActiveForm::validate($model);
        }*/

        if ($model->load(Yii::$app->request->post())) {


            if($model->count_obj < 1){
                $model->count_obj = 0;
            }
            echo $model->save() ? "<option value = '".$model->id_client."'>".$model->client_name."</option>" : null;
        } else {
            return $this->renderAjax('_form-client', [
                'model' => $model,
            ]);
        }
    }

    /*Ajax request for to search Models*/
    public function actionClientList($q = null, $id = null){

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $out = ['results' => ['id' => '', 'text' => '']];
        if(!is_null($q)){
            
            $query = new Query;
            $query->select(['id_client AS id', 'client_name AS text'])
                    ->from('bg_client')
                    ->where(['like', 'client_name', $q])
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
            
            $out['results'] = ['id' => $id, 'text' => BgClientl::find($id_client)->client_name];
        }
       
        return $out;
    }


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

    public function actionXml()
    {
        $parcer = XmlParser;

        $model = new BgUnit();
        
        $ob_obl = new BgOblast;
        //if(Yii::$app->request->isPost){
            //$xml = UploadedFile::getInstance($model, 'file');
            //var_dump($xml);
            
            //$file = utf8_encode($file);
            //var_dump($file);
            
            //$content = mb_convert_encoding($content, 'UTF-8');
            //$ob = simplexml_load_string($content);
            //$ob = mb_convert_encoding($ob, 'UTF-8');
            //$json = json_encode($ob);
            //var_dump($json);
            //$xml->saveAs(Yii::getAlias('@webroot').'/docs/'.$xml->baseName.'.'.$xml->extension);
            //var_dump($parcer->convertXmlToArray($ob));
            
            //var_dump($xml);
                
                //echo $ob_obl->name_oblast.'<br>';
                //$name = $xml->Country->Region['Name'];


                /*$file = Yii::getAlias('@webroot').'/docs/city1.xml';
                $content = file_get_contents($file);
                $xml = new \SimpleXMLElement($content);
               $ob_obl->name_oblast = ''.$xml->Country->Region['Name'];
                $ob_obl->save();

                
                    
                $qqq = []; 
                foreach ($xml->Country->Region->City as $city) {
                    $ob_city = new BgCity;
                    $ob_city->name_sity = ''.$city['Name'];
                    $ob_city->id_oblast = $ob_obl->id_oblast;
                    $ob_city->name_oblast = $ob_obl->name_oblast;
                    $ob_city->save();
                     
                    
                }
*/
                


            
           
            
            //$xml = new \DOMDocument();
            //$xml->load($file);
            //echo $xml->getElementsByTagName("Country")->item(0);

            //var_dump($doc);
        /*}else{
            return $this->render('test', [
                'model' => $model,
            ]);
        }*/
        

    }

    public function actionChangeMarka($id){

        
        $countModel = BgModel::find()
                        ->where(['id_marka' => $id])
                        ->count();
        $models = BgModel::find()
                    ->where(['id_marka' => $id])
                    ->all();
        if ($countModel > 0){
            foreach ($models as $model){
                echo "<option value = '".$model->id_model."'>".$model->name_model."</option>";
            }
        }else{
            echo "<option></option>";
        }
    }

    /**
     * Updates an existing BgUnit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        $id_client_current = $model->id_client;
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {   

            if($model->id_segment != 2) $model->id_insurance = null;
            if($model->can_module != 1) $model->id_can = null;
            if($model->volume_sensor != 1) $model->id_volume = null;


            

            if($model->test_date){
                $test_date= strtotime($model->test_date);
                $model->test_date = date('Y-m-d', $test_date);
            }
            if($model->activate_date){
                $activate_date= strtotime($model->activate_date);
                $model->activate_date = date('Y-m-d', $activate_date);
            }
            if($model->contract_date){
                $contract_date= strtotime($model->contract_date);
                $model->contract_date = date('Y-m-d', $contract_date);
            }
            /*if($model->made_auto_date){
                $made_auto_date= strtotime($model->made_auto_date);
                
                $model->made_auto_date = date('Y', $made_auto_date);
            }*/

            if($id_client_current != $model->id_client){
                if (!is_null($id_client_current)){
                    $countOld = BgClient::findOne($id_client_current);
                    $countOld->count_obj --;
                    !$countOld->save() ? print_r($countOld->getErrors()) : true;
                } 
                if($model->id_client){
                    $countNew = BgClient::findOne($model->id_client);
                    $countNew->count_obj++;
                    !$countNew->save() ? print_r($countNew->getErrors()) : true;
                    
                }

                
            }

            if($model->file){
                //$model->file = UploadedFile::getInstance($model->file, 'file');
                
            }
            
            if ($model->save()) return $this->redirect('/guard/bg-unit');
                
                
            
        } else {
            $searchModel = new BgCommentSearch();
            
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id);
            
            return $this->render('update', [
                'model' => $model,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'id' => $id,
            ]);
        }
    }

    /*Upliad Files on Server*/

    protected function uploadFiles($file, $id){
        $model = new BgDoc;

        $file = UploadedFile::getInstance($file, 'file');
        var_dump($file);
        exit;

    }


    /*Create Comment for unit*/

    public function actionCreateComment($id)
    {
        $model = new BgComment();
        $post = Yii::$app->request->post();
        if(Yii::$app->request->isAjax && isset($post)){
            $data = $_POST['data'];
            if ($data){
                date_default_timezone_set('Europe/Kiev');
                $model->date = date('Y-m-d H:i:s', time());
                $model->text_comment = $data;
                $model->id_unit = $id;
                $model->id_user = Yii::$app->user->identity->id;
                $model->username = Yii::$app->user->identity->username;
                return $model->save() ? true : false;
            }
        }
        
    }

    /**
     * Deletes an existing BgUnit model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    /*public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }*/

    public function actionDeleteSelected(){
        $post = Yii::$app->request->post();
        if (Yii::$app->request->isAjax && isset($post['keys'])){
            $keys = $post[keys];
            for ($i=0; $i<count($keys); $i++){
                $unit = $this->findModel($keys[$i]);
                if(!is_null($unit->id_client)){
                    $client = BgClient::findOne($unit->id_client);
                    $client->count_obj--;
                    $client->save();
                }
                $unit->delete();

            }
            return true;
        }
    }

    /**
     * Finds the BgUnit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BgUnit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BgUnit::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
