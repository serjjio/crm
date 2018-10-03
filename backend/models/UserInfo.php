<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "UserInfo".
 *
 * @property integer $idUser
 * @property integer $idClient
 * @property string $login
 * @property string $nameUser
 * @property integer $idSoft
 *
 * @property Client $idClient0
 * @property Soft $idSoft0
 */
class UserInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'UserInfo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idClient', 'login'], 'required', 'message' => 'Необходимо заполнить поле'],
            [['idServer', 'comment'], 'safe'],
            [['idClient', 'idServer'], 'integer'],
            [['login', 'nameUser', 'email'], 'string', 'max' => 256],
            [['idClient'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['idClient' => 'idClient']],
            [['idServer'], 'exist', 'skipOnError' => true, 'targetClass' => Server::className(), 'targetAttribute' => ['idServer' => 'idServer']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idUser' => 'Id User',
            'idClient' => 'Id Client',
            'login' => 'Логин',
            'nameUser' => 'Имя пользователя',
            'idServer' => 'Сервер',
            'email' => 'Email',
            'comment' => 'Примечание'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdClient0()
    {
        return $this->hasOne(Client::className(), ['idClient' => 'idClient']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdServer0()
    {
        return $this->hasOne(Server::className(), ['idServer' => 'idServer']);
    }
}
