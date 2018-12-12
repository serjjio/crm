<?php

namespace backend\modules\admin\controllers;

use Yii;
use common\models\User;
use backend\modules\admin\models\SignupForm;
use backend\modules\admin\models\AuthAssignment;
use backend\modules\admin\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        Yii::$app->view->params['item'] = 'user';
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index', 'create', 'delete', 'update', 'logout'],
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SignupForm();
        $permissions_list = ArrayHelper::map(Yii::$app->authManager->getPermissions(), 'name', 'description');

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            if($model->signup()){
                return $this->redirect('/admin/user');
            }
            
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'permissions_list' => $permissions_list,
            ]);
        }
    }

    /*Test*/
    public function actionTest(){

        $permissions = ArrayHelper::map(Yii::$app->authManager->getPermissions(), 'name', 'description');
        var_dump(Yii::$app->authManager->getPermission('createClient'));
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if ($id == 1){
            throw new ForbiddenHttpException('Access denied');
        }
        $model = SignupForm::findModel($id);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        $auth = Yii::$app->authManager;
        $permissions_list = ArrayHelper::map($auth->getPermissions(), 'name', 'description');

        $permissions_user = AuthAssignment::find()->where(['user_id' => $id])->asArray()->all();

        
        foreach ($permissions_user as $value) {
            $permission_user[] = $value['item_name'];
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->new_password){
                $model->updatePassword($model->new_password);
            }
            $model->save();
            if ($model->permission === $permission_user){
                return $this->redirect('/admin/user');
            }else{
                $pers_user = AuthAssignment::find()->where(['user_id' => $id])->all();
                if($pers_user){
                    foreach($pers_user as $per_user){
                        $per_user->delete();
                    }   
                }
                if($model->permission){
                    $auth = Yii::$app->authManager;
                    foreach ($model->permission as $value) {
                        $role = $auth->getPermission($value);
                        $auth->assign($role, $id);
                    }
                }
            }
        return $this->redirect('/admin/user');
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
                'permissions_list' => $permissions_list,
                'permission_user' => $permission_user,

            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if($this->findModel($id)->delete()){
            $pers_user = AuthAssignment::find()->where(['user_id' => $id])->all();
            if($pers_user){
                foreach($pers_user as $per_user){
                    $per_user->delete();
                }
            }
        };

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
