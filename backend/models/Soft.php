<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Soft".
 *
 * @property integer $idSoft
 * @property string $nameSoft
 * @property string $version
 * @property string $comments
 *
 * @property Server[] $servers
 * @property UserInfo[] $userInfos
 */
class Soft extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Soft';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nameSoft'], 'required', 'message' => 'Необходимо заполнить поле'],
            [['nameSoft', 'version', 'comments'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idSoft' => 'Id Soft',
            'nameSoft' => 'Name Soft',
            'version' => 'Version',
            'comments' => 'Comments',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServers()
    {
        return $this->hasMany(Server::className(), ['idSoft' => 'idSoft']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserInfos()
    {
        return $this->hasMany(UserInfo::className(), ['idSoft' => 'idSoft']);
    }
}
