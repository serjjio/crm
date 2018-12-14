<?php

namespace backend\modules\guard\models;

use Yii;

/**
 * This is the model class for table "bg_login".
 *
 * @property integer $id_login
 * @property integer $id_client
 * @property string $name_login
 * @property string $name_user
 * @property string $email
 *
 * @property BgClient $idClient
 */
class BgLogin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bg_login';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_client', 'name_login'], 'required', 'message' => 'Необходимо заполнить поле'],
            [['id_client'], 'integer'],
            ['email', 'trim'],
            ['email', 'email'],
            [['name_login', 'name_user'], 'string', 'max' => 256],
            [['id_client'], 'exist', 'skipOnError' => true, 'targetClass' => BgClient::className(), 'targetAttribute' => ['id_client' => 'id_client']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_login' => 'Id Login',
            'id_client' => 'Id Client',
            'name_login' => 'Логин',
            'name_user' => 'Имя пользователя',
            'email' => 'Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdClient()
    {
        return $this->hasOne(BgClient::className(), ['id_client' => 'id_client']);
    }
}
