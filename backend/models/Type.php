<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Type".
 *
 * @property integer $idType
 * @property string $nameType
 *
 * @property Client[] $clients
 */
class Type extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nameType'], 'required'],
            [['nameType'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idType' => 'Id Type',
            'nameType' => 'Name Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClients()
    {
        return $this->hasMany(Client::className(), ['idType' => 'idType']);
    }
}
