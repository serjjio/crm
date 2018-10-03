<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Server".
 *
 * @property integer $idServer
 * @property string $Server
 * @property string $Location
 * @property integer $idSoft
 * @property string $Coment
 *
 * @property Soft $idSoft0
 * @property Client[] $clients
 */
class Server extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Server';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['server'], 'required', 'message' => 'Необходимо заполнить поле'],
            [['server', 'location', 'comment', 'nameSoft', 'version', 'link'], 'string', 'max' => 256],
           
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idServer' => 'Id Server',
            'server' => 'Server',
            'Location' => 'Location',
            'nameSoft' => 'Name Soft',
            'Coment' => 'Coment',
            'version' => 'Version',
            'link' => 'link',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
   

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClients()
    {
        return $this->hasMany(Client::className(), ['idServer' => 'idServer']);
    }
}
