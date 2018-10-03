<?php
namespace backend\modules\admin\models;

use yii\base\Model;
use common\models\User;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $full_name;
    public $department;
    public $position;
    public $phone;
    public $re_password;
    public $permission;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required', 'message' => 'Необходимо заполнить поле'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Такой логин уже зарегистрирован.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required', 'message' => 'Необходимо заполнить поле'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            //['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Такой email уже зарегистрирован.'],

            ['password', 'required', 'message' => 'Необходимо заполнить поле'],
            ['password', 'string', 'min' => 6, 'tooShort' => 'Поле должно содержать больше 6 символов'],
            ['password', 'compare', 'compareAttribute' => 're_password', 'message' => 'Не совпадает'],

            ['re_password', 'required', 'message' => 'Необходимо заполнить поле'],
            ['re_password', 'string', 'min' => 6, 'tooShort' => 'Поле должно содержать больше 6 символов'],

            [['full_name', 'department', 'position', 'phone'], 'safe'],

            ['permission', 'safe'],

        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->full_name = $this->full_name;
        $user->department = $this->department;
        $user->position = $this->position;
        $user->phone = $this->phone;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        if($this->permission){
            if($user->save()){
                $auth = Yii::$app->authManager;
                foreach ($this->permission as $value) {
                    $role = $auth->getPermission($value);
                    $auth->assign($role, $user->id);
                }
            return $user;
            }else{
                return null ;
            }
        }else{
          return $user->save() ? $user : null;  
        }
        

        
        
    }
    public function revokePermission($id){
        
    }

    public function findModel($id)
    {
        if (($model = User::findOne($id)) !== null){
            return $model;
        }else {
            throw new Exception('The requested page does not exist.');
            
        }
    }
}
